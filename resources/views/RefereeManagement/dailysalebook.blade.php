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
              <p></p>
            </div>
            <div class="daily-sale-book-sale-record-rows-container">

                        @foreach ($agenttwodsaleList as $agent)


                            <div class="daily-sale-book-sale-record-row">
                                <p>{{$agent->id}}</p>
                                <p>{{$agent->date}}</p>
                                <p>{{$agent->name}}</p>
                                <p>{{$agent->round}}</p>
                                <p>2D</p>
                                <div class="daily-sale-book-sale-row-numbers">
                                    @for ($i=0; $i<=count($numbergroup[$agent->name])-1; $i++)
                                    <p>{{{ $numbergroup[$agent->name][$i] }}}</p>
                                    @endfor
                                </div>
                                <div class="daily-sale-book-sale-row-compensations">
                                    @for ($i=0; $i<=count($compengroup[$agent->name])-1; $i++)
                                    <p>{{{ $compengroup[$agent->name][$i] }}}</p>
                                    @endfor
                                </div>
                                <div class="daily-sale-book-sale-row-amounts">
                                    @for ($i=0; $i<=count($salegroup[$agent->name])-1; $i++)
                                    <p>{{{ $salegroup[$agent->name][$i] }}}</p>
                                    @endfor
                                </div>

                                <form action="{{route('acceptTwod')}}" mehtod = 'post'>
                                    @csrf
                                    @for ($i=0; $i<=count($idgroup[$agent->name])-1; $i++)
                                   <input type="text" hidden name="id[]" id="" value ="{{{ $idgroup[$agent->name][$i] }}}">
                                    @endfor

                                    <div class="daily-sale-book-row-btn-container">
                                        <button class="daily-sale-book-accept-btn">Accept</button>

                                    </div>
                                </form>
                                <form action="{{route('declineTwod')}}" mehtod = 'post'>
                                    @csrf
                                    @for ($i=0; $i<=count($idgroup[$agent->name])-1; $i++)
                                   <input type="text" hidden name="id[]" id="" value ="{{{ $idgroup[$agent->name][$i] }}}">
                                    @endfor

                                    <div class="daily-sale-book-row-btn-container">
                                        <button class="daily-sale-book-decline-btn">Decline</button>
                                    </div>
                                </form>
                            </div>
                        @endforeach




                        @foreach($agentlonepyinesalelist as $agent)
                            <div class="daily-sale-book-sale-record-row">
                                <p>{{$agent->id}}</p>
                                <p>{{$agent->date}}</p>
                                <p>{{$agent->name}}</p>
                                <p>{{$agent->round}}</p>
                                <p>Lone Pyine</p>

                                <div class="daily-sale-book-sale-row-numbers">
                                    @for ($i=0; $i<=count($lp_numbergroup[$agent->name])-1; $i++)
                                    <p>{{{ $lp_numbergroup[$agent->name][$i] }}}</p>
                                    @endfor
                                </div>
                                <div class="daily-sale-book-sale-row-compensations">
                                    @for ($i=0; $i<=count($lp_compengroup[$agent->name])-1; $i++)
                                    <p>{{{ $lp_compengroup[$agent->name][$i] }}}</p>
                                    @endfor
                                </div>
                                <div class="daily-sale-book-sale-row-amounts">
                                    @for ($i=0; $i<=count($lp_salegroup[$agent->name])-1; $i++)
                                    <p>{{{ $lp_salegroup[$agent->name][$i] }}}</p>
                                    @endfor
                                </div>

                                <form action="{{route('acceptlp')}}" mehtod = 'post'>
                                    @csrf
                                    @for ($i=0; $i<=count($lp_idgroup[$agent->name])-1; $i++)
                                   <input type="text" hidden name="id[]" id="" value ="{{{ $lp_idgroup[$agent->name][$i] }}}">
                                    @endfor

                                    <div class="daily-sale-book-row-btn-container">
                                        <button class="daily-sale-book-accept-btn">Accept</button>

                                    </div>
                                </form>
                                <form action="{{route('declinelp')}}" mehtod = 'post'>
                                    @csrf
                                    @for ($i=0; $i<=count($lp_idgroup[$agent->name])-1; $i++)
                                   <input type="text" hidden name="id[]" id="" value ="{{{ $lp_idgroup[$agent->name][$i] }}}">
                                    @endfor

                                    <div class="daily-sale-book-row-btn-container">
                                        <button class="daily-sale-book-decline-btn">Decline</button>
                                    </div>
                                </form>
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
            <p>Type</p>
            <p>Number</p>
            <p>Compensation</p>
            <p>Amount</p>
            <p>Status</p>
          </div>
          <div class="daily-sale-book-sale-record-rows-container">
            @foreach ($agentthreedsalelist as $agent)
                <div class="daily-sale-book-sale-record-row">
                    <p>{{$agent->id}}</p>
                    <p>24 Aug</p>
                    <p>{{$agent->name}}</p>
                    <p>Lone Pyine</p>
                    <div class="daily-sale-book-sale-row-numbers">
                        @for ($i=0; $i<=count($threed_numbergroup[$agent->name])-1; $i++)
                        <p>{{{ $threed_numbergroup[$agent->name][$i] }}}</p>
                        @endfor
                    </div>
                    <div class="daily-sale-book-sale-row-compensations">
                        @for ($i=0; $i<=count($threed_compengroup[$agent->name])-1; $i++)
                        <p>{{{ $threed_compengroup[$agent->name][$i] }}}</p>
                        @endfor
                    </div>
                    <div class="daily-sale-book-sale-row-amounts">
                        @for ($i=0; $i<=count($threed_salegroup[$agent->name])-1; $i++)
                        <p>{{{ $threed_salegroup[$agent->name][$i] }}}</p>
                        @endfor
                    </div>

                    <form action="{{route('acceptThreed')}}" mehtod = 'post'>
                        @csrf
                        @for ($i=0; $i<=count($threed_idgroup[$agent->name])-1; $i++)
                       <input type="text" hidden name="id[]" id="" value ="{{{ $threed_idgroup[$agent->name][$i] }}}">
                        @endfor

                        <div class="daily-sale-book-row-btn-container">
                            <button class="daily-sale-book-accept-btn">Accept</button>

                        </div>
                    </form>
                    <form action="{{route('declineThreed')}}" mehtod = 'post'>
                        @csrf
                        @for ($i=0; $i<=count($threed_idgroup[$agent->name])-1; $i++)
                       <input type="text" hidden name="id[]" id="" value ="{{{ $threed_idgroup[$agent->name][$i] }}}">
                        @endfor

                        <div class="daily-sale-book-row-btn-container">
                            <button class="daily-sale-book-decline-btn">Decline</button>
                        </div>
                    </form>
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
            {{-- <script src="{{asset('jquery/refereemanage/dailysalebook.js')}}"></script> --}}

@endsection

@section('script')
<script>

    $(document).ready(function(){
        var twod_data = @json($twod_salelists);
        console.log(twod_data);
        var lp_data =  @json($lp_salelists);
        var threed_data = @json($threed_salelists);
        //console.log(lp_data);
        const labels1 = [
        twod_data[0].number,
        twod_data[1].number,
        twod_data[2].number,
        twod_data[3].number,
        twod_data[4].number,
        twod_data[5].number,
        twod_data[6].number,
        twod_data[7].number,
        twod_data[8].number,
        twod_data[9].number
      ];
      const labels2 = [
        lp_data[0].number,
        lp_data[1].number,
        lp_data[2].number,
        lp_data[3].number,
        lp_data[4].number,
        lp_data[5].number,
        lp_data[6].number,
        lp_data[7].number,
        lp_data[8].number,
        lp_data[9].number,
      ];
      const labels3 = [
        threed_data[0].number,
        threed_data[1].number,
        threed_data[2].number,
        threed_data[3].number,
        threed_data[4].number,
        threed_data[5].number,
        threed_data[6].number,
        threed_data[7].number,
        threed_data[8].number,
        threed_data[9].number
      ];
      const data1 = {
        labels: labels1,
        datasets: [{
          label: 'Most Bet 2D Number',
          backgroundColor: '#EB5E28',
          borderColor: 'rgb(255, 99, 132)',
          data: [ twod_data[0].sale_amount,  twod_data[1].sale_amount,  twod_data[2].sale_amount,  twod_data[3].sale_amount,  twod_data[4].sale_amount,  twod_data[5].sale_amount,  twod_data[6].sale_amount,  twod_data[7].sale_amount, twod_data[8].sale_amount, twod_data[9].sale_amount]

        }]
      };
      const data2 = {
        labels: labels2,
        datasets: [{
          label: 'Most Bet Lone Pyine Number',
          backgroundColor: '#EB5E28',
          borderColor: 'rgb(255, 99, 132)',
         data: [ lp_data[0].sale_amount,  lp_data[1].sale_amount,  lp_data[2].sale_amount,  lp_data[3].sale_amount,  lp_data[4].sale_amount,  lp_data[5].sale_amount,  lp_data[6].sale_amount,  lp_data[7].sale_amount, lp_data[8].sale_amount, lp_data[9].sale_amount],

        }]
      };

      const data3 = {
        labels: labels3,
        datasets: [{
          label: 'Most Bet 3D Number',
          backgroundColor: '#EB5E28',
          borderColor: 'rgb(255, 99, 132)',
          data: [ threed_data[0].sale_amount,  threed_data[1].sale_amount,  threed_data[2].sale_amount,  threed_data[3].sale_amount,  threed_data[4].sale_amount,  threed_data[5].sale_amount,  threed_data[6].sale_amount,  threed_data[7].sale_amount, threed_data[8].sale_amount, threed_data[9].sale_amount]

        }]
      };

      const config1 = {
        type: 'bar',
        data: data1,
        options: {}
      };
      const config2 = {
        type: 'bar',
        data: data2,
        options: {}
      };
      const config3 = {
        type: 'bar',
        data: data3,
        options: {}
      };

      const twodChart = new Chart(
        document.getElementById('daily-sale-book-2d-chart'),
        config1
      );
      const lonepyineChart = new Chart(
        document.getElementById('daily-sale-book-lonepyine-chart'),
        config2
      );
      const threeChart = new Chart(
        document.getElementById('daily-sale-book-3d-chart'),
        config3
      );
})

</script>

@endsection


