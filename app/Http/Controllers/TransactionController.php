<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id',Auth::user()->id)->get();

        return view('pages.transaction', [
            'title' => 'My Transaction - Laramerce',
            'transactions' => $transactions
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $carts = Cart::where('user_id',Auth::user()->id)->get();
            $total = 0;

            foreach ($carts as $cart) {
                $total += $cart->quantity * $cart->product->price;
            }
            
            $lastTransaction = Transaction::select('id')
                                ->orderBy('created_at','DESC')
                                ->value('id');
            if (!$lastTransaction) {
                $lastTransaction = 0;
            }

            $transNumber = 'TR' . str_pad($lastTransaction + 1, 8, "0", STR_PAD_LEFT);

            $transaction = Transaction::create([
                'number' => $transNumber,
                'date' => now(),
                'user_id' => Auth::user()->id,
                'total' => $total
            ]);

            for ($i=0; $i < count($carts); $i++) { 
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $carts[$i]['product_id'],
                    'quantity' => $carts[$i]['quantity']
                ]);
            }

            Cart::where('user_id',Auth::user()->id)->delete();

            DB::commit();
            return redirect(route('transaction.index'))->withSuccess('Checkout successfully!');
        } catch (\Exception $errors) {
            DB::rollback();
            return redirect()->back()->withErrors('Checkout failed!')->withInput();
        }
    }

    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);

        if (Auth::user()->roles == 'user') {
            $view = 'pages.transaction-detail';
        } else {
            $view = 'pages.transaction-detail-admin';
        }

        return view($view, [
            'title' => $transaction->number . ' - Laramerce',
            'transaction' => $transaction
        ]);
    }
}
