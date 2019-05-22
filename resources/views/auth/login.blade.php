@include('../layout.layout_header')
<link rel="stylesheet" href="{{ asset('css/bulma-checkradio.min.css') }}">

<body>
    <div class="container">  
        <div class="column">
            <br>
                <div class="is-size-2">Login</div>
                <br>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="field">
                            <div  class="label">{{ __('E-Mail Address') }}:</div>
                            <div class="control">
                                    <input id="email" type="email" class="input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="field">
                            <div  class="label">{{ __('Password') }}:</div>
                            <div class="control">
                                <input id="password" type="password" class="input form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="field">
                            <p class="control">
                                <div class="b-checkbox is-default">
                                    <input type="checkbox" id="rememberChkBox" class="is-checkradio is-info" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="rememberChkBox"> Onthoud mij</label>
                                </div>
                            </p>
                        </div>

                        <div class="control">
                            <div class="control">
                                    <button type="submit" class="button is-primary">
                                            {{ __('Login') }}
                                        </button>
                            </div>
                        </div>

                                
                            
                    </form>
                </div>
            </div>
        </div>
    </body>
