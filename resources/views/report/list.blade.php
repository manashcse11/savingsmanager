@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header">
                        Summary Report
                    </div>
                    <div class="card-body overflow-auto">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-bordered font-13">
                            <thead>
                                <tr>
                                    <th class="align-top" scope="col">
                                        #
                                    </th>
                                    <th class="align-top" scope="col">Owner</th>
                                    @foreach ($types as $type)
                                        <th class="align-top" scope="col">{{$type->name}}</th>
                                    @endforeach
                                    <th class="align-top" scope="col">Total Individual</th>
                                    <th class="align-top" scope="col">Grand Total</th>
                                    <th class="align-top" scope="col">Year</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $yr_key => $report)
                                    @foreach ($report['users'] as $user_key => $user_value)
                                        <tr>
                                            @if($loop->index == 0)
                                                <th scope="row" rowspan="{{count($report['users'])}}">{{ $loop->parent->index + 1 }}</th>
                                            @endif
                                            <td>{{$user_value['owner']}}</td>
                                            <td>{{$user_value['dps']}}</td>
                                            <td>{{$user_value['fdr']}}</td>
                                            <td>{{$user_value['individual_total']}}</td>
                                            @if($loop->index == 0)
                                                <td rowspan="{{count($report['users'])}}">{{$report['grand_total']}}</td>
                                                <td rowspan="{{count($report['users'])}}">{{$yr_key}}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
