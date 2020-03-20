<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Media;
use Illuminate\Support\Facades\Validator;
use Route;
use Str;

class MediaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index(Request $request)
    {
        $id=$request->input("id");
        Media::where("model_id",$id)->delete();
        $product = Product::find($id);

     
        $product->addMedia($request->file('file'))->toMediaCollection('images');
        $product->save();
        $mediaItems = $product->getMedia("images");
        $media_obj = new \stdClass();
        $media_obj->success=1;
        $media_obj->url=$mediaItems[0]->getFullUrl();
        return response()->json($media_obj);
    }

    public function delete(Request $request)
    {
        $id=$request->input("id");
        $product = Product::find($id);
        $m = $product->getFirstMedia("images");
        Media::where("model_id",$id)->delete();
        return response()->json($m);
    }

}
