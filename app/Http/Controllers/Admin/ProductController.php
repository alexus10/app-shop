<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.products.index')->with(compact('products')); //listado de productos
    }

    public function create()
    {
        return view('admin.products.create'); //formulario de registro
    }
    
    public function store(Request $request)
    {
        // validar
        $messages = [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.min' => 'El campo nombre requiere mínimo tres.',
            'description.required' => 'El campod descripción corta es obligatorio.',
            'description.max' => 'El campo descripción corta no puede contener más de 200 caracteres.',
            'price.required' => 'El campo precio es obligatorio.',
            'price.numeric' => 'El campo precio debe ser un valor numérico.',
            'price.min' => 'El campo precio no puede ser un valor negativo.'
        ];

        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0'
        ];
        $this->validate($request, $rules, $messages);

        // nuevo producto en la db
        //dd($request->all());
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->long_description = $request->input('long_description');
        $product->price = $request->input('price');
        $product->save(); //Insert

        return redirect('/admin/products');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.products.edit')->with(compact('product')); //formulario de edición
    }
    
    public function update(Request $request, $id)
    {
        // validar
        $messages = [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.min' => 'El campo nombre requiere mínimo tres.',
            'description.required' => 'El campod descripción corta es obligatorio.',
            'description.max' => 'El campo descripción corta no puede contener más de 200 caracteres.',
            'price.required' => 'El campo precio es obligatorio.',
            'price.numeric' => 'El campo precio debe ser un valor numérico.',
            'price.min' => 'El campo precio no puede ser un valor negativo.'
        ];

        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0'
        ];
        $this->validate($request, $rules, $messages);
        
        // nuevo producto en la db
        //dd($request->all());
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->long_description = $request->input('long_description');
        $product->price = $request->input('price');
        $product->save(); //Update

        return redirect('/admin/products');
    }

    public function destroy($id)
    {
        // nuevo producto en la db
        //dd($request->all());
        $productImages = ProductImage::where('product_id', '=', $id);
        $productImages->delete(); //Delete relacion images

        $product = Product::find($id);
        $product->delete(); //Update

        return back();
    }
}
