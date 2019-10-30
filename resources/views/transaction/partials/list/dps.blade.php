<div style="overflow-x:auto;" class="card-body">
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<form method="GET" action="{{ route('transaction.index') }}">
    @csrf
    <table style="font-size:12px;" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th style="vertical-align: top !important; " scope="col">
                    #<input type="hidden" name="slug" value="{{$type->slug}}">
                </th>
                <th style="vertical-align: top !important; " scope="col">
                    Owner
                    <select name="filter_user_id" class="form-control form-control-sm">
                        <option value="">All</option>
                        @foreach ($users as $user)
                            <option value="{{$user->id}}" {{ $user->id == request('filter_user_id') ? 'selected' : '' }}>{{$user->name}}</option> 
                        @endforeach
                    </select>
                </th>
                <th style="vertical-align: top !important; " scope="col">
                    Organization
                    <select name="filter_organization_id" class="form-control form-control-sm">
                        <option value="">All</option>
                        @foreach ($organizations as $organization)
                            <option value="{{$organization->id}}" {{ $organization->id == request('filter_organization_id') ? 'selected' : '' }}>{{$organization->name}}</option> 
                        @endforeach
                    </select>
                </th>
                <th style="vertical-align: top !important; " scope="col">Monthly Deposit</th>
                <th style="vertical-align: top !important; " scope="col">Paid</th>
                <th style="vertical-align: top !important; " scope="col">Due</th>
                <th style="vertical-align: top !important; " scope="col">Start Date</th>
                <th style="vertical-align: top !important; " scope="col">Duration</th>
                <th style="vertical-align: top !important; " scope="col">Interest Rate</th>
                <th style="vertical-align: top !important; " scope="col">Interest Before Tax</th>
                <th style="vertical-align: top !important; " scope="col">Interest</th>
                <th style="vertical-align: top !important; " scope="col">Total</th>
                <th style="vertical-align: top !important; " scope="col">
                    Status
                    <select name="filter_status_id" class="form-control form-control-sm">
                        <option value="">All</option>
                        @foreach ($statuses as $status)
                            <option value="{{$status->id}}" {{ $status->id == request('filter_status_id') ? 'selected' : '' }}>{{$status->name}}</option> 
                        @endforeach
                    </select>
                </th>
                <th style="vertical-align: top !important; " scope="col">
                    Mature Date
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary btn-sm">Search</button>
                        </div>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $tr)
                <tr>              
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td>{{ $tr->user->name }}</td>
                    <td>{{ $tr->organization->name }}</td>
                    <td>{{ $tr->amount }}</td>
                    <td>{{ $tr->dps_paid }}</td>
                    <td>{{ $tr->dps_due }}</td>
                    <td>{{ $tr->start_date }}</td>
                    <td>{{ $tr->duration }}</td>
                    <td>{{ $tr->interest_rate }}</td>
                    <td>{{ $tr->interest_before_tax }}</td>
                    <td>{{ $tr->interest_actual_amount }}</td>
                    <td>{{ $tr->total_amount }}</td>
                    <td>{{ $tr->status->name }}</td>
                    <td>{{ $tr->mature_date }}</td>                                    
                </tr>
            @endforeach
        </tbody>
    </table>
</form>
</div>