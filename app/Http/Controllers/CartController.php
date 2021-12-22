<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        $validated = $request->validate([
            'productId' => 'required|exists:products,id',
        ]);

        Cart::updateOrCreate(
            [
                'product_id' => $request->productId,
                'user_id' => Auth::user()->id
            ],
            [
                'quantity' => DB::raw('quantity+1')
            ]
        );

        return redirect(route('cart.index'))->withSuccess('Cart added successfuly!');
    }

    public function update(Request $request, $prefix, $id)
    {
        $cart = Cart::find($id);

        if ($prefix == 'subtract') {
            if ($cart->quantity > 1) {
                $cart->quantity = $cart->quantity - 1;
                $cart->update();
            } else {
                $cart->delete();
            }
        }

        if ($prefix == 'plus') {
            $cart->quantity = $cart->quantity + 1;
            $cart->update();
        }

        if ($prefix == 'remove') {
            $cart->delete();
        }

        return redirect()->back()->withSuccess('Cart update successfuly!');
    }
}
