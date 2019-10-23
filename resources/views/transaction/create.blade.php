@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-info">
                <div class="card-header">
                    New Transaction
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('transaction.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="user_id">Name</label>
                            <select name="user_id" class="form-control form-control-sm">
                                <option>DPS</option>
                                <option>Sanchaypatra</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user_id">Type</label>
                            <select name="user_id" class="form-control form-control-sm">
                                <option>DPS</option>
                                <option>Sanchaypatra</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user_id">Organization</label>
                            <select name="user_id" class="form-control form-control-sm">
                                <option>DPS</option>
                                <option>Sanchaypatra</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user_id">Amount</label>
                            <input class="form-control" type="text" placeholder="Default input">
                        </div>
                        <div class="form-group">
                            <label for="user_id">Amount</label>
                            <input class="form-control" type="text" placeholder="Default input">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
