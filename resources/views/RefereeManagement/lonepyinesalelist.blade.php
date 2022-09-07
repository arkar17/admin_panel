@extends('RefereeManagement.layout.app')

@section('title', 'Agent Data')

@section('content')
<!--main content start-->
<div class="main-content-parent-container">

    <!--2d sale list start-->
    <div class="twod-sale-list-parent-container">
        <h1>Sale List - Lone Pyine Sale List</h1>
        {{-- <div class="twod-sale-list-filters-container"> --}}
        <!-- <div class="twod-sale-list-filter-refereename-container">
            <p>Referee Name</p>
            <input type="text" list="referee-names" placeholder="Enter Referee Name"/>
            <datalist id="referee-names">
            <option value="referee 01"></option>
            <option value="referee 02"></option>
            <option value="referee 03"></option>
            </datalist>
        </div> -->

        <form class="twod-sale-list-filters-container" action="{{route('searchlonepyineagent')}}" method="post">
            @csrf

            <div class="twod-sale-list-filters-agentname-container">
                <p>Agent Name</p>
                <input type="text" name="searchagent" list="agent-names" placeholder="Enter Agent Name"/>
                <datalist id="agent-names">
                @foreach ($lonepyineSaleList as $agentname)
                    <option value="{{$agentname->customer_name}}"></option>
                @endforeach
                </datalist>
            </div>

            <div class="twod-sale-list-filters-date-parent-container">
                <p>Date</p>
                <div class="twod-sale-list-filters-date-container">
                <input type="date" placeholder="From Date"/>
                <input type="date" placeholder="To Date"/>
                </div>
            </div>

            <div class="twod-sale-list-filters-round-container">
                <p>Round</p>

                <select>
                <option value="">Choose Round</option>
                <option value="Morning">Morning</option>
                <option value="Evening">Evening</option>
                </select>
            </div>

            <button type="submit" class="twod-sale-list-filters-btn">
                <iconify-icon icon="akar-icons:search" class="twod-sale-list-filter-icon"></iconify-icon>
                <p>Filter</p>
            </button>
         </form>
        {{-- </div> --}}

        <div class="twod-sale-list-details-parent-container">
        <div class="twod-sale-list-details-labels-container">
            <p>No</p>
            <p>Agent Name</p>
            <p>Customer Name</p>
            <p>Number</p>
            <p>Amount</p>
        </div>

        <div class="twod-sale-details-rows-container">
            @foreach ($lonepyineSaleList as $lonepyinesalelist)
                <div class="twod-sale-details-row">
                    <p>{{$lonepyinesalelist->id}}</p>
                    <p>{{$lonepyinesalelist->name}}</p>
                    <p>{{$lonepyinesalelist->customer_name}}</p>
                    <p>{{$lonepyinesalelist->number}}</p>
                    <p>{{$lonepyinesalelist->sale_amount}}</p>
                </div>
            @endforeach

        </div>
        </div>
    </div>
    <!--2d sale list end-->

</div>
<!--main content end-->

@endsection
