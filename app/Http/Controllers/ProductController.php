<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Route;
use Str;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::where("status", "<>", 2)
                ->paginate(100);
        $products->setPath(Route::currentRouteAction());
        return view('products/index', array("products" => $products));
    }

    public function _new()
    {
        return view('products/add');
    }

    public function _edit(Request $request, $id)
    {
        $product = Product::find($id);
        return view('products/edit',["product"=>$product]);
    }

    public function add(Request $request){
        $data = array();
        $data["name"] = $request->input("name");
        $data["description"] = $request->input("description");
        $data["price"] = $request->input("price");

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric']
        ]);

        if ($validator->fails()) {
            return redirect('admin/products/new?err=1')->withErrors($validator)->withInput();
        }

        $product = new Product();
        $product->name=$data["name"];
        $product->slug=Str::slug($product->name,"-");
        $product->description=$data["description"];
        $product->price=$data["price"];
        $product->status=1;
        $product->save();

        return redirect("admin/products");
    }

    public function edit(Request $request){
        $data = array();
        $id=$request->input("id");
        $data["name"] = $request->input("name");
        $data["description"] = $request->input("description");
        $data["price"] = $request->input("price");

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric']
        ]);

        if ($validator->fails()) {
            return redirect('admin/products/new?err=1')->withErrors($validator)->withInput();
        }

        $product = Product::find($id);
        $product->name=$data["name"];
        $product->description=$data["description"];
        $product->price=$data["price"];
        $product->save();

        return redirect("admin/products/{$id}");
    }

    public function delete(Request $request)
    {
        $id=$request->input("id");
        $user = User::find($id);
        $user->delete();
        return response()->json($user);
    }

}
