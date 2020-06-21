<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Alert;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $products = Product::paginate(20);
        return view('administrator.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('administrator.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'name' => 'required|min:3',
            'category_id' => 'required',
            'price' => 'required|integer',
            'weight' => 'required|integer',
            'stock' => 'required|integer',
            'description' => 'required',
            'image' => 'required|image|mimes:png,jpeg,jpg'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = time() . $file->getClientOriginalName();
            $destination = public_path('/uploads/products');
            $file->move($destination, $file_name);
            $product = Product::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'category_id' => $request->category_id,
                'price' => $request->price,
                'weight' => $request->weight,
                'stock' => $request->stock,
                'description' => $request->description,
                'image' => $file_name,
            ]);
        }

        Alert::success('Berhasil!', 'Produk berhasil ditambahkan!');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        return view('administrator.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'category_id' => 'required',
            'price' => 'required|integer',
            'weight' => 'required|integer',
            'stock' => 'required|integer',
            'description' => 'required',
            'image' => 'nullable|image|mimes:png,jpeg,jpg'
        ]);

        $product = Product::find($id);

        $file_name = $product->image;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = time() . $file->getClientOriginalName();
            $destination = public_path('/uploads/products');
            $file->move($destination, $file_name);
            File::delete(storage_path('app/public/uploads/products/' . $product->image));
        }
        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'price' => $request->price,
            'weight' => $request->weight,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $file_name,
        ]);

        Alert::success('Berhasil!', 'Produk berhasil diupdate!');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        Alert::toast('Produk berhasil dinonaktifkan.', 'warning');
        return redirect()->back();
    }

    public function show_trash()
    {
        $products = Product::onlyTrashed()->paginate(20);
        return view('administrator.product.trash', compact('products'));
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->where('id', $id)->first();
        $product->restore();
        Alert::toast('Produk berhasil diaktifkan!', 'success');
        return redirect()->back();
    }

    public function burn($id)
    {
        $product = Product::withTrashed()->where('id', $id);
        $product->forceDelete();

        Alert::toast('Produk berhasil dihapus!', 'warning');
        return redirect()->back();
    }
}
