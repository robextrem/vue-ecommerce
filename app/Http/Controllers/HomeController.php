<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function product(Request $request, $slug){
        $id = $request->input("id");
        $product = Product::where("status",1)->where("slug", $slug)->first();

        $metas = array(
            "name" => array(
                "title" => $product->name,
                "description" => $product->description,
                "keywords" => ""
            ),
            "property" => array(
                "og:title" => $product->name,
                "og:description" => $product->description,
                "og:image" => $product->getFirstMediaUrl('files'),
                "og:site_name" => config('app.name'),
                "og:url" => url("product/" . $product->slug),
                "og:type" => "website"
            )
        );

        return view('index',["metas"=>$metas]);
    }

    public function add_to_cart(Request $request){
        $id = $request->input("id");
        if($product = Product::where("status",1)->where("id", $id)->first()){
            Cart::add($product, 1);
        }
        return response()->json($product);
    }

}
