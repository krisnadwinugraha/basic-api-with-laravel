<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $data = Product::paginate(request()->input('results', 3));    
        return response()->json($data, 200);       
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        $product = new Product;
        $product->product_category_id = $request->product_category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('img'), $filename);
            $product->image = $filename;
        }

        $product->save();

        return response()->json([
            'message' => 'Product telah dibuat.'
        ], 201);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product, 200);  
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $product->update([
            'product_category_id' => $request->product_category_id,
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image,
        ]);

        return response()->json([
            'message' => 'Product berhasil di update.'
        ], 200);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'message' => 'Product sudah di hapus.'
        ], 200);
    }
}
