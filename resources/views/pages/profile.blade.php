@extends('app')

@section('content')
    <div class="row">
        <div class="col s12 m10 offset-m1">
            <div class="row">
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-content">
                            <b>Pings</b><br>
                            <small>(VNS "online" requests)</small>
                        </div>
                        <div class="card-action">
                            <b>{{ $requests }} Times</b>
                        </div>
                    </div>
                </div>

                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-content">
                            <b>Clicks</b><br>
                            <small>(VNS total clicks)</small>
                        </div>
                        <div class="card-action">
                            <b>{{ $clicks }} Times</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12 m10 offset-m1">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Profile</span>

                    <div class="row">
                        <form class="col s12" method="POST" action="{{ route('profile.update') }}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input disabled value="{{ $user->name }}" id="disabled" type="text"
                                           class="validate">
                                    <label for="disabled">Name</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <input disabled value="{{ $user->email }}" id="disabled" type="text"
                                           class="validate">
                                    <label for="disabled">Login Email</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s9">
                                    <input disabled value="{{ $user->available_clicks }}" id="disabled" type="text"
                                           class="validate">
                                    <label for="disabled">Available clicks</label>
                                </div>
                                <div class="col s3">
                                    <button class="btn waves-effect waves-light right" type="submit" name="action">Pay
                                        more
                                        <i class="material-icons right">pay</i>
                                    </button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="vns_email" type="text"
                                           class="{{ $errors->has('vns_email')?'invalid':'' }}"
                                           name="vns_email" value="{{ old('vns_email', $user->vns_email) }}">
                                    <label for="vns_email" data-error="{{ $errors->first('vns_email') }}">VNS
                                        Login</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="password" type="text"
                                           class="{{ $errors->has('vns_password')?'invalid':'' }}"
                                           name="vns_password" value="{{ old('vns_password', $user->vns_password) }}">
                                    <label for="password" data-error="{{ $errors->first('vns_password') }}">VNS
                                        Password</label>
                                </div>
                            </div>

                            <p>
                                <input type="checkbox" id="is_enabled" value="1"
                                       name="is_enabled" {{ $user->is_enabled?'checked="checked"':'' }}/>
                                <label for="is_enabled">Is enabled. Without this check we will not to work with You
                                    :p</label>
                            </p>

                            <button class="btn waves-effect waves-light right" type="submit" name="action">Submit
                                <i class="material-icons right">send</i>
                            </button>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
