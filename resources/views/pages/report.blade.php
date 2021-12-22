@extends('layouts.app')

@prepend('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endprepend

@section('content')
<div class="container-fluid">
    <div class="row">
        <x-sidemenu></x-sidemenu>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
                <h1 class="h2">Transaction Reports</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            onclick="exportAsExcel()">
                            Export
                        </button>
                    </div>
                </div>
            </div>
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <form action="{{ route('report.index') }}" method="GET">
                    <div class="row">
                        <div class="col">
                            <label for="start">Start Date</label>
                            <input type="date" id="start" name="start" class="form-control" placeholder="Start Date"
                                value="{{ $start ?? now()->format('Y-m-d') }}">
                        </div>
                        <div class="col">
                            <label for="end">End Date</label>
                            <input type="date" id="end" name="end" class="form-control" placeholder="End Date"
                                value="{{ $end ?? now()->format('Y-m-d') }}">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-success"
                                style="margin-top: 1.7em">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table id="reportTable" class="table table-bordered table-sm">
                    <thead>
                        <tr class="exludeRow">
                            <th>No.</th>
                            <th>Transaction Number</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Create At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $key => $transaction)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $transaction->number }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaction->date)->locale('id')->isoFormat('DD/MM/YYYY') }}
                            </td>
                            <td>{{ $transaction->user->name }}</td>
                            <td>{{ 'Rp ' . number_format($transaction->total) }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaction->created_at)->locale('id')->isoFormat('DD/MM/YYYY H:mm') }}
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="5">Product Items:</td>
                        </tr>
                        @php
                            $subtotal = 0;
                        @endphp
                        @forelse ($transaction->items as $q => $product)
                            @php
                                $subtotal += $product->quantity * $product->product->price;
                            @endphp
                            <tr>
                                <td></td>
                                <td colspan="2">{{ $product->product->name }}</td>
                                <td>
                                    {{ $product->quantity }} x {{ 'Rp. ' . number_format($product->product->price) }}
                                </td>
                                <td colspan="2">{{ 'Rp. ' . number_format($subtotal) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Product is empty!</td>
                            </tr>
                        @endforelse
                        @empty
                        <tr>
                            <td colspan="6">No transaction data found!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
    </div>
</div>
</div>
@endsection

@push('script')
<script src="{{ asset('js/jquery.table2excel.min.js') }}"></script>
<script>
    function exportAsExcel() {
        $("#reportTable").table2excel({
            // exclude: '.exludeRow',
            name: 'Transaction Report',
            filename: 'TRANSACTION_REPORT_{{ date("ymdhis") }}',
            fileext: '.xlsx',
            preserveColors: true,
        }); 
    }
</script>
@endpush