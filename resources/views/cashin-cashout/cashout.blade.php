@extends('layouts.app')
@section('title', 'Referee')
@section('content')

    {{-- <div class="main-content-parent-container">

    <!--cash in/cash out start-->
    <div class="cashinout-parent-container">
        <div class="cashinout-categories-container">
            <p class="cashinout-category cashinout-category-active" id="cash_in">Cash In</p>
            <p class="cashinout-category" id="cash_out">Cash Out</p>
        </div>

        <div class="cashin-parent-container">
            <div class="cashin-agent-inputs-parent-container">
                <div class="cashin-agent-name-ph-coin-container">
                    <div class="cashin-agent-name-container">
                        <p>Agent Name</p>
                        <input type="text" list="agent-name" placeholder="Enter Agent Name" />
                        <datalist id="agent-name">
                            <option value="Agent 001"></option>
                            <option value="Agent 002"></option>
                            <option value="Agent 003"></option>
                        </datalist>
                    </div>
                    <div class="cashin-agent-phno-container">
                        <p>Phone No</p>
                        <input type="number" placeholder="Enter Agent Phone No" />

                    </div>
                    <div class="cashin-agent-coin-container">
                        <p>Coin Amount</p>
                        <input type="number" placeholder="Enter Coin Amount" />

                    </div>
                </div>

                <div class="cashin-status-payment-remaining-container">
                    <div class="cashin-agent-status-container">
                        <p>Status</p>

                        <select id="payment-status">
                            <option value="">Choose Payment status</option>
                            <!-- <option value="Agent 001"></option>
                  <option value="Agent 002"></option>
                  <option value="Agent 003"></option> -->
                        </select>
                    </div>
                    <div class="cashin-agent-payment-container">
                        <p>Payment</p>
                        <input type="number" placeholder="Enter Payment" />

                    </div>
                    <div class="cashin-agent-remaining-container">
                        <p>Remaining Amount</p>
                        <input type="number" placeholder="Enter Remaining Amount" />

                    </div>
                </div>

                <div class="cashin-btn-container">
                    <button class="cashin-confirm-btn">Confirm</button>
                    <button class="cashin-cancel-btn">Cancel</button>
                </div>

            </div>

            <div class="cashin-list-parent-container">
                <h1>Cash In List</h1>
                <div class="cashin-list-container">
                    <div class="cashin-list-lables-container">
                        <p>ID</p>
                        <p>Agent Name</p>
                        <p>Phone No</p>
                        <p>Coin Amount</p>
                        <p>Status</p>
                        <p>Payment</p>
                        <p>Remaining</p>
                    </div>

                    <div class="cashin-list-rows-container">
                        <div class="cashin-list-row">
                            <p>1</p>
                            <p>Agent 01</p>
                            <p>091234567</p>
                            <p>100000</p>
                            <p>Fully Paid</p>
                            <p>100000</p>
                            <p>0</p>
                        </div>
                        <div class="cashin-list-row">
                            <p>1</p>
                            <p>Agent 01</p>
                            <p>091234567</p>
                            <p>100000</p>
                            <p>Fully Paid</p>
                            <p>100000</p>
                            <p>0</p>
                        </div>
                        <div class="cashin-list-row">
                            <p>1</p>
                            <p>Agent 01</p>
                            <p>091234567</p>
                            <p>100000</p>
                            <p>Fully Paid</p>
                            <p>100000</p>
                            <p>0</p>
                        </div>
                        <div class="cashin-list-row">
                            <p>1</p>
                            <p>Agent 01</p>
                            <p>091234567</p>
                            <p>100000</p>
                            <p>Fully Paid</p>
                            <p>100000</p>
                            <p>0</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cashout-parent-container">
            Cash Out
        </div>
    </div>

</div> --}}
    <div class="container my-5">
        <div class="col-md-12">
           <div class="text-center mb-3">
            <a href="{{ route('cashin') }}" class=" btn btn-warning">
                Cash in
            </a>

            <a href="{{ route('cashout') }}" class=" btn btn-warning">
                Cash out
            </a>
           </div>
            <div class="card p-4">
                <form action="{{ route('cashin.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-5">
                                <label for="name">Agent Name</label>
                                <select class="form-select" aria-label="Default select example" name="agent_id">
                                    @foreach ($agents as $agent)
                                        <option value="{{ $agent->id }}">{{ $agent->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="form-group mb-5">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control" name="phone">
                            </div>
                        </div> --}}
                        <div class="col-md-4">
                            <div class="form-group mb-5">
                                <label for="coin_amount">Coin Amount</label>
                                <input type="text" class="form-control" name="coin_amount" id="coin_amount">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-5">
                                <label for="withdrawl">Withdrawl</label>
                                <input type="text" class="form-control" name="withdrawl" id="withdrawl">
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-warning">Confirm</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>


                </form>
            </div>

            <h3 class="my-5">Cash In Lists</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Coin Amount</th>
                        <th>Withdrawl Amount</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($cashin_cashouts as $cashin_cashout)
                        <tr>
                            <td>{{ $cashin_cashout->id }}</td>
                            <td>{{ $cashin_cashout->name }}</td>
                            <td>{{ $cashin_cashout->phone }}</td>
                            <td>{{ $cashin_cashout->coin_amount }}</td>

                            <td>
                                @if ($cashin_cashout->status == 1)
                                    <span class="text-success">Fully Paid</span>
                                @else
                                    <span class="text-danger">Credit</span>
                                @endif
                            </td>
                            <td>{{ $cashin_cashout->payment }}</td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection
