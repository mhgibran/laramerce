@extends('layouts.app')

@prepend('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endprepend

@section('content')
<div class="container-fluid">
    <div class="row">
        <x-sidemenu></x-sidemenu>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Transaction Data</h1>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Transaction Number</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Create At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $key => $transaction)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $transaction->number }}</td>
                                <td>{{ \Carbon\Carbon::parse($transaction->date)->locale('id')->isoFormat('DD/MM/YYYY') }}</td>
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ count($transaction->items) }}</td>
                                <td>{{ 'Rp ' . number_format($transaction->total) }}</td>
                                <td>{{ \Carbon\Carbon::parse($transaction->created_at)->locale('id')->isoFormat('DD/MM/YYYY H:mm') }}</td>
                                <td>
                                    <a href="{{ route('transaction.show', $transaction->id) }}">
                                        See Details
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">No transaction data found!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
