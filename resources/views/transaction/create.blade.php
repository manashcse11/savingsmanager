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
                            <select name="user_id" class="form-control">
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type_id">Type</label>
                            <select name="type_id" class="form-control">
                                @foreach ($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="organization_id">Organization</label>
                            <select name="organization_id" class="form-control">
                                @foreach ($organizations as $organization)
                                    <option value="{{$organization->id}}">{{$organization->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input class="form-control" type="text" name="amount" placeholder="Taka">
                        </div>
                        <div id="date_picker" class="date_picker form-group">
                            <label for="user_id">Start Date</label>
                            <datepicker name="start_date" input-class="form-control"></datepicker>
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <input class="form-control" type="text" name="duration" placeholder="Years">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
