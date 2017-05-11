<?php

namespace ceu\Http\Controllers;

use Illuminate\Http\Request;
use ceu\Http\Models\Arquivo;
use ceu\Support\MimeIcon;
use Auth;
use File;
use Storage;
use DB;

class ArquivoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upload(Request $request)
    {
        $barra = DIRECTORY_SEPARATOR;
        $arquivo = new Arquivo;
        $file = $request->file("uploadfile");
        $filename = $file->getClientOriginalName();
        $user_id = Auth::id();
        $path = "upload" . $barra . $user_id;

        if($file->isValid()){
            $file->storeAs($path, $filename);
            $arquivo->nome = $filename;
            $arquivo->pasta = $path;
            $arquivo->ext = $file->getClientOriginalExtension();
            $arquivo->download = $path . $barra . $filename;
            $arquivo->size = $this->formatSizeUnits($file->getClientSize());
            $arquivo->mime = $file->getClientMimeType();

            $arquivo->idusuario = $user_id;

            $arquivo->save();
        } else{
            return $file->getErrorMessage();
        }

        return redirect('/');
    }

    public function formatSizeUnits($bytes)
    {
        $bytes = (int)($bytes / 1024);
        return $bytes;
    }

    public static function getFiles(){


        $barra = DIRECTORY_SEPARATOR;
        $user_id = Auth::id();
        $path = "upload" . $barra . $user_id;
        $arquivos = array();
        $fileinfo = array();
        $files = Storage::files($path);
        $direct = Storage::Directories($path);
        $mimeIcon = new MimeIcon();


        //var_dump($directories);


        foreach ($files as $arquivo) {
            $arq = explode("/", $arquivo);
            $fileinfo = DB::table('arquivos')
            ->select('*')
            ->where('nome', '=', $arq[count($arq)-1])
            ->where('idusuario', '=', $user_id)
            ->orderBy("id")
            ->get();
            foreach ($fileinfo as $info) {
                array_push($arquivos, array(
                "id"=>$info->id,
                "name"=>$info->nome,
                "path"=>$info->pasta,
                "ext"=>$info->ext,
                "size"=>$info->size,
                "mime"=>$mimeIcon->font_icon($info->mime),
                "upload"=>$info->created_at,
                "download"=>$arquivo
                ));
            }
            asort($arquivos);
        }
        foreach ($direct as $dir) {
            $arq = explode("/", $dir);
            /*$fileinfo = DB::table('arquivos')
            ->select('*')
            ->where('nome', '=', $arq[count($arq)-1])
            ->where('idusuario', '=', $user_id)
            ->orderBy("id")
            ->get();*/
            //foreach ($fileinfo as $info) {
                array_push($arquivos, array(
                "id"=>0,
                "name"=>$arq[count($arq)-1],
                "path"=>'.',
                "ext"=>'folder',
                "size"=>0,
                "mime"=>$mimeIcon->font_icon('folder'),
                "upload"=>'',
                "download"=>'#'
                ));
            //}
        }

        return view('home')->with("arquivos", $arquivos);
    }

    public function download($file = ''){
        if($file){
            $files = Storage_path() .'/app/' . $file;
            return response()->download($files);
        } else {
            return redirect('/');
        }
    }

}
