@extends('base')

@section('body')
    <nav>
        <div class="nav-wrapper">
            <a href="{{ route('welcome') }}" class="brand-logo">VNS Online</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="{{ route('profile.show') }}">{{ Auth::user()->name }}</a></li>
                <li><a>Timetable</a></li>
                <li><a>Links</a></li>
                <li><a>Clicks Stats</a></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <!-- Page Content goes here -->
        @yield('content')
    </div>
@endsection