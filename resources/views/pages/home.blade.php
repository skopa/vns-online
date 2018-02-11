@extends('app')

@section('content')
    <div class="row">
        <div class="col s6 m3">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Online</span>
                    (VNS "online" time)
                </div>
                <div class="card-action">
                    <h5>{{ number_format($time / 60, 2) }} minutes</h5>
                </div>
            </div>
        </div>
        <div class="col s6 m3">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Clicks</span>
                    (VNS total clicks)
                </div>
                <div class="card-action">
                    <h5>{{ $clicks }} Times</h5>
                </div>
            </div>
        </div>
        <div class="col s6 m3">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Available</span>
                    (Payed clicks)
                </div>
                <div class="card-action">
                    <h5>{{ $available_clicks }} Times</h5>
                </div>
            </div>
        </div>
        <div class="col s6 m3">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Links</span>
                    (Links to click)
                </div>
                <div class="card-action">
                    <h5>{{ $links }} pc.</h5>
                </div>
            </div>
        </div>
    </div>
@endsection
