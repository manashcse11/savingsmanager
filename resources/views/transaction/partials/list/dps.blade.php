<div class="card-body overflow-auto">
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<form method="GET" action="{{ route('transaction.index') }}">
    @csrf
    <table class="table table-bordered table-hover font-13">
        <thead>
            <tr>
                <th class="align-top" scope="col">
                    #<input type="hidden" name="slug" value="{{$type->slug}}">
                </th>
                <th class="align-top" scope="col">
                    Owner
                    <select name="filter_user_id" class="form-control form-control-sm">
                        <option value="">All</option>
                        @foreach ($users as $user)
                            <option value="{{$user->id}}" {{ $user->id == request('filter_user_id') ? 'selected' : '' }}>{{$user->name}}</option>
                        @endforeach
                    </select>
                </th>
                <th class="align-top" scope="col">
                    Organization
                    <select name="filter_organization_id" class="form-control form-control-sm">
                        <option value="">All</option>
                        @foreach ($organizations as $organization)
                            <option value="{{$organization->id}}" {{ $organization->id == request('filter_organization_id') ? 'selected' : '' }}>{{$organization->name}}</option>
                        @endforeach
                    </select>
                </th>
                <th class="align-top" scope="col">Monthly Deposit</th>
                <th class="align-top" scope="col">Paid</th>
                <th class="align-top" scope="col">Due</th>
                <th class="align-top" scope="col">Start Date</th>
                <th class="align-top" scope="col">Duration</th>
                <th class="align-top" scope="col">Interest Rate</th>
                <th class="align-top" scope="col">Interest Before Tax</th>
                <th class="align-top" scope="col">Interest</th>
                <th class="align-top" scope="col">Total</th>
                <th class="align-top" scope="col">
                    Status
                    <select name="filter_status_id" class="form-control form-control-sm">
                        <option value="">All</option>
                        @foreach ($statuses as $status)
                            <option value="{{$status->id}}" {{ $status->id == request('filter_status_id') ? 'selected' : '' }}>{{$status->name}}</option>
                        @endforeach
                    </select>
                </th>
                <th class="align-top" scope="col">Mature Date</th>
                <th class="align-top" scope="col">Mature After</th>
                <th class="align-top" scope="col">
                    Actions
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
                    <td>{{ $tr->mature_after }}</td>
                    <td>
                        <a href="{{route('transaction.edit', $tr->id)}}"><i class="fa fa-edit float-left fa-lg"></i></a>
                        <a href="{{ route('transaction.delete', $tr->id) }}"><i class="fa fa-trash float-right text-danger fa-lg"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</form>
</div>
