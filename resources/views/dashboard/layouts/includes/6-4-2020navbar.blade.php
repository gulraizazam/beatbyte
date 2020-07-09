<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav" style="background-color: #71328b!important;">

    <a class="navbar-brand" href="{{url('/')}}">Beat Byte</a>

    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">

      <span class="navbar-toggler-icon"></span>

    </button>

    <div class="collapse navbar-collapse" id="navbarResponsive">

      @role('seller')

      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">

          <a class="nav-link" href="{{route('seller.index')}}">

            <i class="fa fa-fw fa-dashboard"></i>

            <span class="nav-link-text">Dashboard</span>

          </a>

        </li>

       <!--  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">

          <a class="nav-link" href="#">

            <i class="  fa fa-asterisk"></i>

            <span class="nav-link-text">Promotions</span>

          </a>

        </li> -->

       



        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">

          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">

            <i class="fa fa-music"></i>

            <span class="nav-link-text">Music And Media</span>

          </a>

          <ul class="sidenav-second-level collapse" id="collapseComponents">

            <li>

              <a href="{{route('seller.allbeats')}}">Beats</a>

            </li>

            <li>

              <a href="{{route('seller.allsongs')}}">Songs</a>

            </li>

            <li>

              <a href="{{route('seller.allkits')}}">Sound Kits</a>

            </li>

            <li>

              <a href="{{route('seller.allalbums')}}">Playslists & Albums</a>

            </li>

           <!--  <li>

              <a href="{{route('seller.artwork')}}">Artwork</a>

            </li> -->

            <li>

              <a href="{{route('seller.voicetag')}}">Voicetag</a>

            </li>

          </ul>

        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">

          <a class="nav-link" href="{{route('seller.sales')}}">

            <i class="fa fa-google-wallet"></i>

            <span class="nav-link-text">My Sales</span>

          </a>

        </li>

      <!--   <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">

          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">

            <i class="fa fa-wrench"></i>

            <span class="nav-link-text">Selling Tools</span>

          </a>

          <ul class="sidenav-second-level collapse" id="collapseExamplePages">

            <li>

              <a href="#">Licenses & Contracts</a>

            </li>

            <li>

              <a href="#">Co-Producers</a>

            </li>

            <li>

              <a href="#">Discounts</a>

            </li>

            <li>

              <a href="#">Coupons</a>

            </li>

            <li>

              <a href="#">Connect Mailing Lists</a>

            </li>

            <li>

              <a href="#">Connect Socials</a>

            </li>

            <li>

              <a href="#">Build A Website</a>

            </li>

            <li>

              <a href="#">Seller Preferences</a>

            </li>

          </ul>

        </li> -->

        <!-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">

          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">

            <i class="  fa fa-code"></i>

            <span class="nav-link-text">Monetization</span>

          </a>

          <ul class="sidenav-second-level collapse" id="collapseMulti">

            <li>

              <a href="#">Youtube Channel ID</a>

            </li>

            

              </ul>

            </li> -->
             <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti1" data-parent="#exampleAccordion">
                  <i class="fa fa-bar-chart-o"></i>
                  <span class="nav-link-text">Music Stores</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseMulti1">
                  <li>
                    <a href="{{url('craetestore')}}">HTML 5 Store</a>
                  </li>
                  
                    </ul>
            </li>

          </ul>

        </li>

        

      </ul>

      @endrole

      @role('admin')

      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">

          <a class="nav-link" href="{{route('admin.index')}}">

            <i class="fa fa-fw fa-dashboard"></i>

            <span class="nav-link-text">Dashboard</span>

          </a>

        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">

          <a class="nav-link" href="{{url('adminpackege')}}">

            <i class="  fa fa-asterisk"></i>

            <span class="nav-link-text">Packeges</span>

          </a>

        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">

          <a class="nav-link" href="{{route('admin.payments')}}">

            <i class="  fa fa-credit-card"></i>

            <span class="nav-link-text">Payments</span>

          </a>

        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">

          <a class="nav-link" href="{{route('admin.moods')}}">

            <i class=" fa fa-headphones"></i>

            <span class="nav-link-text">Moods</span>

          </a>

        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">

          <a class="nav-link" href="{{route('admin.generation')}}">

            <i class="fa fa-music"></i>

            <span class="nav-link-text">Generation</span>

          </a>

        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">

          <a class="nav-link" href="{{route('admin.sales')}}">

            <i class="fa fa-bell"></i>

            <span class="nav-link-text">All Sales</span>

          </a>

        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">

          <a class="nav-link" href="{{route('admin.users')}}">

            <i class="fa fa-user"></i>

            <span class="nav-link-text">All Users</span>

          </a>

        </li>

        

        

      </ul>

      @endrole

      <ul class="navbar-nav sidenav-toggler">

        <li class="nav-item" style="background: #71328b">

          <a class="nav-link text-center" id="sidenavToggler">

            <i class="fa fa-fw fa-angle-left"></i>

          </a>

        </li>

      </ul>

      <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">

          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My Profile

            <i class="fa fa-fw fa-user"></i>

           </a>

          <div class="dropdown-menu" aria-labelledby="alertsDropdown" style="width: 170px">

            

            <div class="dropdown-divider"></div>

            @role('seller')

            <?php

              $user = Auth::user()->id;

            ?>

            <a class="dropdown-item" href="{{url('myaccount')}}/{{$user}}">

              <span class="">

                My Account

              </span>

              

            </a>

            @endrole

            @role('admin')

            <?php

              $user = Auth::user()->id;

            ?>

               <a class="dropdown-item" href="{{url('myaccount')}}/{{$user}}">

              <span class="">

                My Account

              </span>

              

            </a>

            @endrole

            <div class="dropdown-divider"></div>

            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">

              <span class="text-danger">

               <i class="fa fa-fw fa-sign-out"></i> Logout

              </span>

              

            </a>

            

        </li>



        

      </ul>

    </div>

</nav>