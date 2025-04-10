<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function showProduct()
    {
        $product = Product::get();
        return view('contact.insertByAjax', compact('product'));
    }
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'price' => 'required|numeric'
        ]);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);
        // dd($request);

        return redirect('/contact.insertByAjax')->with('status', 'Inserted');
    }
    public function deleteproduct(int $id)
    {   
        $product = Product::find($id);
        // dd($product);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }   
        $product->delete();
        return response()->json(['success' => 'Product deleted successfully']);

    }
}