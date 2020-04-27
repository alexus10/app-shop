<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id')->paginate(10);
        return view('admin.categories.index')->with(compact('categories')); //listado de productos
    }

    public function create()
    {
        return view('admin.categories.create'); //formulario de registro
    }
    
    public function store(Request $request)
    {
        $this->validate($request, Category::$rules, Category::$messages);

        // nuevo categoría en la db, metodo abreviado tomando todos los campos que se envian, asignacion masiva fillable en el modelo
        Category::create($request->all());

        return redirect('/admin/categories');
    }

    public function edit(Category $category)
    {
        //$category = Category::find($id);
        return view('admin.categories.edit')->with(compact('category')); //formulario de edición
    }
    
    public function update(Request $request, Category $category)
    {
        $this->validate($request, Category::$rules, Category::$messages);
        
        // actualizar categoría en la db
        //dd($request->all());
        $category->update($request->all());

        return redirect('/admin/categories');
    }

    public function destroy(Category $category)
    {
        // nuevo producto en la db
        //dd($request->all());
        $category->delete(); //Update

        return back();
    }
}
