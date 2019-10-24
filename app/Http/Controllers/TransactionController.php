<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Type;
use App\Organization;
use App\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        dd($request->type_id);
        return view('transaction.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['users'] = User::orderby('name')->get();
        $data['types'] = Type::orderby('name')->get();
        $data['organizations'] = Organization::orderby('name')->get();
        return view('transaction.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'start_date' => 'required',
            'duration' => 'required|numeric',
        ]);
        $transaction = new Transaction();
        $transaction->user_id = $request->user_id;
        $transaction->type_id = $request->type_id;
        $transaction->organization_id = $request->organization_id;
        $transaction->amount = $request->amount;
        $transaction->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $transaction->duration = $request->duration;
        $transaction->mature_date = Carbon::parse($request->start_date)->addYears($request->duration)->format('Y-m-d');
        $transaction->save();
        return redirect('/transaction');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
