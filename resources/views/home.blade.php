@extends('layouts.app')

@section('content')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
    </style>
    <body class="w3-dark-dark">


    <!-- Sidebar/menu -->
    <nav class="w3-sidebar w3-collapse w3-dark-bl w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
        <div class="w3-container 3-row">
            <div class="w3-col s4">
                <img src="{{{Gravatar::get(Auth::user()->email) }}}" class="w3-circle w3-margin-right" style="width:46px">
            </div>


            <div class="w3-col s8 w3-bar">
                <span>Welcome, <strong>{{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}</strong></span><br>
                <div >
                    <div>
                        <a id="navbarDropdown" class="nav-item w3-bar-item dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa fa-user"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('Logout2') }}"
                               onclick="event.preventDefault();
                                                         document.getElementById('Logout2-form').submit();">
                                {{ __('Logout2') }}
                            </a>
                            <a class="dropdown-item" href="" onclick="event.preventDefault(); document.getElementById('usersettings').submit();">
                                {{__('usersettings')}}
                            </a>

                            <form id="Logout2-form" action="{{ route('Logout2') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <form id="usersettings" action="{{ route('usersettings') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>

                    <div>

                        <a id="navbarDropdown" class="nav-item w3-bar-item dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa fa-envelope"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @if (Auth::user()->newThreadsCount() > 0)
                            <a class="dropdown-item" href="{{ route('messages') }}"
                               onclick="event.preventDefault(); document.getElementById('beskeder').submit();">
                                {{__('messages')}} ({{Auth::user()->newThreadsCount()}})
                            </a>
                            <form id="beskeder" action="{{ route('messages') }}" method="GET" class="d-none">
                                @csrf
                            </form>
                        @else
                                <a class="dropdown-item" href="{{ route('messages') }}"
                                   onclick="event.preventDefault(); document.getElementById('beskeder').submit();">
                                    {{__('messages')}}
                                </a>
                                <form id="beskeder" action="{{ route('messages') }}" method="GET" class="d-none">
                                    @csrf
                                </form>
                        @endif
                        </div>
                    </div>
                    <div>

                        <a id="navbarDropdown" class="nav-item w3-bar-item dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa fa-cog"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-left td" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <a class="dropdown-item" href="" onclick="event.preventDefault(); document.getElementById('usersettings').submit();">
                                {{__('usersettings')}}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <form id="usersettings" action="{{ route('usersettings') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="w3-container">
            <h5>Dashboard</h5>
        </div>
        <div class="w3-bar-block">
            <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
            <a href="{{'home'}}" class="w3-bar-item w3-button w3-padding  w3-blue"><i class="fa fa-users fa-fw"></i>  Overview</a>
            <a href="{{'server'}}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-server fa-fw"></i>  Server</a>
            <a href="{{'reports'}}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-flag-checkered fa-fw"></i>  Reports</a>
            <a href="{{'hackerguardian'}}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-shield fa-fw"></i>  HackerGuardian</a>
            <a href="{{'chat'}}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-comments fa-fw"></i>  Chat</a>
            <a href="{{'logs'}}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-address-book fa-fw"></i>  Logs</a>
            <a href="{{'history'}}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-history fa-fw"></i>  History</a>
            <a href="{{'settings'}}" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Settings</a><br><br>
        </div>
    </nav>


    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

    <!-- !PAGE CONTENT! -->
    <div class="w3-main" style="margin-left:300px;margin-top:43px;">

        <!-- Header -->
        <header class="w3-container" style="padding-top:22px">
            <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
        </header>

        <div class="w3-row-padding w3-margin-bottom">
            <div class="w3-quarter">
                <div class="w3-container w3-red w3-padding-16">
                    <div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
                    <div class="w3-right">
                       {{-- <h3>{{\App\Http\Controllers\GetOnlinePlayersController::GetOnlinePlayers('panel.zennodes.dk', 25749)}} / 50</h3>--}}
                    </div>
                    <div class="w3-clear"></div>
                    <h4>OnlinePlayers</h4>
                </div>
            </div>
            <div class="w3-quarter">
                <div class="w3-container w3-blue w3-padding-16">
                    <div class="w3-left"><i class="fa fa-eye w3-xxxlarge"></i></div>
                    <div class="w3-right">
                        <h3>99</h3>
                    </div>
                    <div class="w3-clear"></div>
                    <h4>Ban appels</h4>
                </div>
            </div>
            <div class="w3-quarter">
                <div class="w3-container w3-teal w3-padding-16">
                    <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
                    <div class="w3-right">
                        <h3>23</h3>
                    </div>
                    <div class="w3-clear"></div>
                    <h4>Staff Online</h4>
                </div>
            </div>
            <div class="w3-quarter">
                <div class="w3-container w3-orange w3-text-white w3-padding-16">
                    <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
                    <div class="w3-right">
                        <h3>50</h3>
                    </div>
                    <div class="w3-clear"></div>
                    <h4>Reports
                    </h4>
                </div>
            </div>
        </div>

        <div class="w3-panel">
            <div class="w3-row-padding" style="margin:0 -16px">
                <div class="w3-third">
                    <h5>Mojang Service status</h5>
                    <table class="w3-table w3-striped w3-white">
                        {{\App\Http\Controllers\GetMojangServiceStatusController::MCStatus()}}
                    </table>
                </div>
                <div class="w3-twothird">
                    <h5>Feeds</h5>
                    <table class="w3-table w3-striped w3-white">
                        <tr>
                            <td><i class="fa fa-user w3-text-blue w3-large"></i></td>
                            <td>New record, over 90 views.</td>
                            <td><i>10 mins</i></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-bell w3-text-red w3-large"></i></td>
                            <td>Database error.</td>
                            <td><i>15 mins</i></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-users w3-text-yellow w3-large"></i></td>
                            <td>New record, over 40 users.</td>
                            <td><i>17 mins</i></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-comment w3-text-red w3-large"></i></td>
                            <td>New comments.</td>
                            <td><i>25 mins</i></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-bookmark w3-text-blue w3-large"></i></td>
                            <td>Check transactions.</td>
                            <td><i>28 mins</i></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-laptop w3-text-red w3-large"></i></td>
                            <td>CPU overload.</td>
                            <td><i>35 mins</i></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-share-alt w3-text-green w3-large"></i></td>
                            <td>New shares.</td>
                            <td><i>39 mins</i></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <hr>



        <!--
        <div class="w3-container">
            <h5>General Stats</h5>
            <p>New Visitors</p>
            <div class="w3-grey">
                <div class="w3-container w3-center w3-padding w3-green" style="width:25%">+25%</div>
            </div>

            <p>New Users</p>
            <div class="w3-grey">
                <div class="w3-container w3-center w3-padding w3-orange" style="width:50%">50%</div>
            </div>

            <p>Bounce Rate</p>
            <div class="w3-grey">
                <div class="w3-container w3-center w3-padding w3-red" style="width:75%">75%</div>
            </div>
        </div>
        <hr>

        <div class="w3-container">
            <h5>Countries</h5>
            <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
                <tr>
                    <td>United States</td>
                    <td>65%</td>
                </tr>
                <tr>
                    <td>UK</td>
                    <td>15.7%</td>
                </tr>
                <tr>
                    <td>Russia</td>
                    <td>5.6%</td>
                </tr>
                <tr>
                    <td>Spain</td>
                    <td>2.1%</td>
                </tr>
                <tr>
                    <td>India</td>
                    <td>1.9%</td>
                </tr>
                <tr>
                    <td>France</td>
                    <td>1.5%</td>
                </tr>
            </table><br>
            <button class="w3-button w3-dark-grey">More Countries &nbsp;<i class="fa fa-arrow-right"></i></button>
        </div>
        <hr>
        <div class="w3-container">
            <h5>Recent Users</h5>
            <ul class="w3-ul w3-card-4 w3-white">
                <li class="w3-padding-16">
                    <img src="/w3images/avatar2.png" class="w3-left w3-circle w3-margin-right" style="width:35px">
                    <span class="w3-xlarge">Mike</span><br>
                </li>
                <li class="w3-padding-16">
                    <img src="/w3images/avatar5.png" class="w3-left w3-circle w3-margin-right" style="width:35px">
                    <span class="w3-xlarge">Jill</span><br>
                </li>
                <li class="w3-padding-16">
                    <img src="/w3images/avatar6.png" class="w3-left w3-circle w3-margin-right" style="width:35px">
                    <span class="w3-xlarge">Jane</span><br>
                </li>
            </ul>
        </div>
        <hr>

        <div class="w3-container">
            <h5>Recent Comments</h5>
            <div class="w3-row">
                <div class="w3-col m2 text-center">
                    <img class="w3-circle" src="/w3images/avatar3.png" style="width:96px;height:96px">
                </div>
                <div class="w3-col m10 w3-container">
                    <h4>John <span class="w3-opacity w3-medium">Sep 29, 2014, 9:12 PM</span></h4>
                    <p>Keep up the GREAT work! I am cheering for you!! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><br>
                </div>
            </div>

            <div class="w3-row">
                <div class="w3-col m2 text-center">
                    <img class="w3-circle" src="/w3images/avatar1.png" style="width:96px;height:96px">
                </div>
                <div class="w3-col m10 w3-container">
                    <h4>Bo <span class="w3-opacity w3-medium">Sep 28, 2014, 10:15 PM</span></h4>
                    <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><br>
                </div>
            </div>
        </div>
        <br>
        <div class="w3-container w3-dark-grey w3-padding-32">
            <div class="w3-row">
                <div class="w3-container w3-third">
                    <h5 class="w3-bottombar w3-border-green">Demographic</h5>
                    <p>Language</p>
                    <p>Country</p>
                    <p>City</p>
                </div>
                <div class="w3-container w3-third">
                    <h5 class="w3-bottombar w3-border-red">System</h5>
                    <p>Browser</p>
                    <p>OS</p>
                    <p>More</p>
                </div>
                <div class="w3-container w3-third">
                    <h5 class="w3-bottombar w3-border-orange">Target</h5>
                    <p>Users</p>
                    <p>Active</p>
                    <p>Geo</p>
                    <p>Interests</p>
                </div>
            </div>
        </div>-->

        <!-- Footer-->
        <footer class="w3-container w3-padding-16 w3-">
            <strong><i class="fa fa-fw fa-clock-o"></i></strong> {{ round(microtime(true) - LARAVEL_START, 3) }}s

        </footer>

    </div>

    <script>
        // Get the Sidebar
        var mySidebar = document.getElementById("mySidebar");

        // Get the DIV with overlay effect
        var overlayBg = document.getElementById("myOverlay");

        // Toggle between showing and hiding the sidebar, and add overlay effect
        function w3_open() {
            if (mySidebar.style.display === 'block') {
                mySidebar.style.display = 'none';
                overlayBg.style.display = "none";
            } else {
                mySidebar.style.display = 'block';
                overlayBg.style.display = "block";
            }
        }

        // Close the sidebar with the close button
        function w3_close() {
            mySidebar.style.display = "none";
            overlayBg.style.display = "none";
        }
    </script>



{{--
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                        {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}

                </div>
            </div>
        </div>
    </div>
</div>
--}}
@include('sweetalert::alert')

@endsection
