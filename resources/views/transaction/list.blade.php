@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Transaction List</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="vertical-align: top !important; " scope="col">#</th>
                                <th style="vertical-align: top !important; " scope="col">
                                    Type
                                    <select class="form-control form-control-sm">
                                        <option>All</option>
                                        <option>DPS</option>
                                        <option>Sanchaypatra</option>
                                    </select>
                                </th>
                                <th style="vertical-align: top !important; " scope="col">
                                    Organization
                                    <select class="form-control form-control-sm">
                                        <option>All</option>
                                        <option>DBBL</option>
                                        <option>Post Office</option>
                                        <option>BD Bank</option>
                                        <option>EBL</option>
                                    </select>
                                </th>
                                <th style="vertical-align: top !important; " scope="col">Amount</th>
                                <th style="vertical-align: top !important; " scope="col">Start Date</th>
                                <th style="vertical-align: top !important; " scope="col">Duration</th>
                                <th style="vertical-align: top !important; " scope="col">
                                    Status
                                    <select class="form-control form-control-sm">
                                        <option>All</option>
                                        <option>Running</option>
                                        <option>Matured</option>
                                    </select>
                                </th>
                                <th style="vertical-align: top !important; " scope="col">
                                    Mature Date
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button type="button" class="btn btn-primary btn-sm">Search</button>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>DPS</td>
                                <td>EBL</td>
                                <td>10000</td>
                                <td>03 September, 2019</td>
                                <td>5</td>
                                <td>Running</td>
                                <td>03 September, 2024</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>DPS</td>
                                <td>EBL</td>
                                <td>5000</td>
                                <td>03 September, 2019</td>
                                <td>5</td>
                                <td>Running</td>
                                <td>03 September, 2024</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Sanchaypatra</td>
                                <td>BD Bank</td>
                                <td>100000</td>
                                <td>09 September, 2019</td>
                                <td>5</td>
                                <td>Running</td>
                                <td>09 September, 2024</td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>San</td>
                                <td>DBBL</td>
                                <td>10000</td>
                                <td>03 September, 2019</td>
                                <td>5</td>
                                <td>Running</td>
                                <td>03 September, 2024</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
