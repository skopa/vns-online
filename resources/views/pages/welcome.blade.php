@extends('base')

@section('body')
    <div class="welcome">
        <div class="content">
            <h1>Be a great student -<br>be an online student!</h1>
            <h3>Teachers can be great too :)</h3>
            <br>
            <div class="links">
                @auth
                    <a class="waves-effect waves-light btn-large" href="{{ url('/home') }}">Home</a>
                @else
                    <a class="waves-effect waves-light btn-large" href="{{ route('login') }}">Login</>
                @endauth
            </div>
        </div>
    </div>
@endsection