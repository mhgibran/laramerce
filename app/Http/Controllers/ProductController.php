<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        return view('pages.product', [
            'title' => 'All Product - Laramerce',
            'products' => Product::orderBy('created_at','DESC')->get()
        ]);
    }

    public function create()
    {
        return view('pages.product-create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'price' => 'required|integer',
            'image' => 'required|image|max:2048' 
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            
            $product = Product::create($validator->validated());

            if ($request->file('image')) {
                $image = Storage::disk('public')->putFile(
                    'public/product',
                    $request->file('image')
                );

                $product->update([
                    'image' => substr($image, 7)
                ]);
            }
    
            DB::commit();
            return redirect(route('product.index'))->withSuccess('Product created successfully!');
        } catch (\Exception $errors) {
            DB::rollback();
            return redirect()->back()->withErrors('Product created failed!')->withInput();
        }
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('pages.product-edit', [
            'product' => $product
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'price' => 'required|integer',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $product->update($validator->validated());
            
            if ($request->file('image')) {
                Storage::disk('public')->delete($product->image);
                
                $image = Storage::disk('public')->putFile(
                    'public/product',
                    $request->file('image')
                );

                $product->update([
                    'image' => substr($image, 7)
                ]);
            }
            
            DB::commit();
            return redirect(route('product.index'))->withSuccess('Product updated successfully!');
        } catch (\Exception $errors) {
            DB::rollback();
            return redirect()->back()->withErrors('Product updated failed!')->withInput();
        }
    }

    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->image);
        $product->delete();

        return redirect(route('product.index'))->withSuccess('Product deleted successfully!');
    }
}
