<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form method="GET" action="{{ route('transaction.index') }}">
        @csrf
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="vertical-align: top !important; " scope="col">
                        #<input type="hidden" name="slug" value="{{$type->slug}}">
                    </th>
                    <th style="vertical-align: top !important; " scope="col">
                        Owner
                        <select name="user_id" class="form-control form-control-sm">
                            @foreach ($users as $user)
                                <option value="{{$user->id}}" {{ $user->id == old('user_id') ? 'selected' : '' }}>{{$user->name}}</option> 
                            @endforeach
                        </select>
                    </th>
                    <th style="vertical-align: top !important; " scope="col">
                        Organization
                        <select name="organization_id" class="form-control form-control-sm">
                            @foreach ($organizations as $organization)
                                <option value="{{$organization->id}}" {{ $organization->id == old('organization_id') ? 'selected' : '' }}>{{$organization->name}}</option> 
                            @endforeach
                        </select>
                    </th>
                    <th style="vertical-align: top !important; " scope="col">Amount</th>
                    <th style="vertical-align: top !important; " scope="col">Start Date</th>
                    <th style="vertical-align: top !important; " scope="col">Duration</th>
                    <th style="vertical-align: top !important; " scope="col">Interest Rate</th>
                    <th style="vertical-align: top !important; " scope="col">Interest Before Tax</th>
                    <th style="vertical-align: top !important; " scope="col">Interest</th>
                    <th style="vertical-align: top !important; " scope="col">Total</th>
                    <th style="vertical-align: top !important; " scope="col">
                        Status
                        <select name="status_id" class="form-control form-control-sm">
                            @foreach ($statuses as $status)
                                <option value="{{$status->id}}" {{ $status->id == old('status_id') ? 'selected' : '' }}>{{$status->name}}</option> 
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
                <tr>
                    @foreach ($transactions as $tr)
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $tr->user->name }}</td>
                        <td>{{ $tr->organization->name }}</td>
                        <td>{{ $tr->amount }}</td>
                        <td>{{ $tr->start_date }}</td>
                        <td>{{ $tr->duration }}</td>
                        <td>{{ $tr->interest_rate }}</td>
                        <td>{{ $tr->interest_before_tax }}</td>
                        <td>{{ $tr->interest_actual_amount }}</td>
                        <td>{{ $tr->total_amount }}</td>
                        <td>{{ $tr->status->name }}</td>
                        <td>{{ $tr->mature_date }}</td>
                    @endforeach                    
                </tr>
            </tbody>
        </table>
    </form>
</div>