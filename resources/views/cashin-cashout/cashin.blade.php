@extends('layouts.app')

@section('css')
    <style>
        .main-cash-container {
            padding: 20px;
            width: 75%;
        }

        .alert-border {
            border: 1px solid rgb(206, 6, 6) !important;
        }

        .mc-inp {
            width: 250px;
            padding: 3px;
            outline: none;
            border: 2px solid #D9DEED;
            border-radius: 4px;
            color: #777;
        }

        .mc-label {
            align-self: center;
            margin-bottom: 0px;
        }

        .error-message {
            color: red;
            display: block;
        }

        .add-main-cash {
            display: flex;
            justify-content: space-between;
        }

        /* input[type="text"]{
                        margin-bottom: 20px;
                    } */

        .select2-container--default .select2-selection--single {
            padding-top: 3px;
            height: 34px;
            background-color: #fff;
            border: 2px solid #D9DEED;
            border-radius: 4px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #D9DEED transparent transparent transparent;
            border-style: solid;
            border-width: 5px 4px 0 4px;
            height: 0;
            left: 50%;
            margin-left: -4px;
            margin-top: 1px;
            position: absolute;
            top: 50%;
            width: 0;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 2px solid #D9DEED;
            outline: none;
        }
    </style>
@endsection

@section('title', 'Referee')
@section('content')

    <div class="main-cash-container">
        <h1>Main Cash</h1>
        <form action="{{ route('maincash.store') }}" method="POST">
            @csrf
            <div class="add-main-cash">
                <label for="main_cash" class="mc-label">Add Main Cash</label>

                <input type="number" class="mc-inp" id="main_cash" name="main_cash" placeholder="Enter your amount">


                <div class="">
                    <button type="submit" class="cashin-confirm-btn">Confirm</button>
                    <button type="reset" class="cashin-cancel-btn">Cancel</button>
                </div>
            </div>
        </form>
    </div>
    <hr>
    <!--cash in/cash out start-->
    <div class="cashinout-parent-container">
        <div class="cashinout-categories-container">
            <p class="cashinout-category cashinout-category-active" id="cash_in">Cash In</p>
            <p class="cashinout-category" id="cash_out">Cash Out</p>
        </div>


        {{-- -------------------------------- Cash In-------------------------------- --}}
        <div class="cashin-parent-container">
            <form action="{{ route('cashin.store') }}" method="POST" class="cashin-agent-inputs-parent-container">
                @csrf
                <div class="cashin-agent-name-ph-coin-container">
                    <div class="cashin-agent-name-container">
                        <p>Agent Name</p>
                        <select id="" class="select2 se1" style="width: 240px;" name="agent_id">
                            @foreach ($agents as $agent)
                                <option value="{{ $agent->id }}" data-id="{{ $agent->id }}">
                                    {{ $agent->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="cashin-agent-phno-container">
                        <p>Phone No</p>
                        <input type="number" placeholder="Enter Agent Phone No" class="inputPhone1" name="phone"
                            disabled />

                    </div>
                    <div class="cashin-agent-coin-container">
                        <p>Coin Amount</p>
                        <input type="number" placeholder="Enter Coin Amount"
                            class=" @error('coin_amount')
                            alert-border
                        @enderror"
                            name="coin_amount" />

                        @error('coin_amount')
                            <small class="error-message">{{ $message }}</small>
                        @enderror

                    </div>
                </div>

                <div class="cashin-status-payment-remaining-container">
                    <div class="cashin-agent-status-container">
                        <p>Status</p>

                        <select id="payment-status" name="status">
                            <option value="1">Fully Paid</option>
                            <option value="2">Credit</option>
                        </select>
                    </div>
                    <div class="cashin-agent-payment-container">
                        <p>Payment</p>
                        <input type="number" placeholder="Enter Payment" name="payment"
                            class="@error('payment')
                            alert-border
                        @enderror" />
                        @error('payment')
                            <small class="error-message">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="cashin-btn-container">
                    <button type="submit" class="cashin-confirm-btn">Confirm</button>
                    <button type="reset" class="cashin-cancel-btn">Cancel</button>
                </div>

            </form>

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
                    </div>

                    <div class="cashin-list-rows-container">
                        @foreach ($cashin_cashouts as $cashin_cashout)
                            <div class="cashin-list-row">
                                <p>{{ $cashin_cashout->id }}</p>
                                <p>{{ $cashin_cashout->name }}</p>
                                <p>{{ $cashin_cashout->phone }}</p>
                                <p>{{ $cashin_cashout->coin_amount }}</p>
                                @if ($cashin_cashout->status == 1)
                                    <p style="color: rgb(107, 153, 37)">Fully Paid</p>
                                @else
                                    <p style="color: red">Credit</p>
                                @endif

                                <p>{{ $cashin_cashout->payment }}</p>

                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

        {{-- --------------------------------  Cash Out --------------------------------------- --}}
        <div class="cashout-parent-container">
            <form action="{{ route('cashout.store') }}" method="POST" class="cashin-agent-inputs-parent-container">
                @csrf
                <div class="cashin-agent-name-ph-coin-container">
                    <div class="cashin-agent-name-container">
                        <p>Agent Name</p>
                        <select id="" class="select2 se2" style="width: 240px;" name="agent_id">
                            @foreach ($cc as $ccs)
                                <option value="{{ $ccs->id }}" data-id="{{ $ccs->id }}">
                                    {{ $ccs->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="cashin-agent-phno-container">
                        <p>Phone No</p>
                        <input type="number" placeholder="Enter Agent Phone No"
                            class="inputPhone2 @error('phone')
                        alert-border
                    @enderror"
                            name="phone" disabled />

                    </div>
                    <div class="cashin-agent-coin-container">
                        <p>Coin Amount</p>
                        <input type="number" placeholder="Enter Coin Amount"
                            class="inputCoinAmount2 @error('coin_amount')
                            alert-border
                        @enderror"
                            name="coin_amount" />

                        @error('coin_amount')
                            <small class="error-message">{{ $message }}</small>
                        @enderror

                    </div>
                </div>

                <div class="cashin-status-payment-remaining-container">
                    <div class="cashin-agent-phno-container">
                        <p>Withdraw</p>
                        <input type="number" placeholder="Enter Withdraw amount" name="withdraw" />

                    </div>
                </div>

                <div class="cashin-btn-container">
                    <button type="submit" class="cashin-confirm-btn">Confirm</button>
                    <button type="reset" class="cashin-cancel-btn">Cancel</button>
                </div>

            </form>


            <div class="cashin-list-parent-container">
                <h1>Cash Out List</h1>
                <div class="cashin-list-container">
                    <div class="cashin-list-lables-container">
                        <p>ID</p>
                        <p>Agent Name</p>
                        <p>Phone No</p>
                        <p>Coin Amount</p>
                        <p>Withdraw Amount</p>

                    </div>

                    <div class="cashin-list-rows-container">
                        @foreach ($cashin_cashouts as $cashin_cashout)
                            <div class="cashin-list-row">
                                <p>{{ $cashin_cashout->id }}</p>
                                <p>{{ $cashin_cashout->name }}</p>
                                <p>{{ $cashin_cashout->phone }}</p>
                                <p>{{ $cashin_cashout->coin_amount }}</p>
                                <p>{{ $cashin_cashout->withdraw }}</p>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $('.select2').select2();

            var agents = @json($agents);
            var cc = @json($cc);

            console.log('cc',cc);


            $('.inputPhone1').val(agents[0].user.phone);
            $('.inputPhone2').val(cc[0].phone);

            $('.inputCoinAmount2').val(cc[0].coin_amount);

            $('.se1').change(function() {
                var id = $('.se1').val();
                $('.inputPhone1').val(agents[--id].user.phone);
            });

            $('.se2').change(function() {
                var id = $('.se2').val();
                $('.inputPhone2').val(cc[--id].phone);
            })

            $('.se2').change(function() {
                var id = $('.se2').val();
                $('.inputCoinAmount2').val(cc[--id].coin_amount);
            })
        });
    </script>

@endsection
