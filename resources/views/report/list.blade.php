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
{{--                                @foreach ($transactions as $tr)--}}
                                <tr>
                                    <th scope="row" rowspan="2">1</th>
                                    <td>Manash</td>
                                    <td>600000</td>
                                    <td>750000</td>
                                    <td>135000</td>
                                    <td rowspan="2">200000</td>
                                    <td rowspan="2">2019</td>
                                </tr>
                                <tr>
                                    <td>Manash</td>
                                    <td>600000</td>
                                    <td>750000</td>
                                    <td>135000</td>
                                </tr>
                                <tr>
                                    <th scope="row" rowspan="2">2</th>
                                    <td>Manash</td>
                                    <td>600000</td>
                                    <td>750000</td>
                                    <td>135000</td>
                                    <td rowspan="2">200000</td>
                                    <td rowspan="2">2020</td>
                                </tr>
                                <tr>
                                    <td>Manash</td>
                                    <td>600000</td>
                                    <td>750000</td>
                                    <td>135000</td>
                                </tr>
{{--                                @endforeach--}}
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
