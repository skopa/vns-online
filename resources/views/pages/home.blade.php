@extends('app')

@section('content')
    <div class="row">
        <div class="col s6 m3">
            <div class="card">
                <div class="card-content">
                    <b>Online</b>
                    (VNS "online" time)
                </div>
                <div class="card-action">
                    <b>{{ number_format($time / 60, 2) }} minutes</b>
                </div>
            </div>
        </div>
        <div class="col s6 m3">
            <div class="card">
                <div class="card-content">
                    <b>Clicks</b>
                    (VNS total clicks)
                </div>
                <div class="card-action">
                    <b>{{ $clicks }} Times</b>
                </div>
            </div>
        </div>
        <div class="col s6 m3">
            <div class="card">
                <div class="card-content">
                    <b>Available</b>
                    (Payed clicks)
                </div>
                <div class="card-action">
                    <b>{{ $available_clicks }} Times</b>
                </div>
            </div>
        </div>
        <div class="col s6 m3">
            <div class="card">
                <div class="card-content">
                    <b>Links</b>
                    (Links to click)
                </div>
                <div class="card-action">
                    <b>{{ $links }} pc.</b>
                </div>
            </div>
        </div>
    </div>
@endsection
