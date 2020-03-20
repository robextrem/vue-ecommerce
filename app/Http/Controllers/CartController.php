<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;

class CartController extends Controller
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
        return view('cart',["cart"=>Cart::content()]);
    }

    public function add_to_cart(Request $request){
        $id = $request->input("id");
        if($product = Product::where("id", $id)->first()){
            $f_img=$product->getFirstMediaUrl('images');
            Cart::add($product, 1, ["image"=>!empty($f_img)?$f_img:"https://via.placeholder.com/300"]);
            return response()->json($product);
        }
        return response()->json([$id]);
    }

    public function remove_from_cart(Request $request, $row){
        @Cart::remove($row);
        return redirect("cart");
    }

}
