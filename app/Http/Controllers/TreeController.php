<?php

namespace ceu\Http\Controllers;

use ceu\Http\Requests;
use ceu\Support\JsTree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;

class TreeController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function data(Request $request)
    {
        $user_id = Auth::id();
        $id = 'upload/' . $user_id;
        $path = 'upload/' . $user_id;

        if ($request->has('id') and $request->id != '#') {
            $id = $request->id;
        }

        $nodes = array_merge(
            Storage::directories($id),
            Storage::files($id)
        );

        $tree = new JsTree($nodes, $path);
        $tree->fileIconClass = 'fa fa-file';
        $tree->setExcludedExtensions(['DS_Store', 'gitignore']);
        $tree->setExcludedPaths(['Laravel-wallpapers/.git']);
        $tree->setDisabledExtensions(['md', 'png']);

        return response()->json($tree->build());
    }
}