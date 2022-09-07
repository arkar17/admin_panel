@extends('RefereeManagement.layout.app')

@section('title', '2D Manage')

@section('content')
  <!--daily sale book start-->
  <div class="daily-sale-book-parent-container">
    <h1>Daily Sale Book</h1>

    <div class="daily-sale-book-headers-container">
        <div class="daily-sale-book-categories-container">
            <p class="daily-sale-book-category daily-sale-book-categories-active" id="2d_sale_list">2D & Lone Pyine Sale List</p>
            <!-- <p class="daily-sale-book-category" id="lonepyine_sale_list">Lone Pyine List</p> -->
            <p class="daily-sale-book-category" id="3d_sale_list">3D List</p>

        </div>
        <div class="daily-sale-book-search-container">
            <iconify-icon icon="akar-icons:search" class="daily-sale-book-search-icon"></iconify-icon>
            <input type="text" placeholder="Search"/>
        </div>
    </div>

    <div class="daily-sale-book-2d-parent-container">
        <!--2d details start-->
        <div class="daily-sale-book-2dlist-parent-container">
          <h1>2D</h1>
          <div class="daily-sale-book-2dlist-container">
            <div class="daily-sale-book-2dlist-1row"></div>
            <div class="daily-sale-book-2dlist-2row"></div>
            <div class="daily-sale-book-2dlist-3row"></div>
            <div class="daily-sale-book-2dlist-4row"></div>
            <div class="daily-sale-book-2dlist-5row"></div>
            <div class="daily-sale-book-2dlist-6row"></div>
            <div class="daily-sale-book-2dlist-7row"></div>
            <div class="daily-sale-book-2dlist-8row"></div>
            <div class="daily-sale-book-2dlist-9row"></div>
            <div class="daily-sale-book-2dlist-10row"></div>
            <div class="daily-sale-book-2dlist-11row"></div>
            <div class="daily-sale-book-2dlist-12row"></div>
            <div class="daily-sale-book-2dlist-13row"></div>
          </div>
        </div>
        <!--2d details end-->

        <!--lonepyine start-->
        <div class="daily-sale-book-lonepyinelist-parent-container">
          <h1>Lone Pyine</h1>
          <div class="daily-sale-book-lonepyinelist-container">
            <div class="daily-sale-book-lonepyinelist-1row"></div>
            <div class="daily-sale-book-lonepyinelist-2row"></div>
            <div class="daily-sale-book-lonepyinelist-3row"></div>
          </div>

        </div>
        <!--lonepyine end-->

        <!--charts start-->
        <div class="daily-sale-book-charts-container">
          <div class="daily-sale-book-2d-chart-container" >
            <p>2D Most Bet Numbers</p>
            <canvas id="daily-sale-book-2d-chart"></canvas>
          </div>
          <div class="daily-sale-book-lonepyine-chart-container">
            <p>Lone Pyine Most Bet Numbers</p>
            <canvas id="daily-sale-book-lonepyine-chart"></canvas>
          </div>
        </div>
        <!--charts end-->

        <!--accept decline start-->
        <div class="daily-sale-book-labels-container">
            <p>ID</p>
            <p>Date</p>
            <p>Agent Name</p>
            <p>Round</p>
            <p>Type</p>
            <p>Number</p>
            <p>Compensation</p>
            <p>Amount</p>
        </div>
      <div class="daily-sale-book-sale-record-parent-container">
          <h1>2D & Lone Pyine Sale Record</h1>
          <div class="daily-sale-book-sale-record-container">
            <div class="daily-sale-book-sale-record-labels-container">
              <p>ID</p>
              <p>Date</p>
              <p>Agent Name</p>
              <p>Round</p>
              <p>Type</p>
              <p>Number</p>
              <p>Compensation</p>
              <p>Amount</p>
              <p>Status</p>
            </div>
            <div class="daily-sale-book-sale-record-rows-container">
                @foreach($agenttwodsaleList as $agent)
                            <div class="daily-sale-book-sale-record-row">
                                <p>1</p>
                                <p>{{$agent->date}}</p>
                                <p>{{$agent->name}}</p>
                                <p>{{$agent->round}}</p>
                                <p>2D</p>
                                <div class="daily-sale-book-sale-row-numbers">
                                    <p>{{$agent->number}}</p>
                                </div>

                                <div class="daily-sale-book-sale-row-compensations">
                                   <p>{{$agent->compensation}}</p>
                                </div>
                                <div class="daily-sale-book-sale-row-amounts">
                                    <p>{{$agent->sale_amount}}</p>
                                </div>
                                <div class="daily-sale-book-row-btn-container">
                                    @if ($agent->status == 1)
                                        <a href="" class="daily-sale-book-accepted-btn">Accepted</a>
                                        @else
                                        <a href="{{route('twodAccept',[$agent->id])}}"
                                            class="daily-sale-book-accept-btn">Accept
                                        </a>
                                    @endif

                                    <a href="{{route('twodDecline',[$agent->id])}}"
                                        class="daily-sale-book-decline-btn modalbox"
                                        data-mytitle="abc" data-catid={{$agent->id}} data-toggle="modal" data-target="#edit">Decline
                                    </a>

                                </div>
                            </div>
                @endforeach

                @foreach($agentlonepyinesalelist as $agent)
                            <div class="daily-sale-book-sale-record-row">
                                <p>2</p>
                                <p>{{$agent->date}}</p>
                                <p>{{$agent->name}}</p>
                                <p>{{$agent->round}}</p>
                                <p>Lone Pyine</p>
                                <div class="daily-sale-book-sale-row-numbers">
                                    <p>{{$agent->number}}</p>
                                </div>

                                <div class="daily-sale-book-sale-row-compensations">
                                   <p>{{$agent->compensation}}</p>
                                </div>
                                <div class="daily-sale-book-sale-row-amounts">
                                    <p>{{$agent->sale_amount}}</p>
                                </div>
                                <div class="daily-sale-book-row-btn-container">
                                    @if ($agent->status == 1)
                                        <a href="" class="daily-sale-book-accepted-btn">Accepted</a>
                                        @else
                                        <a href="{{route('lonepyineAccept',[$agent->id])}}"
                                            class="daily-sale-book-accept-btn">Accept
                                        </a>
                                    @endif

                                    <a href="{{route('lonepyinedecline',[$agent->id])}}"
                                        class="daily-sale-book-decline-btn">Decline
                                    </a>

                                </div>
                            </div>
                @endforeach
            </div>

          </div>
        </div>
    </div>

    
    <div class="daily-sale-book-3d-parent-container">

      <p class="daily-sale-book-3d-current-rate">
          Current Rate : 550
      </p>

      <div class="daily-sale-book-3d-chart-container">
        <p>Most Bet Numbers</p>
        <canvas id="daily-sale-book-3d-chart"></canvas>
      </div>

      <!--sale record start-->
      <div class="daily-sale-book-sale-record-parent-container">
        <h1>3d sale record list</h1>
        <div class="daily-sale-book-sale-record-container">
          <div class="daily-sale-book-sale-record-labels-container">
            <p>ID</p>
            <p>Date</p>
            <p>Agent Name</p>
            <p>Round</p>
            <p>Type</p>
            <p>Number</p>
            <p>Compensation</p>
            <p>Amount</p>
            <p>Status</p>
          </div>
          <div class="daily-sale-book-sale-record-rows-container">
            @foreach ($agentthreedsalelist as $agent)
                <div class="daily-sale-book-sale-record-row">
                    <p>1</p>
                    <p>24 Aug</p>
                    <p>{{$agent->name}}</p>
                    <p>{{$agent->round}}</p>
                    <p>Lone Pyine</p>
                    <div class="daily-sale-book-sale-row-numbers">
                    <p>{{$agent->number}}</p>
                    </div>
                    <div class="daily-sale-book-sale-row-compensations">
                    <p>{{$agent->compensation}}</p>
                    </div>
                    <div class="daily-sale-book-sale-row-amounts">
                    <p>{{$agent->sale_amount}} ks</p>
                    </div>
                    <div class="daily-sale-book-row-btn-container">
                        @if ($agent->status == 1)
                            <a href="" class="daily-sale-book-accepted-btn">Accepted</a>
                            @else
                            <a href="{{route('threedAccept',[$agent->id])}}"
                                class="daily-sale-book-accept-btn">Accept
                            </a>
                        @endif

                        <a href="{{route('threeddecline',[$agent->id])}}"
                            class="daily-sale-book-decline-btn">Decline
                        </a>
                    </div>
                </div>
            @endforeach

          </div>

        </div>
      </div>
      <!--sale record end-->
    </div>
</div>


            <script src="{{asset('jquery/refereemanage/dailysalebook.js')}}"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="{{asset('jquery/refereemanage/dailysalebook.js')}}"></script>
@endsection


