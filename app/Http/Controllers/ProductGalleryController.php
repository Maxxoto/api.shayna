<?php

namespace App\Http\Controllers;


use App\Http\Requests\ProductGalleryRequest;

use App\Models\Product;
use App\Models\ProductGallery;

use Illuminate\Http\Request;

class ProductGalleryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ProductGallery::with('product')->get();

        return view('pages.products_galleries.index')->with([
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();

        return view('pages.products_galleries.create')->with([
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductGalleryRequest $request)
    {
        $data = $request->all();
        $data['photo'] = $request->file('photo')->store(
            'assets/product', 'public'
        );
        
        ProductGallery::create($data);
        
        return redirect()->route('product-galleries.index')->with('status-success','Berhasil menambahkan foto barang pada ID : '.$data['products_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductGalleryController  $productGalleryController
     * @return \Illuminate\Http\Response
     */
    public function show(ProductGalleryController $productGalleryController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductGalleryController  $productGalleryController
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductGalleryController $productGalleryController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductGalleryController  $productGalleryController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductGalleryController $productGalleryController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductGalleryController  $productGalleryController
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = ProductGallery::findOrFail($id);
        $product->delete();
        return redirect()->route('product-galleries.index')->with('status-success','Berhasil menghapus foto barang');
    }
}
