<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Route;

class ListController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function products()
    {
        $products = Product::where("status",1)->get();

        $result=[];
        foreach($products as $product){
            $p= new \stdClass();
            $p->id=$product->id;
            $p->name=$product->name;
            $p->price=$product->price;
            $p->slug=$product->slug;
            $p->image=$product->getFirstMediaUrl('images');
            array_push($result, $p);
        }

        return response()->json($result);
    }

    public function product(Request $request, $slug)
    {
        $product = Product::where("status", 1)->where("slug",$slug)->first();
        $p= new \stdClass();
        $p->id=$product->id;
        $p->name=$product->name;
        $p->price=$product->price;
        $p->slug=$product->slug;
        $p->image=$product->getFirstMediaUrl('images');

        return response()->json($p);
    }


}
