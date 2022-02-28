<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Product as ProductResource;

use App\Product;
use Auth;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function index()
    {
        $product = Product::paginate(15);
        return ProductResource::collection($product);
    }

    public function store(ProductRequest $request)
    {
        try {
        	$product = Product::create($request->all());
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error'=>$exception->getMessage()]);
        }
        return new ProductResource($product);
    }


    public function show($id)
    {
        try {
           $product = Product::where('id', $id)->get();
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error'=>$exception->getMessage()]);
        }
        return new ProductResource($product);
    }


    public function update(ProductRequest $request, $id)
    {
        try {
        	$product = Product::findOrFail($id);
        	$product->nama = $request->nama;
        	$product->jumlah = $request->jumlah;
        	$product->harga = $request->harga;
        	$product->update();
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error'=>$exception->getMessage()]);
        }
        return new ProductResource($product);
    }

    public function destroy($id)
    {
         try {
        	$product = Product::destroy($id);
        	return response()->json(['status' => 'success', 'product' => $product]);
        } catch (Exception $e) {
        	throw new HttpException(500, $e->getMessage());
        }
    }
}