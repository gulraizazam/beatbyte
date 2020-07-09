@extends('dashboard.layouts.default')

@section('content')
<style type="text/css">
  .alert-danger {
    background-color: #f05050;
    color: #fff;
    padding: 8px;
    border: 1px solid transparent;
    border-radius: 3px;
}

</style>


 <div class="container-fluid">

      <!-- Breadcrumbs-->

      <ol class="breadcrumb">

        <li class="breadcrumb-item">

          <a href="#">Dashboard</a>

        </li>

        <li class="breadcrumb-item active">My Dashboard</li>

      </ol>

      <!-- Icon Cards-->

      @role('seller')

      <div class="row">

        <?php

            $user = Auth::user()->id;
            
            $allbeats = count(\App\Beat::where('user_id',$user)->get());

            $allsongs = count(\App\Song::where('user_id',$user)->get());

            $songsearning= \App\Order_Item::join('songs','songs.id','=','order_items.item_id')->where('songs.user_id',$user)->whereDate('order_items.created_at', '>', Carbon\Carbon::now()->subDays(30))->sum('price');
             $beatsearning= \App\Order_Item::join('beats','beats.id','=','order_items.item_id')->where('beats.user_id',$user)->whereDate('order_items.created_at', '>',Carbon\Carbon::now()->subDays(30))->sum('price');
            $totalearning = $beatsearning+$songsearning;
            $alllists= count(\App\Album::where('user_id',$user)->get());
            $accountsettings = \App\Accountsetting::where('user_id',$user)->get();

         ?>
         <div class="col-md-12">
           @if(session()->has('success'))

                <div class="alert alert-success">

                    {{ session()->get('success') }}

                </div>

            @endif
            @if(!count($accountsettings ))
              <div class="alert alert-danger text-center" role="alert"><strong><i class="fa fa-exclamation-triangle"></i> Warning!</strong> You need to set your PayPal email address before you can receive payments. <a href="{{url('accountsettings')}}" style="color: white;">Click here to set it.</a></div>
            @endif
         </div>
              

              

        <div class="col-lg-3 col-sm-6">

            <div id="beats-sold-stat-widget" class="stat-widget" "="">

              <div class="panel widget bg-primary" style="height: 120px">

                  <div class="row row-table">

                      <div class="left-section col-xs-4 text-center bg-primary-dark pv-lg" style="background: #0b6dd6">

                          <i class="fa fa-headphones fa-3x" style="color: black;"></i>

                      </div>

                      <div class="right-section col-xs-8 pv-lg">

                          <div class="statistic h2 mt0" style="height: 33px;color: black;">{{$allbeats}}</div>

                          <div class="text-uppercase" style="color: black"> Beats</div>

                          

                      </div>



                  </div>

              </div>

          </div>

        </div>

        <div class="col-lg-3 col-sm-6">

            <div id="beats-sold-stat-widget" class="stat-widget" "="">

              <div class="panel widget bg-success" style="height: 120px">

                  <div class="row row-table">

                      <div class="left-section col-xs-4 text-center bg-green-dark pv-lg" style="background: #2c9d2c;">

                          <i class="fa fa-music fa-3x"></i>

                      </div>

                      <div class="right-section col-xs-8 pv-lg">

                          <div class="statistic h2 mt0" style="height: 33px">{{$allsongs}}</div>

                          <div class="text-uppercase"> Songs</div>

                          

                      </div>



                  </div>

              </div>

          </div>

        </div>

        <div class="col-lg-3 col-sm-6">

            <div id="beats-sold-stat-widget" class="stat-widget" "="">

              <div class="panel widget bg-danger" style="height: 120px">

                  <div class="row row-table">

                      <div class="left-section col-xs-4 text-center bg-green-dark pv-lg" style="background: #ce3d3d;">

                          <i class="fa fa-usd fa-3x"></i>

                      </div>

                      <div class="right-section col-xs-8 pv-lg">

                          <div class="statistic h2 mt0" style="height: 33px">{{$totalearning}}</div>

                          <div class="text-uppercase"> Earning </div>
                          <span style="color: white">Last 30 Days</span>
                          

                      </div>



                  </div>

              </div>

          </div>

        </div>

        <div class="col-lg-3 col-sm-6">

            <div id="beats-sold-stat-widget" class="stat-widget" "="">

              <div class="panel widget bg-warning" style="height: 120px">

                  <div class="row row-table">

                      <div class="left-section col-xs-4 text-center bg-green-dark pv-lg" style="background: #edba23;">

                          <i class="fa fa-film fa-3x"></i>

                      </div>

                      <div class="right-section col-xs-8 pv-lg">

                          <div class="statistic h2 mt0" style="height: 33px">{{ $alllists}}</div>

                          <div class="text-uppercase"> Albums</div>

                          

                      </div>



                  </div>

              </div>

          </div>

        </div>

      </div>

      @endrole

      @role('admin')

      <div class="row">

        <div class="col-lg-3 col-sm-6">

            <div id="beats-sold-stat-widget" class="stat-widget" "="">

              <div class="panel widget bg-primary">

                  <div class="row row-table">

                      <div class="left-section col-xs-4 text-center bg-green-dark pv-lg" style="background: #0b6dd6;">

                          <i class="fa fa-headphones fa-3x" ></i>

                      </div>

                      <div class="right-section col-xs-8 pv-lg">

                          <div class="statistic h2 mt0" style="height: 33px">{{count(\App\Generation::all())}}</div>

                          <div class="text-uppercase"> Genres</div>

                          

                      </div>



                  </div>

              </div>

          </div>

        </div>

        <div class="col-lg-3 col-sm-6">

            <div id="beats-sold-stat-widget" class="stat-widget" "="">

              <div class="panel widget bg-success">

                  <div class="row row-table">

                      <div class="left-section col-xs-4 text-center bg-green-dark pv-lg" style="background: #2c9d2c;color: white;">

                          <i class="fa fa-music fa-3x"></i>

                      </div>

                      <div class="right-section col-xs-8 pv-lg" style="color: white">

                          <div class="statistic h2 mt0" style="height: 33px">{{count(\App\Mood::all())}}</div>

                          <div class="text-uppercase"> Moods</div>

                          

                      </div>



                  </div>

              </div>

          </div>

        </div>

       <div class="col-lg-3 col-sm-6">

            <div id="beats-sold-stat-widget" class="stat-widget" "="">

              <div class="panel widget bg-warning">

                  <div class="row row-table">

                      <div class="left-section col-xs-4 text-center bg-green-dark pv-lg" style="background: #edba23;color: white">

                          <i class="fa fa-user fa-3x"></i>

                      </div>

                      <div class="right-section col-xs-8 pv-lg" style="color: white">

                          <div class="statistic h2 mt0" style="height: 33px">{{count(\App\User::all())}}</div>

                          <div class="text-uppercase"> Users</div>

                          

                      </div>



                  </div>

              </div>

          </div>

        </div>

        <div class="col-lg-3 col-sm-6">

            <div id="beats-sold-stat-widget" class="stat-widget" "="">

              <div class="panel widget bg-warning" style="background: #71328b !important">

                  <div class="row row-table">

                      <div class="left-section col-xs-4 text-center bg-green-dark pv-lg" style="background: #8d3fad;color: white">

                          <i class="fa fa-shopping-cart fa-3x"></i>

                      </div>

                      <div class="right-section col-xs-8 pv-lg" style="color: white;">

                          <div class="statistic h2 mt0" style="height: 33px">{{count(\App\Order::all())}}</div>

                          <div class="text-uppercase"> Sales</div>

                          

                      </div>



                  </div>

              </div>

          </div>

        </div>

      </div>

      @endrole

      <div class="row">

        <div class="col-lg-12">

          <!-- Example Bar Chart Card-->

          <div class="card mb-3">

            <div class="card-header">

              <i class="fa fa-bar-chart"></i> My Sales</div>

            <div class="card-body">

              @role('seller')

              <canvas id="myChart"></canvas>

              @endrole

              @role('admin')

                <canvas id="adminSale"></canvas>

              @endrole

            </div>

            <div class="card-footer small text-muted"></div>

          </div>

        </div>

        

      </div>

  </div>

@stop

@section('scripts')

@role('seller')

  <script type="text/javascript">

    var ctx = document.getElementById("myChart").getContext("2d");

var data = {
    labels: ["Jan", "Feb", "Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
    datasets: [
        {

          <?php

              $salesarray = [];

              foreach( $SellerBeats as $sales){

                array_push($salesarray, $sales->sales);

              }

                $allsales = implode(',', $salesarray);

               

              ?>
            label: "Beats",
            backgroundColor: "blue",
            data: ['','','','','',<?php echo $allsales; ?>]
        },
        
        {
          <?php

              $salesarray = [];

              foreach($SellerSales as $sales){

                array_push($salesarray, $sales->sales);

              }

                $allsales = implode(',', $salesarray);

               

              ?>
            label: "Songs",
            backgroundColor: "green",
            data: ['','','','','',<?php echo $allsales; ?>]
        }
    ]
};

var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
        barValueSpacing: 20,
        scales: {
            yAxes: [{
                ticks: {
                    min: 0,
                }
            }]
        }
    }
});

  </script>

@endrole

@role('admin')

  <script type="text/javascript">

         var ctx = document.getElementById("adminSale").getContext("2d");

var data = {
    labels: ["Jan", "Feb", "Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
    datasets: [
        {

          <?php

              $salesarray = [];

              foreach($AllBeatsSales as $sales){

                array_push($salesarray, $sales->sales);

              }

                $allsales = implode(',', $salesarray);

               

              ?>
            label: "Beats",
            backgroundColor: "blue",
            data: ['','','','','',<?php echo $allsales; ?>]
        },
        
        {
          <?php

              $salesarray = [];

              foreach( $AllSongsSales as $sales){

                array_push($salesarray, $sales->sales);

              }

                $allsales = implode(',', $salesarray);

               

              ?>
            label: "Songs",
            backgroundColor: "green",
            data: ['','','','','',<?php echo $allsales; ?>]
        }
    ]
};

var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
        barValueSpacing: 20,
        scales: {
            yAxes: [{
                ticks: {
                    min: 0,
                }
            }]
        }
    }
});

  </script>

@endrole

@stop

