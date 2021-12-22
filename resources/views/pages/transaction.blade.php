@extends('layouts.app')

@section('content')
<div class="container">
    <x-alert></x-alert>
    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="{{ asset('logo.jpg') }}" alt="Logo" width="72"
            height="72">
        <h2>My Transaction</h2>
        <p class="lead">Now you can shop online wherever you are, happy shopping!</p>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Transaction Number</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $key => $transaction)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $transaction->number }}</td>
                        <td>{{ \Carbon\Carbon::parse($transaction->date)->locale('id')->isoFormat('DD/MM/YYYY') }}</td>
                        <td>{{ 'Rp ' . number_format($transaction->total) }}</td>
                        <td>
                            <a href="{{ route('transaction.show', $transaction->id) }}">
                                See Details
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Your transaction is empty! <a href="{{ route('home') }}">Let's start shopping!</a></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
