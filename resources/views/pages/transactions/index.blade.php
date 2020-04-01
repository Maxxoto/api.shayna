@extends('layouts.default')

@section('content')
@if (session('status-success'))
<div class="alert alert-success">
    {{ session('status-success') }}
</div>
@endif

@if (session('status-danger'))
<div class="alert alert-danger">
    {{ session('status-danger') }}
</div>
@endif

<div class="orders">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Daftar Transaksi</h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Nomor</th>
                                    <th>Total Transaksi</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->id }} </td>
                                    <td>{{ $transaction->name }} </td>
                                    <td>{{ $transaction->email }} </td>
                                    <td>{{ $transaction->number }} </td>
                                    <td>Rp.{{ $transaction->transaction_total }}</td>
                                    <td>
                                        @if($transaction->transaction_status == 'PENDING')
                                        <span class="badge badge-warning">
                                        @elseif($transaction->transaction_status == 'SUCCESS')
                                        <span class="badge badge-success">
                                        @elseif($transaction->transaction_status == 'FAILED')
                                        <span class="badge badge-danger">
                                        @else
                                        <span>
                                            @endif
                                            {{ $transaction->transaction_status }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($transaction->transaction_status == 'PENDING')
                                        <a href="{{ route('transactions.status',$transaction->id)}}?status=SUCCESS"
                                        class="btn btn-success btn-sm">
                                        <i class="fa fa-check"></i>
                                        </a>
                                        <a href="{{ route('transactions.status',$transaction->id)}}?status=FAILED"
                                            class="btn btn-warning  btn-sm">
                                            <i class="fa fa-times"></i>
                                        </a>
                                        @endif
                                        <a href="{{ route('transactions.show', $transaction->id) }}" data-remote="{{ route('transactions.show', $transaction->id) }}"
                                            data-toggle="modal" data-target="#mymodal"
                                            data-title="Detail Transaksi {{ $transaction->uuid}}"
                                            class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <a href="{{ route('transactions.edit', $transaction->id) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil"></i>
                                        </a>


                                        <form action="{{ route('transactions.destroy', $transaction->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center p-5">
                                        Data tidak tersedia
                                    </td>
                                </tr>


                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
