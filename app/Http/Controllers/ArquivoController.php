<?php

namespace ceu\Http\Controllers;

use Illuminate\Http\Request;
use ceu\Http\Models\Arquivo;
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
        $uri = urldecode($request->input("uriFolder"));
        $pathUp = "upload" . $barra . $user_id;
        $pathInfo = '/';
        $subPath = "";
        if(!($uri === "/" || $uri ==="/home" )){
                $subPath = str_replace("/path/", "", urldecode($request->input("uriFolder")));
                $download = $subPath . $barra;
                $pathInfo = $subPath;
                $pathUp .= $barra . $subPath;
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
    
    public function perfil($id, $uri = null){
        
        $mimeIcon = new MimeIcon();
        $helper = new Helper();
        $barra = '/';
        $user_id = $id;
        $urifolder = '/';
        $arquivos = array();
        //$fileinfo = new Arquivo();
        if($uri){
            $urifolder = urldecode($uri);
            
        }
        // $files = Storage::files($pathUp);
        // $direct = Storage::Directories($pathUp);
        $files = DB::table('arquivos')->where([['pasta', $urifolder],['idusuario', $user_id]])->orderBy("isfolder", "created_at")->get();
        $user = DB::table('users')->where('id', $user_id)->first();
        foreach ($files as $info) {
                array_push($arquivos, array(
                    "id"=>$info->id,
                    "name"=>$info->nome,
                    "path"=>$info->pasta,
                    "mime"=>$mimeIcon->font_icon($info->mime),
                    "create"=>$info->created_at,
                    "download"=>$info->download,
                    "ext"=>$info->ext,
                    "idusuario"=>$info->idusuario,
                    "size"=>$helper->tamanho_arquivo($info->size),
                    "read"=>$urifolder=="/"?$info->nome:$info->pasta,
                    "isfolder"=>$info->isfolder
                ));
            }
        return view('user')->with(["arquivos" => $arquivos, "user" =>$user]);
    }

    public static function getFiles($uri = null){
        
        $mimeIcon = new MimeIcon();
        $helper = new Helper();
        $barra = '/';
        $user_id = Auth::id();
        $urifolder = '/';
        $dadFolder = '/';
        //$fileinfo = new Arquivo();
        if($uri){
            $urifolder = urldecode($uri);
            $r = explode('/', $uri);
            $dadFolder = str_replace($r[count($r)-1],'',$uri);
        }
        $arquivos = array();

        // $files = Storage::files($pathUp);
        // $direct = Storage::Directories($pathUp);
        $files = DB::table('arquivos')->where([['pasta', $urifolder],['idusuario', $user_id]])->orderBy("isfolder", "created_at")->get();
        foreach ($files as $info) {
                array_push($arquivos, array(
                    "id"=>$info->id,
                    "name"=>$info->nome,
                    "path"=>$info->pasta,
                    "mime"=>$mimeIcon->font_icon($info->mime),
                    "create"=>$info->created_at,
                    "download"=>$info->download,
                    "ext"=>$info->ext,
                    "size"=>$helper->tamanho_arquivo($info->size),
                    "read"=>$urifolder=="/"?$info->nome:$info->pasta,
                    "isfolder"=>$info->isfolder
                ));
            }
        return view('home')->with(["arquivos"=> $arquivos,"canback"=> $dadFolder]);
    }

    public function download($id = ''){
        $request = new Request;
        $uri = urldecode($request->input('uri'));
        $user_id = Auth::id();
        $arquivo = new Arquivo();
        
        $arquivo = DB::table('arquivos')->where('id', $id)->first();
        
        $file = isset($arquivo->download)?$arquivo->download:NULL;
        
        if($file){
            
            $files = Storage_path() .'/app/upload/'. $arquivo->idusuario . '/' . $file;
            
            return response()->download($files);
        } else {
            
            return redirect($uri);
        }
    }

    public function createFolder(Request $request){
        $folder = new Arquivo();
        $barra = '/';
        $user_id = Auth::id();
        $path = "upload" . $barra . $user_id;
        $uri = $request->input("uriFolder");
        $uriTratada = str_replace("/path/", "", urldecode($request->input("uriFolder")));
        $nameFolder = $request->input("nameFolder");
        $privacityFolder = $request->input("privacityFolder");
        $directory;

        if($nameFolder){
            $folder->nome = $nameFolder;
            $folder->privacidade = $privacityFolder;
            $folder->idusuario = $user_id;
            $folder->ext = 'folder';
            $folder->mime = 'folder';
            $folder->size = 0;
            $folder->isfolder = true;
            if(!($uri === "/" || $uri ==="/home" )){
                $super = explode('/', $uri);
                $directory = $path . $barra . $uriTratada . $barra . $nameFolder;
                $folder->pasta = $uriTratada;
                $folder->download = $uriTratada . $barra . $nameFolder;
            } else {
                $directory = $path . $barra . $nameFolder;
                $folder->pasta = $barra;
                $folder->download = $nameFolder;
            }
            $folder->save();
            Storage::makeDirectory($directory);
        }

        return redirect($uri);
    }

    public function delete($id = '', Request $request){
        
        $uri = urldecode($request->input('uri'));
        $user_id = Auth::id();
        $arquivo = new Arquivo();
        $arquivo = DB::table('arquivos')->where('id', $id)->first();
        $file = isset($arquivo->download)?$arquivo->download:false;
        $path = '/upload/'. $user_id . '/';
        $isfolder = isset($arquivo->isfolder)?$arquivo->isfolder:false;
        if($file){
            $pasta = $arquivo->download;
            if($isfolder){
                $arqs = DB::table('arquivos')->where([['pasta', $pasta],['idusuario', $user_id]])->get();
                foreach($arqs as $arq){
                    $dir = $path . $arq->download;
                    DB::table('arquivos')->where([['id', $arq->id], ['idusuario', $user_id]])->delete();
                    Storage::delete($dir);
                }
                $dir = $path.$pasta;
                DB::table('arquivos')->where([['id', $id], ['idusuario', $user_id]])->delete();
                Storage::deleteDirectory($dir);
            }else{
                $dir = $path.$pasta;
                DB::table('arquivos')->where([['id', $id], ['idusuario', $user_id]])->delete();
                Storage::delete($dir);
            }
        }
        
        
        return redirect($uri);
    }
    

}
