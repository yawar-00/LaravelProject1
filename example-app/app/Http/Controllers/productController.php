<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


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
        // $image = $request->file('image');
        // $imageName = $request->name.'-'.uniqid().'.'.$image->getClientOriginalExtension();
        // $image->save(public_path('Upload/products/' . $imageName));
        // $save_url = 'Upload/products/' . $imageName;
            $manager = new ImageManager(new Driver());
            $name_gen = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $img = $manager->read($request->file('image'));
            $img->resize(800, 400);
            $img->save(public_path('Upload/products/' . $name_gen));
            $save_url = 'Upload/products/' . $name_gen;

            $imageData = $save_url;
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $save_url,
        ]);


        if(empty($request->id)||($request->id=="")){
            $tbl->save();
            return response()->json([
                'success' => 'Product saved successfully.',
                'product' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image' => asset($product->image), // Full image URL
                ]
            ]);
        }
      else{
        $tbl=Product::find($request->id);
        if (!$tbl) {
            return response()->json(['status' => 'error', 'message' => 'Product not found'], 404);
        }
        $tbl->name=$request->name;
        $tbl->price=$request->price;
        $tbl->image=$imageName;
        
        $tbl->update();
        return response()->json(['status' => 'success', 'message' => 'Product Updated']);
      }
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