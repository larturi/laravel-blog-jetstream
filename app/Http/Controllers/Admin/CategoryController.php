<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.categories.create');
    }


    public function store(Request $request)
    {
        
    }


    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

 
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }


    public function update(Request $request, Category $category)
    {
        //
    }


    public function destroy(Category $category)
    {
        //
    }
}
