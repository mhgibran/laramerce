<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = Transaction::orderBy('created_at','DESC')->get();
        
        return view('pages.dashboard', [
            'title' => 'Dashboard - Laramerce',
            'transactions' => $transactions
        ]);
    }
}
