<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function show()
    {
        return view('contact.insertByAjax');
    }
    public function showProduct()
    {
        return Product::orderBy('id','desc')->get();
        // $product = Product::get();
        // return view('contact.insertByAjax', compact('product'));
    }
    public function storeProduct(Request $request)
    {
        $tbl = new Product;
        parse_str($request->input('data'),$formData);
        $tbl->name=$formData['name'];
        $tbl->price=$formData['price'];
        if(empty($formData['id'])||($formData['id']==""))
        $tbl->save();
      else{
        $tbl=Product::find($formData['id']);
        $tbl->name=$formData['name'];
        $tbl->price=$formData['price'];
        $tbl->update();
      }
        echo "data successfully Inserted";
        // $request->validate([
        //     'name' => 'required|max:255|string',
        //     'price' => 'required|numeric'
        // ]);

        // Product::create([
        //     'name' => $request->$formData['name'],
        //     'price' => $request->$formData['price'],
        // ]);
       
        
        // return redirect('/contact.insertByAjax')->with('status', 'Inserted');

    }
    public function deletelProduct(Request $req){
        product::where('id',$req->id)->delete(); 
        echo "data delted succesfully";
    }
    // public function deleteproduct(int $id)
    // {   
        
    //     $product = Product::findOrFail($id);
    //     dd($product);   
    //     if (!$product) {
    //         return response()->json(['error' => 'Product not found'], 404);
    //     }   
    //     $product->delete();
    //     return response()->json(['success' => 'Product deleted successfully']);

    // }
    public function editProduct(Request $req){
        return Product::find($req->id);   
     }
}