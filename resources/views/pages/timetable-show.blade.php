@extends('app')

@section('content')
    <div class="row">
        <div class="col s12 m10 offset-m1">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Change Timetable</span>
                    <div class="row">
                        <form class="col s12" method="POST"
                              action="{{ route('visitTimeLines.update', ['timetable' => $visitTimeLine->id]) }}">
                            {!! method_field('PUT') !!}
                            {!! csrf_field() !!}

                            <div class="row">
                                <div class="input-field col s12">

                                    <input id="from" type="text"
                                           class="timepicker {{ $errors->has('from')?'invalid':'' }}"
                                           name="from" value="{{ old('from', $visitTimeLine->from) }}">
                                    <label data-error="{{ $errors->first('from') }}"
                                           for="from">Active from time</label>

                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="to" type="text"
                                           class="timepicker {{ $errors->has('to')?'invalid':'' }}"
                                           name="to" value="{{ old('to', $visitTimeLine->to) }}">
                                    <label data-error="{{ $errors->first('to') }}"
                                           for="to">Active to time</label>
                                </div>
                            </div>

                            <p class="range-field">
                                <label data-error="{{ $errors->first('clicks_per_period') }}"
                                       for="clicks_per_period">Clicks per session</label>
                                <input type="range" id="clicks_per_period"
                                       class="{{ $errors->has('clicks_per_period')?'invalid':'' }}"
                                       value="{{ old('clicks_per_period', $visitTimeLine->clicks_per_period) }}"
                                       min="1" max="10" name="clicks_per_period"/>
                            </p>

                            @if($errors->count() > 0)
                                <p>
                                    {{ $errors->first() }}
                                </p>
                            @endif

                            <button class="btn waves-effect waves-light right" type="submit" name="action">Save
                                <i class="material-icons right">send</i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('js')
    <script>

        $('.timepicker').pickatime({
            default: 'now', // Set default time: 'now', '1:30AM', '16:30'
            fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
            twelvehour: false, // Use AM/PM or 24-hour format
            donetext: 'OK', // text for done-button
            cleartext: 'Clear', // text for clear-button
            canceltext: 'Cancel', // Text for cancel-button
            autoclose: false, // automatic close timepicker
            ampmclickable: true, // make AM PM clickable
            aftershow: function () {
            } //Function for after opening timepicker
        });
    </script>
@endsection