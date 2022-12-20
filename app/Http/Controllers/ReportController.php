<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // $start = $request->input('start', Carbon::now()->subDays(30)->format('Y-m-d'));
        // $end = $request->input('end', Carbon::now()->format('Y-m-d'));

        // $transactions = Transaction::whereDate('created_at','>=',$start)
        //                 ->whereDate('created_at','<=',$end)
        //                 ->get();

        return view('pages.report', [
            'title' => 'Transaction Report - Laramerce',
            // 'transactions' => $transactions,
            // 'start' => $start,
            // 'end' => $end
        ]);
    }

    public function export(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start' => 'required|before_or_equal:end',
            'end' => 'required|after_or_equal:start' 
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $filename = 'TRANSACTION_REPORT_'.date('ymdhis').'.csv';
            $transactions = TransactionItem::with(['transaction','product'])
                            ->whereHas('transaction',function($trx) use ($request) {
                                $trx->whereDate('created_at','>=',$request->start)
                                    ->whereDate('created_at','<=',$request->end);
                            })
                            ->cursor();

            header("Content-type: text/csv");
            header("Content-Disposition: attachment; filename={$filename}");
            $csv = fopen("php://output", "w+");
            fputcsv($csv, [
                'trx_number',
                'trx_date',
                'customer',
                'product',
                'qty',
                'price',
                'subtotal',
            ]);

            foreach ($transactions as $key => $trx) {
                fputcsv($csv, [
                    $trx->transaction->number,
                    $trx->transaction->date,
                    $trx->transaction->user->name,
                    $trx->product->name,
                    $trx->quantity,
                    $trx->product->price,
                    $trx->product->price * $trx->quantity,
                ]);
            }
            
            fclose($csv);
        } catch (\Exception $error) {
            return redirect()->back()->withErrors($error->getMessage())->withInput();
        }
    }
}
