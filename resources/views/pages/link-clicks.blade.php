@extends('app')

@section('content')
    <div class="row">
        <div class="col s12 m12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Clicked Links</span>
                    <table class="responsive-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Link</th>
                            <th>Date</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($clicks as $link)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $link->comment }}</td>
                                <td>{{ $link->link }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12 m12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Logs</span>
                    <table class="responsive-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Event</th>
                            <th>Date</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $event->event }}</td>
                                <td>{{ $event->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
