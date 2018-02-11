@extends('base')

@section('body')
    <nav>
        <div class="nav-wrapper">
            <a href="{{ route('welcome') }}" class="brand-logo">VNS Online</a>
            <a href="#" data-activates="mobile" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="{{ route('profile.show') }}">{{ Auth::user()->name }}</a></li>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('visitTimeLines.index') }}">Timetable</a></li>
                <li><a href="{{ route('links.index') }}">Links</a></li>
                <li><a href="{{ route('clicks') }}">Clicks Stats</a></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
            </ul>
            <ul class="side-nav" id="mobile">
                <li><a href="{{ route('profile.show') }}">{{ Auth::user()->name }}</a></li>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('visitTimeLines.index') }}">Timetable</a></li>
                <li><a href="{{ route('links.index') }}">Links</a></li>
                <li><a href="{{ route('clicks') }}">Clicks Stats</a></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <!-- Page Content goes here -->
        @yield('content')
    </div>
    <script>
        $(".button-collapse").sideNav();
    </script>
    @yield('js')
@endsection