<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at','DESC')->get();
        
        return view('pages.product', [
            'title' => 'All Product - Laramerce',
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
        return view('pages.product-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->file('image')) {
                $image = Storage::disk('public')->putFile(
                    'public/product',
                    $request->file('image')
                );
            }
    
            Product::create([
                'name' => $request->product,
                'price' => $request->price,
                'image' => $request->file('image') ? substr($image, 7) : null,
            ]);
    
            DB::commit();
            return redirect(route('product.index'))->withSuccess('Product created successfully!');
        } catch (\Exception $errors) {
            DB::rollback();
            return redirect()->back()->withErrors('Product created failed!')->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('pages.product-edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        DB::beginTransaction();
        try {
            $product->name = $request->product;
            $product->price = $request->price;
            
            if ($request->file('image')) {
                Storage::disk('public')->delete($product->image);
                
                $image = Storage::disk('public')->putFile(
                    'public/product',
                    $request->file('image')
                );
            }

            $product->image = $request->file('image') ? substr($image, 7) : null;
            $product->update();

            DB::commit();
            return redirect(route('product.index'))->withSuccess('Product updated successfully!');
        } catch (\Exception $errors) {
            DB::rollback();
            return redirect()->back()->withErrors('Product updated failed!')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->image);
        $product->delete();

        return redirect(route('product.index'))->withSuccess('Product deleted successfully!');
    }
}
