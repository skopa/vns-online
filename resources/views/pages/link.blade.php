@extends('app')

@section('content')
    <div class="row">
        <div class="col s12 m12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Exists Links</span>
                    <table class="responsive-table">
                        <thead class="centered">
                        <tr>
                            <th>#</th>
                            <th>Comment</th>
                            <th>Url</th>
                            <th>Status</th>
                            <th>Visits</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($links as $link)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $link->comment }}</td>
                                <td>{{ $link->link }}<br>({{ $link->visitTimeLine->period }})</td>
                                <td>
                                    <div class="switch">
                                        <label>
                                            <input disabled type="checkbox" {{ $link->is_enabled?'checked':'' }}>
                                            <span class="lever"></span>
                                        </label>
                                    </div>
                                </td>
                                <td>{{ $link->visits_count }}</td>
                                <td>
                                    <a class="btn waves-effect waves-light"
                                       href="{{ route('links.show', ['link' => $link->id]) }}">Edit</a>
                                    &nbsp;
                                    <button class="btn waves-effect waves-light"
                                            onclick="$('form[data-id=\'{{$link->id}}\']').submit()">
                                        delete
                                    </button>
                                    <form action="{{ route('links.destroy', ['link' => $link->id]) }}"
                                          data-id="{{ $link->id }}" method="POST">
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                    </form>
                                </td>
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
                    <span class="card-title">New Link</span>
                    <div class="row">
                        <form class="col s12" method="POST" action="{{ route('links.store') }}">
                            {!! csrf_field() !!}
                            {!! method_field('POST') !!}
                            <div class="row">
                                <div class="input-field col s12">

                                    <input id="link" type="url"
                                           class="{{ $errors->has('link')?'invalid':'' }}"
                                           name="link" value="{{ old('link') }}">
                                    <label data-error="{{ $errors->first('link') }}"
                                           for="link">My subject lecture link url</label>

                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="comment" type="text"
                                           class="{{ $errors->has('comment')?'invalid':'' }}"
                                           name="comment" value="{{ old('comment') }}">
                                    <label data-error="{{ $errors->first('comment') }}"
                                           for="comment">Name or comment</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <select id="visitTimeLine" name="visit_time_line_id">
                                        <option value="" disabled selected>Choose your time line</option>
                                        @foreach($visitTimeLines as $timeLine)
                                            <option value="{{ $timeLine->id }}"
                                            >{{ $timeLine->from }} - {{ $timeLine->to }}</option>
                                        @endforeach
                                    </select>
                                    <label for="visitTimeLine">Visit TimeLine</label>
                                </div>
                            </div>

                            <p>
                                <input type="checkbox" id="is_enabled" value="1"
                                       name="is_enabled" {{ old('comment', 0)?'checked="checked"':'' }}/>
                                <label for="is_enabled">Is enabled. Without this link will not be clicked :p</label>
                            </p>

                            <div class="row">
                                <br>
                                <div class="col right">
                                    <button class="btn waves-effect waves-light" type="submit" name="action">
                                        Create
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
