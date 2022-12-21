<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with(['product'])
                ->where('user_id',Auth::user()->id)
                ->get();

        return view('pages.cart', [
            'title' => 'Cart - Laramerce',
            'carts' => $carts
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'productId' => 'required|exists:products,id' 
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            Cart::updateOrCreate(
                [
                    'product_id' => $request->productId,
                    'user_id' => Auth::user()->id
                ],
                [
                    'quantity' => DB::raw('quantity+1')
                ]
            );

            DB::commit();
            return redirect(route('cart.index'))->withSuccess('Cart added successfuly!');
        } catch (\Exception $error) {
            DB::rollback();
            return redirect()->back()->withErrors($error->getMessage())->withInput();
        }
    }

    public function update(Request $request, $prefix, $id)
    {
        try {
            DB::beginTransaction();
            
            $cart = Cart::findOrFail($id);
     
            if ($prefix == 'subtract') {
                if ($cart->quantity > 1) {
                    $cart->update([
                        'quantity' => $cart->quantity - 1
                    ]);
                } else {
                    $cart->delete();
                }
            }
    
            if ($prefix == 'plus') {
                $cart->update([
                    'quantity' => $cart->quantity + 1
                ]);
            }
    
            if ($prefix == 'remove') {
                $cart->delete();
            }

            DB::commit();
            return redirect()->back()->withSuccess('Cart update successfuly!');
        } catch (\Exception $error) {
            DB::rollback();
            return redirect()->back()->withErrors($error->getMessage())->withInput();
        }
    }
}
