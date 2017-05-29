<?php

namespace ceu\Http\Controllers;

use ceu\Http\Requests;
use ceu\Support\JsTree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use DB;

class TreeController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function data(Request $request)
    {
        $user_id = Auth::id();
        $id = '/';
        $path = '/';
        if ($request->has('id') and $request->id != '#') {
            $id = $request->id;
        }

        //var_dump(array_merge(Storage::directories('upload/' . $user_id), Storage::files('upload/' . $user_id)));

        // $files = Storage::files($pathUp);
        // $direct = Storage::Directories($pathUp);
        $nodes = [];
        $files = DB::table('arquivos')->where([['pasta', $id],['idusuario', $user_id]])->orderBy("isfolder", "created_at")->get();
        foreach ($files as $file){
            $path = $file->pasta;
            array_push($nodes, $file->download);
        }
        
        
        // $nodes = array_merge(
        //     Storage::directories($id),
        //     Storage::files($id)
        // );

        $tree = new JsTree($nodes, '.');
        $tree->fileIconClass = 'fa fa-file';
        $tree->setExcludedExtensions(['DS_Store', 'gitignore']);
        $tree->setExcludedPaths(['Laravel-wallpapers/.git']);
        $tree->setDisabledExtensions(['md', 'png']);

        return response()->json($tree->build());
    }
}