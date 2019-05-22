@extends('home')


@section('content')
<div class="columns is-multiline">
        <div class="is-size-3 column is-12">Alle moderators</div>
        @foreach ($moderators as $moderator)
        @if ($moderator->id == Auth::user()->id)
        <div class='box column is-12'>
                <b class="">Naam:</b> {{ $moderator->name }}<br>
                <b class="">Email:</b> {{ $moderator->email }}<br>
                <b class="">level:</b> {{ $moderator->level }}<br>
                <b class="">Gemaakt op:</b> {{ $moderator->created_at }}<br>
                <b>geupdate op:</b>{{ $moderator->updated_at}}
        </div>

        @else
        <div class='column is-12 box'>
                <div class="moderatorsInner columns is-multiline">
                        <div class="column ">
                                <b class="">Naam:</b> {{ $moderator->name }}<br>
                                <b class="">Email:</b> {{ $moderator->email }}<br>
                                @if (Auth::user()->level >= 3)
                                <form method="POST" action="update_moderator">
                                        @csrf
                                        <input name="id" type="text" hidden value="{{ $moderator->id }}">
                                        <div class="field">
                                                <div class="label">level:</div>
                                                <div class="select is-fullwidth">
                                                        <select id="LEVEL" name="level" required>
                                                                <option value="{{ $moderator->level }}">{{
                                                                        $moderator->level }}</option>
                                                                <option value="1">1 - Bekijk informatie</option>
                                                                <option value="2">2 - Verwijder posts</option>
                                                                <option value="3">3 - Beheer alles</option>
                                                        </select>
                                                </div>
                                        </div>
                                        <b class="">Gemaakt op:</b> {{ $moderator->created_at }}<br>
                                        <b>geupdate op:</b>{{ $moderator->updated_at}}<br>
                                        <input type="submit" class="col-12 center button is-warning m-t-md" value="Update">
                                </form>
                                <hr>
                                <form method="POST" action="delete_moderator" onsubmit="return confirm('Weet je zeker dat je deze moderator wilt deleten?');">
                                        @csrf
                                        <input type="text" name="id" hidden value="{{ $moderator->id }}">
                                        <input type="submit" class="col-12 center button is-danger" value="Delete">
                                </form>
                                @else
                                <b class="">level:</b> {{ $moderator->level }}<br>
                                <b class="">Gemaakt op:</b> {{ $moderator->created_at }}<br>
                                <b>Geupdate op:</b>{{ $moderator->updated_at}}
                                @endif
                        </div>
                </div>
        </div>
        @endif

        @endforeach
</div>
@if (Auth::user()->level >= 3)
<hr>
<div class="is-size-3" id="nieuwe_moderator">Moderator toevoegen</div>
<br>
<div class="columns">
        <div class="column is-12">
                <form method="POST" action="{{ route('register') }}" class="myForm" enctype="multipart/form-data">
                        @csrf
                        <div class="field">
                                <label class="label">{{ __('Name') }}</label>
                                <div class="control">
                                        <input type="text" class="input {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
                                </div>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                        </div>
                        <div class="field">
                                <label class="label">{{ __('Mail Address') }}</label>
                                <div class="control">
                                        <input type="email" class="input {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required value="">
                                </div>
                                @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                        </div>
                        <div class="field">
                                <label class="label">{{ __('Password') }}</label>
                                <div class="control">
                                        <input type="password" class="input {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required value="">
                                </div>
                                @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                        </div>
                        <div class="field">
                                <label class="label">{{ __('Confirm Password') }}</label>
                                <div class="control">
                                        <input id="password-confirm" type="password" class="input" name="password_confirmation" required>
                                </div>
                        </div>
                        <br>
                        <div class="field">
                                <input type="submit" class="button is-primary is-large" value="Aanmaken">
                        </div>
                        <br>
                </form>
        </div>
</div>
@endif


@stop