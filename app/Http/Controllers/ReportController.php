<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->input('start', Carbon::now()->subDays(30)->format('Y-m-d'));
        $end = $request->input('end', Carbon::now()->format('Y-m-d'));

        $transactions = Transaction::whereDate('created_at','>=',$start)
                        ->whereDate('created_at','<=',$end)
                        ->get();

        return view('pages.report', [
            'title' => 'Transaction Report - Laramerce',
            'transactions' => $transactions,
            'start' => $start,
            'end' => $end
        ]);
    }
}
