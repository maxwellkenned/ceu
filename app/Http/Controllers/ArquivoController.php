<?php

namespace ceu\Http\Controllers;

use Illuminate\Http\Request;
use ceu\Http\Models\Arquivo;
use ceu\Http\Models\Folder;
use ceu\Support\MimeIcon;
use ceu\Support\Helper;
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
        $barra = '/';
        $download = "";
        $user_id = Auth::id();        
        $uri = $request->input("uriFolder");
        $pathUp = "upload" . $barra . $user_id;
        $pathInfo = '/';
        $subPath = "";
        if(!($uri === "/" || $uri ==="/home" )){
                $subPath = str_replace("/path/", "", $request->input("uriFolder"));
                $download = $subPath . $barra;
                $pathInfo = $subPath;
                $path .= $barra . $subPath;
            }

        $files = $request->file("uploadfile");
        if($files){
            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $arquivo = new Arquivo;

                $file->storeAs($pathUp, $filename);

                $arquivo->nome = $filename;
                $arquivo->pasta = $pathInfo;
                $arquivo->ext = $file->getClientOriginalExtension();
                $arquivo->download = $download . $filename;
                $arquivo->size = $file->getClientSize();
                $arquivo->mime = $file->getClientMimeType();

                $arquivo->idusuario = $user_id;
                $arquivo->save();
            }
        }

        //return redirect();
    }

    public function formatSizeUnits($bytes)
    {
        $bytes = (int)($bytes / 1024);
        return $bytes;
    }

    public static function getFiles($uri = null){

        $mimeIcon = new MimeIcon();
        $helper = new Helper();
        $barra = '/';
        $user_id = Auth::id();
        $pathUp = "upload" . $barra . $user_id . $barra;
        $path = "upload" . $barra . $user_id . $barra;
        $arquivos = array();
        $uriTratada = str_replace("/path/".$path, "", $uri);
        //$fileinfo = new Arquivo();
        if($uri){
            $pathUp .= $barra . $uriTratada . $barra;
        }
        $files = Storage::files($pathUp);
        $direct = Storage::Directories($pathUp);
        foreach ($files as $arquivo) {
            $localArq = str_replace($path, "", $arquivo);
            $fileinfo = DB::table('arquivos')
                        ->select('*')
                        ->where('download', '=', $localArq)
                        ->where('idusuario', '=', $user_id)
                        ->orderBy("id")
                        ->get();
            foreach ($fileinfo as $info) {
                array_push($arquivos, array(
                "id"=>$info->id,
                "name"=>$info->nome,
                "path"=>$info->pasta,
                "ext"=>$info->ext,
                "size"=>$helper->tamanho_arquivo($info->size),
                "mime"=>$mimeIcon->font_icon($info->mime),
                "upload"=>$info->created_at,
                "download"=>$info->download
                ));
            }
        }
        foreach ($direct as $dir) {
            $folder = explode("/", $dir);
            $readFolder = explode($path, $dir);
                array_push($arquivos, array(
                "name"=>$folder[count($folder)-1],
                "mime"=>$mimeIcon->font_icon('folder'),
                "type"=>'folder',
                "read"=>$readFolder[count($readFolder)-1]
                ));
        }
        return view('home')->with("arquivos", $arquivos);
    }

    public function download($file = ''){
        $user_id = Auth::id();
        if($file){
            $files = Storage_path() .'/app/upload/'. $user_id . '/' . $file;
            return response()->download($files);
        } else {
            return redirect('/');
        }
    }

    public function createFolder(Request $request){
        $folder = new Folder();
        $barra = '/';
        $user_id = Auth::id();
        $path = "upload" . $barra . $user_id;
        $uri = $request->input("uriFolder");
        $uriTratada = str_replace("/path/", "", $request->input("uriFolder"));
        $nameFolder = $request->input("nameFolder");
        $privacityFolder = $request->input("privacityFolder");
        $directory;

        if($nameFolder){
            $folder->nome = $nameFolder;
            $folder->privacidade = $privacityFolder;
            if(!($uri === "/" || $uri ==="/home" )){
                $directory = $path . $barra . $uriTratada . $barra . $nameFolder;
            } else {
                $directory = $path . $barra . $nameFolder;
            }
            Storage::makeDirectory($directory);
        }
        $test = [
        "uri"=>$uri,
        "name"=>$nameFolder,
        "privacidade"=>$privacityFolder,
        "Folder"=>$folder
        ];

        return redirect($uri);
    }

    public function permissao(){

    }

}
