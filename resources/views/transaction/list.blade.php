@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-info">
                <div class="card-header">
                    Transaction List: {{$type->name}}
                    <a href="{{ route('transaction.create') }}" class="badge badge-success">Add New</a>
                </div>
                @include('transaction.partials.list.' . $type->slug)                
            </div>
        </div>
    </div>
</div>
@endsection
