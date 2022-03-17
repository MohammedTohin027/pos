<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    //  get category
    public function getCategory(Request $request){
        $categories = Product::with(['category'])->select('category_id')->where('supplier_id', $request->supplier_id)->groupBy('category_id')->get();
        // dd($categories->toArray());
        return response()->json($categories);
    }

    //  get product
    public function getProduct(Request $request){
        $products = Product::where('supplier_id',$request->supplier_id)->where('category_id', $request->category_id)->get();
        // dd($products->toArray());
        return response()->json($products);
    }

    //  get all product
    public function getAllProduct(Request $request){
        $products = Product::where('category_id', $request->category_id)->get();
        // dd($products->toArray());
        return response()->json($products);
    }

    //  get stock
    public function getStock(Request $request){
        $product_qty = Product::where('id', $request->product_id)->first()->quantity;
        // dd($products->toArray());
        return response()->json($product_qty);
    }
}