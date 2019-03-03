<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductController extends Controller
{
  public function index(){
    $products = Product::all();
    return response()->json($products);
  }

  public function create(Request $request){

    $validatedData = $request->validate([
      'name' => 'required',
      'description' => 'required',
      'serial_number' => 'required'
    ]);

    $newProduct = new Product;
    $newProduct->fill($validatedData);
    $newProduct->save();

    return response()->json($newProduct);

  }

  public function show($id){
    $product = Product::find($id);

    if (empty($product)) {
      return response()->json([
        'error' => 'id inesistente'
      ]);
    }

    return response()->json($product);
  }

  public function update(Request $request, $id){
    $data = $request->all();

    $product = Product::find($id);

    if (empty($product)) {
      return response()->json([
        'error' => 'id inesistente'
      ]);
    }

    $product->update($data);

    return response()->json($product);

  }

  public function destroy($id){
    $product = Product::find($id);

    if (empty($product)) {
      return response()->json([
        'error' => 'id inesistente'
      ]);
    }

      $product->delete();

      return response()->json([]);
    }
}
