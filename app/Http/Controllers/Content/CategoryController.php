<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $data = Category::paginate(request()->input('results', 3));    
        return response()->json($data, 200);       
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->save();

        return response()->json([
            'message' => 'Category telah dibuat.'
        ], 201);
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category, 200);  
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update([
            'name'     => $request->name,
        ]);

        return response()->json([
            'message' => 'Category berhasil di update.'
        ], 200);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json([
            'message' => 'Category sudah di hapus.'
        ], 200);
    }
}
