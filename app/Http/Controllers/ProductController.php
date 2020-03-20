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

    public function index(Request $request)
    {
        $products = Product::where("status", "<>", 2)
                ->paginate(5);
        $products->setPath("/admin/products");
        return view('products/index', array("products" => $products));
    }

    public function admin()
    {
        return view('admin');
    }

    public function list()
    {
        return response()->json(Product::all());
    }

    public function _new()
    {
        $product = new Product();
        $product->name="New product";
        $product->description="";
        $product->slug="";
        $product->price = 0;
        $product->status = 0; // draft
        $product->save();
        return redirect("/admin/products/{$product->id}");
    }

    public function _edit(Request $request, $id)
    {
        $product = Product::find($id);
        $media = $product->getFirstMediaUrl('images');

        return view('products/edit',["product"=>$product, "media"=>$media]);
    }

    /*
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
    }*/

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
            return redirect("admin/products/{$id}")->withErrors($validator)->withInput();
        }

        $product = Product::find($id);
        $product->name=$data["name"];
        $product->description=$data["description"];
        $product->slug=self::slugname($product->name, $product->id);
        $product->price=$data["price"];
        $product->status=$request->input("status");
        $product->save();


        return redirect("admin/products/{$id}");
    }

    public function delete(Request $request)
    {
        $id=$request->input("id");
        $product = Product::find($id);
        $product->status=2;
        $product->save();
        return response()->json($product);
    }

    public static function slugname($name, $id=null, $i=0){
        $slugname=Str::slug($name,"-");
        $slugname_iteration = $slugname.(($i==0)?"":"-$i");
        $slug_exists=Product::where("slug",$slugname_iteration)->where("id","<>",$id)->count();
        if($slug_exists>0){
            $slugname_iteration=self::slugname($slugname, $id, $i+1);
        }
        return $slugname_iteration ;
    }

}
