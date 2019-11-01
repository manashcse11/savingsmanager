<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Type;
use App\Organization;
use App\Status;
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
        $transaction = new Transaction();
        $data['users'] = User::orderby('name')->get();
        $data['types'] = Type::orderby('name')->get();
        $data['organizations'] = Organization::orderby('name')->get();
        $data['statuses'] = Status::orderby('name')->get();
        $data['type'] = Type::where('slug', $request->slug)->first();
        $data['transactions'] = $transaction->get_transactions($data['type']['id'], $request->all());
        return view('transaction.list', $data);
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
            'interest_rate' => 'required|numeric',
        ]);
        $transaction = new Transaction();
        $transaction->user_id = $request->user_id;
        $transaction->type_id = $request->type_id;
        $transaction->organization_id = $request->organization_id;
        $transaction->amount = $request->amount;
        $transaction->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $transaction->duration = $request->duration;
        $transaction->interest_rate = $request->interest_rate;
        $transaction->auto_renewal = $request->auto_renewal ? $request->auto_renewal : 0;
        $transaction->mature_date = Carbon::parse($request->start_date)->addYears($request->duration)->format('Y-m-d');
        if($transaction->save()){
            $request->session()->flash('status', 'Transaction added successfully!');
            return redirect()->route('transaction.create');
        }
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
        $data['users'] = User::orderby('name')->get();
        $data['types'] = Type::orderby('name')->get();
        $data['organizations'] = Organization::orderby('name')->get();
        $data['transaction'] = Transaction::find($id);
        return view('transaction.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'start_date' => 'required',
            'duration' => 'required|numeric',
            'interest_rate' => 'required|numeric',
        ]);

        $transaction->user_id = $request->user_id;
        $transaction->type_id = $request->type_id;
        $transaction->organization_id = $request->organization_id;
        $transaction->amount = $request->amount;
        $transaction->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $transaction->duration = $request->duration;
        $transaction->interest_rate = $request->interest_rate;
        $transaction->auto_renewal = $request->auto_renewal ? $request->auto_renewal : 0;
        $transaction->mature_date = Carbon::parse($request->start_date)->addYears($request->duration)->format('Y-m-d');
        if($transaction->save()){
            $type = Type::find($transaction->type_id);
            $request->session()->flash('status', 'Transaction saved successfully!');
            return redirect()->route('transaction.index', ['slug' => $type->slug]);
        }
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

    /**
     * Non conventional Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, Transaction $transaction)
    {
        $type = Type::find($transaction->type_id);
        if($transaction->delete()){
            $request->session()->flash('status', 'Transaction has been deleted!');
            return redirect()->route('transaction.index', ['slug' => $type->slug]);
        }
    }
}
