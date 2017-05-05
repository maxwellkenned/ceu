<?php

namespace ceu\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    public function getFiles(){
            $path = "uploads";
            $arquivos = Array();

            /* Diretorio que deve ser lido */
            //$pasta = opendir($storagePath);
            /* Loop para ler os arquivos do diretorio */
            //var_dump(scandir($storagePath));
            $files = Storage::allFiles($path);
            $directories = Storage::allDirectories($path);
            foreach ($files as $arquivo) {
                $arq = explode("/", $arquivo);
                array_push($arquivos, array(
                    "name"=>$arq[1],
                    "download"=>$arquivo
                    ));
                }

           return view('index')->with("arquivos", $arquivos);
        }


    public function upload(Request $request){
        $file = $request->uploadFile;
        if($file->isValid()){
            $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            $type = $file->getClientMimeType();
            $dirUploads = "uploads";
            if(!is_dir($dirUploads)){

                mkdir($dirUploads, "0777");

            }

            $file->move($dirUploads, $name);
            $file->storeAs($dirUploads, $name);

            return redirect()->action('FileController@getFiles');
        } else{
            return $file->getErrorMessage();
        }
    }

    public function download($file){
        $files = Storage::get($file);
        response()->download($files);
        return redirect()->action('FileController@getFiles');
    }

}
