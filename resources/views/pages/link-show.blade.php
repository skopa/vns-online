@extends('app')

@section('content')
    <div class="row">
        <div class="col s12 m10 offset-m1">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Change Timetable</span>
                    <div class="row">
                        <form class="col s12" method="POST" action="{{ route('links.update', ['link' => $link->id]) }}">
                            {!! csrf_field() !!}
                            {!! method_field('PUT') !!}
                            <div class="row">
                                <div class="input-field col s12">

                                    <input id="link" type="url"
                                           class="{{ $errors->has('link')?'invalid':'' }}"
                                           name="link" value="{{ old('link', $link->link) }}">
                                    <label data-error="{{ $errors->first('link') }}"
                                           for="link">My subject lecture link url</label>

                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="comment" type="text"
                                           class="{{ $errors->has('comment')?'invalid':'' }}"
                                           name="comment" value="{{ old('comment', $link->comment) }}">
                                    <label data-error="{{ $errors->first('comment') }}"
                                           for="comment">Name or comment</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <select id="visitTimeLine" name="visit_time_line_id">
                                        <option value="" disabled>Choose your time line</option>
                                        @foreach($visitTimeLines as $timeLine)
                                            <option value="{{ $timeLine->id }}"
                                                    {{ $timeLine->id==$link->link_time_line_id?'selected':'' }}
                                            >{{ $timeLine->from }} - {{ $timeLine->to }}</option>
                                        @endforeach
                                    </select>
                                    <label for="visitTimeLine">Visit TimeLine</label>
                                </div>
                            </div>

                            <p>
                                <input type="checkbox" id="is_enabled" value="1"
                                       name="is_enabled" {{ old('is_enabled', $link->is_enabled)?'checked="checked"':'' }}/>
                                <label for="is_enabled">Is enabled. Without this link will not be clicked :p</label>
                            </p>

                            <div class="row">
                                <br>
                                <div class="col right">
                                    <button class="btn waves-effect waves-light" type="submit" name="action">
                                        Save
                                        <i class="material-icons right">send</i>
                                    </button>
                                    &nbsp;&nbsp;
                                    <button class="btn waves-effect waves-light" type="submit" name="action">
                                        Preview
                                        <i class="material-icons right">search</i>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $('select').material_select();
    </script>
@endsection