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
                                    <option value="{{$user->id}}" {{ $user->id == old('user_id') ? 'selected' : '' }}>{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type_id">Type</label>
                            <select name="type_id" class="form-control">
                                @foreach ($types as $type)
                                    <option value="{{$type->id}}" {{ $type->id == old('type_id') ? 'selected' : '' }}>{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="organization_id">Organization</label>
                            <select name="organization_id" class="form-control">
                                @foreach ($organizations as $organization)
                                    <option value="{{$organization->id}}" {{ $organization->id == old('organization_id') ? 'selected' : '' }}>{{$organization->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : ''}}" type="text" name="amount" value="{{ old('amount')}}" placeholder="Put amount here, e.g. 10000">
                            <small class="text-danger">{{ $errors->first('amount') }}</small>
                        </div>
                        <div id="date_picker" class="date_picker form-group">
                            <label for="start_date">Start Date</label>
                            <datepicker name="start_date" input-class="form-control {{ $errors->has('start_date') ? 'is-invalid' : ''}}" value="{{ old('start_date')}}"></datepicker>
                            <small class="text-danger">{{ $errors->first('start_date') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <input class="form-control {{ $errors->has('duration') ? 'is-invalid' : ''}}" type="text" name="duration" placeholder="How many years, e.g. 5 " value="{{ old('duration')}}">
                            <small class="text-danger">{{ $errors->first('duration') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="interest_rate">Interest Rate</label>
                            <input class="form-control {{ $errors->has('interest_rate') ? 'is-invalid' : ''}}" type="text" name="interest_rate" placeholder="Put Interest Rate, e.g. 11.04 " value="{{ old('interest_rate')}}">
                            <small class="text-danger">{{ $errors->first('interest_rate') }}</small>
                        </div>
                        <div class="form-check">
                            <input style="cursor: pointer" type="checkbox" class="form-check-input" id="auto_renewal" name="auto_renewal" value=1 {{ old('auto_renewal') == 1 ? 'checked' : '' }}>
                            <label style="cursor: pointer" class="form-check-label" for="auto_renewal">Auto Renewal</label>
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
