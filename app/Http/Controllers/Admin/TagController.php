<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tag;

class TagController extends Controller
{

    public function __construct() {
        $this->middleware('can:admin.tags.index')->only('index');
        $this->middleware('can:admin.tags.create')->only('create', 'store');
        $this->middleware('can:admin.tags.edit')->only('edit', 'update');
        $this->middleware('can:admin.tags.destroy')->only('destroy');
    }

    public $colors = [
        'blue' => 'Blue',
        'cyan' => 'Cyan',
        'esmerald' => 'Esmerald',
        'indigo' => 'Indigo',
        'lime' => 'Lime',
        'pink' => 'Pink',
        'red' => 'Red',
        'yellow' => 'Yellow', 
    ];
   
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }

   
    public function create()
    {
        return view('admin.tags.create', ['colors' => $this->colors]);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:tags',
            'color' => 'required',
        ]);

        $tag = Tag::create($request->all());
        return redirect()->route('admin.tags.edit', $tag)->with('info', 'Tag created successfully.');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', ['colors' => $this->colors], compact('tag'));
    }

    
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:tags,slug,' . $tag->id,
            'color' => 'required',
        ]);

        $tag->update($request->all());
        return redirect()->route('admin.tags.edit', $tag)->with('info', 'Tag updated successfully');
    }

   
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.tags.index')->with('info', 'Tag deleted successfully');
    }
}
