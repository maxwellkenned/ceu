@extends('layouts.app')

@section('content')
<div class="container-fluid margin-top">
    <div class="row align-items-center">
        <div class="col-xs-offset-1 col-xs-10 col-sm-offset-0 col-sm-6 col-md-offset-1 col-md-6">
            <img class="img-fluid" src="./images/cloud1.png" alt="" />
        </div>
        <div class="col-xs-12 col-sm-5 col-md-4 login">
            <div class="panel panel-default login-panel">
                <div class="panel-heading text-white align-middle login-heading"><strong>Entrar</strong></div>
                <div class="panel-body login-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-3 control-label">E-mail</label>

                            <div class="col-md-9">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus  tabindex="1">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-3 control-label">Senha</label>

                            <div class="col-md-9">
                                <input id="password" type="password" class="form-control" name="password" required  tabindex="2">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-3">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}  tabindex="3"> Manter conectado
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="col-md-7 align-middle"><a class="alert alert-danger" href="{{ route('password.request') }}"  tabindex="5">Esqueceu a senha?</a>
                            </div>
                            <div class="col-md-4 col-md-offset-1 text-right">
                                <button type="submit" class="btn btn-primary btn-block"  tabindex="4">
                                    Entrar
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
