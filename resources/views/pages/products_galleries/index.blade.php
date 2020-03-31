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
                    <h4 class="box-title">Daftar Foto Barang</h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Produk</th>
                                    <th>Foto</th>
                                    <th>Default</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->id }} </td>
                                    <td>{{ $product->product->name }}</td>
                                    <td>
                                        <img src="{{ $product->photo }}" alt="">
                                    </td>
                                    <td>{{ $product->is_default ? 'Ya':'Tidak' }}</td>
                                    <td>


                                        <form action="{{ route('product-galleries.destroy', $product->id) }}" method="POST" class="d-inline">
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
