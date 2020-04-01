<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

use Illuminate\Http\Request;


class TransactionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::all();

        return view('pages.transactions.index')->with(['transactions' => $transactions ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Transaction::with('details.product')->findOrFail($id);

        return view('pages.transactions.show')->with([
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Transaction::findOrFail($id);

        return view('pages.transactions.edit')->with([
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = Transaction::findOrFail($id);
        $item->update($data);

        return redirect()->route('transactions.index')->with('status-success','Berhasil menghapus data transaksi : '.$item->name);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transactions.index')->with('status-success','Berhasil menghapus data transaksi : '.$transaction->name);
    }

    public function setStatus(Request $request, $id){
        $request->validate([
            'status' => 'required|in:PENDING,SUCCESS,FAILED'
        ]);

        $item = Transaction::findOrFail($id);
        $item->transaction_status = $request->status;

        $item->save();

        return redirect()->route('transactions.index')->with('status-success','Berhasil merubah status '.$item->name.' menjadi '.$request->status);
    }
}
