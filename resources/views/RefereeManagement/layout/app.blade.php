<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- CSS -->

        <!--Global CSS -->
        <link href="{{asset('css/refereemanage/globals.css')}}" rel="stylesheet"/>

        <!--agent css-->
        <link href="{{asset('css/refereemanage/2dmanage.css')}}" rel="stylesheet"/>
        <link rel="stylesheet" href="{{asset('css/refereemanage/3d&lonepyinemanage.css') }}">
        <link rel="stylesheet" href="{{ asset('css/refereemanage/agentdata.css') }}">
        <link rel="stylesheet" href="{{ asset('css/refereemanage/agentprofile.css') }}">
        <link rel="stylesheet" href="{{ asset('css/refereemanage/agentrequestlist.css') }}">
        <link rel="stylesheet" href="{{ asset('css/refereemanage/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/refereemanage/createpermission.css') }}">
        <link rel="stylesheet" href="{{ asset('css/refereemanage/createrole.css') }}">
        <link rel="stylesheet" href="{{ asset('css/refereemanage/dailysalebook.css') }}">
        <link rel="stylesheet" href="{{ asset('css/refereemanage/globals.css') }}">
        <link rel="stylesheet" href="{{ asset('css/refereemanage/permission.css') }}">
        <link rel="stylesheet" href="{{ asset('css/refereemanage/referee.css') }}">
        <link rel="stylesheet" href="{{ asset('css/refereemanage/refereedata.css') }}">
        <link rel="stylesheet" href="{{ asset('css/refereemanage/refereeprofile.css') }}">
        <link rel="stylesheet" href="{{ asset('css/refereemanage/refereeRequests.css') }}">
        <link rel="stylesheet" href="{{ asset('css/refereemanage/refreesale.css') }}">
        <link rel="stylesheet" href="{{ asset('css/refereemanage/role.css') }}">
        <link rel="stylesheet" href="{{ asset('css/refereemanage/roleviewdetail.css') }}">
        {{-- 2D CSS --}}
        <link href="{{asset('css/refereemanage/2dsalelist.css')}}" rel="stylesheet"/>

        {{-- dailysalelist --}}
        <link href="{{asset('css/refereemanage/dailysalebook.css')}}" rel="stylesheet"/>

        <!-- font awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />

        <!--iconify-->
        <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

     <title>Trail Blazers</title>
  </head>
  <body>

    <div class="parent-container">

      <!--side bar start-->
      @include('RefereeManagement.layout.sidebar')
      <!--side bar end-->

      <!--left side main container start-->
      <div class="main-content-container">
        <!--top bar start-->
            @include('RefereeManagement.layout.topbar')
        <!--top bar end-->

        <!--main content start-->
        <div class="main-content-parent-container">
                @yield('content')
        </div>
        <!--main content end-->

      </div>
      <!--left side main container end-->

    </div>

    <script src="{{asset('jquery/refereemanage/referee.js')}}"></script>
    <script src="{{asset('jquery/refereemanage/sidebar.js')}}"></script>

    {{-- <script src="{{asset('jquery/dailysalebook.js')}}"></script> --}}


    {{-- <script src="{{ asset('js/chart.js') }}"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}


   @yield('script')
  </body>
</html>
