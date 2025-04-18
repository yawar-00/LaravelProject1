<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Storage;

class productController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::latest()->get();
    
        return view('contact.insertByAjax', compact('products'));
    }

  // Edit a product by its ID
  public function edit($id)
  {
      $product = Product::findOrFail($id);
  
      return response()->json([
          'product' => $product
      ]);
  }
  

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:1|max:10',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            // $manager = new ImageManager(new Driver());
           
        
            $name_gen = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
    
            $img =$request->file('image');
            // $img->resize(800, 400);
            $img->move('Upload/products' , $name_gen);
    
            $save_url = 'Upload/products/' . $name_gen;
    
            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'image' => $save_url,
            ]);
            Log::info("chala");
            return response()->json([
                'success' => 'Product saved successfully.',
                'product' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => asset($product->image),
                ]
            ]);
        }
    
        return response()->json(['error' => 'Image upload failed.'], 422);
    }







    
    // Update a product by its ID
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:1|max:10',
            'price' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $product = Product::findOrFail($id);
    
        $product->name = $request->name;
        $product->price = $request->price;
    
        if ($request->hasFile('image')) {
            $manager = new ImageManager(new Driver());
    
            if ($product->image && Storage::exists($product->image)) {
                Storage::delete($product->image);
            }

            if ($product->image) {
                $imagePath = public_path($product->image);
        
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                } else {
                    
                }
            } 
    
            $name_gen = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $img = $manager->read($request->file('image'));
            $img->resize(800, 400);
            $img->save(public_path('Upload/products/' . $name_gen));
    
            $save_url = 'Upload/products/' . $name_gen;
            $product->image = $save_url;
        }
    
        $product->save();
    
        return response()->json([
            'success' => 'Product updated successfully.',
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => asset($product->image),
            ]
        ]);
    }
    


    // Delete a product by its ID
    public function delete($id)
    {
        $product = Product::find($id);
    
        if (!$product) {
            // Log::error("Product not found with ID: $id");
            return response()->json(['error' => 'Product not found'], 404);
        }
    
    
        if ($product->image) {
            $imagePath = public_path($product->image);
    
            if (File::exists($imagePath)) {
                File::delete($imagePath);
                // Log::info("Image deleted at: $imagePath");
            } else {
                // Log::warning("Image not found at: $imagePath");
            }
        } else {
            // Log::warning("No image field for product: $id");
        }
    
        $product->delete();
        // Log::info("Product deleted: $id");
    
        return response()->json(['success' => 'Product deleted successfully']);
    }
    
}