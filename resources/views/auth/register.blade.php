@extends('layouts.app')
@section('title')
{{__('message.register').' - '}}
@endsection
@section('fb-events')
<script>
  fbq('track', 'ViewContent');
</script>
@endsection
@section('content')
<div class="container">
  @if (session('success'))
    <div class="medium-panel">
        <div class="padding-15-top align-center">
          <label class="font-15em font-green">{{__('auth.register_success')}}</label>
        </div>
        <div class="panel-body align-center">
        <h3 class="no-margin font-grey">{{__('auth.verification_sent')}}</h3>
        <p class="font-red">*{{__('auth.verification_sent_notice')}}</p>
        <div class="padding-15-vertical">
          <a class="help-btn padding-10" href="{{ route('resendEmail') }}">{{ __('auth.verify_resend') }}</a>
        </div>
        <h3><a href="{{route('home')}}" class="link-text"><<< {{ __('error.home_route') }}</a></h3>
        </div>
    </div>
  @else
    <div class="pop-up-panel">
        <div class="panel-heading"><label class="heading">{{__('message.register')}}</label></div>
        <div class="panel-body relative">
          <load-overlay bg="white-bg" :show="loading"></load-overlay>
            <form role="form" method="POST" action="{{ route('register') }}" v-on:submit="$root.loading = true">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="full-label">{{__('message.register_name')}}</label>
                        <input id="name" type="text" class="form-input {{ $errors->has('name') ? ' error-input' : '' }}" name="name" required autofocus>
                        @if ($errors->has('name'))
                            <span class="span-error">{{ $errors->first('name') }}</span>
                        @endif
                </div>

                <div class="form-group">
                  <label for="gender">{{__('message.gender')}}</label>
                  <input id="men" required type="radio" name="gender" value="men"><label for="men" class="font-large">&nbsp;{{__('message.men')}}</label>
                  <input id="women" required type="radio" name="gender" value="women"><label for="women" class="font-large">&nbsp;{{__('message.women')}}</label>
                  <input id="etc" required type="radio" name="gender" value="etc"><label for="etc" class="font-large">&nbsp;{{__('message.etc')}}</label>
                </div>

                <div class="form-group">
                  <div class="input-group date-input">
                    <label class="margin-10-right" for="date">{{__('message.birth_date')}}</label>&nbsp;
                    <input required maxlength="2" oninput="this.value=this.value.slice(0,this.maxLength)" min="1" max="31" class="form-input" type="number" name="date" placeholder="{{__('message.date_placeholder')}}">
                    <input required maxlength="2" oninput="this.value=this.value.slice(0,this.maxLength)" min="1" max="12" class="form-input" type="number" name="month" placeholder="{{__('message.month_placeholder')}}">
                    <input required maxlength="4" oninput="this.value=this.value.slice(0,this.maxLength)" max="{{ now()->year }}" class="form-input" type="number" name="year" placeholder="{{__('message.year_placeholder')}}">
                  </div>
                  @if ($errors->has('date'))
                      <span class="full-width span-error">{{ $errors->first('date') }}</span>
                  @endif
                  @if ($errors->has('month'))
                      <span class="full-width span-error">{{ $errors->first('month') }}</span>
                  @endif
                  @if ($errors->has('year'))
                      <span class="full-width span-error">{{ $errors->first('year') }}</span>
                  @endif
                </div>

                <div class="display-hidden">
                  <label for="profile_type">{{__('message.profile_type')}}</label>
                  <select class="select-input" name="profile_type">
                    <option value="1">{{__('message.shop')}}</option>
                  </select>
                </div>

                <div class="form-group{{ $errors->has('shop_name') ? ' has-error' : '' }}">
                    <label for="shop_name" class="full-label">{{__('message.register_shop')}}<br>
                      <sub>{{__('message.shop_name_tip')}}</sub>
                    </label>
                        <input id="shop_name" type="text" class="form-input {{ $errors->has('shop_name') ? ' error-input' : '' }}" name="shop_name" required placeholder="{{__('message.shop_name_placeholder')}}">

                        @if ($errors->has('shop_name'))
                            <span class="span-error">{{ $errors->first('shop_name') }}</span>
                        @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="full-label">{{__('auth.email')}}</label>

                        <input id="email" type="email" class="form-input {{ $errors->has('email') ? ' error-input' : '' }}" name="email" required placeholder="example@gmail.com">

                        @if ($errors->has('email'))
                            <span class="span-error">{{ $errors->first('email') }}</span>
                        @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="full-label">{{ __('auth.password')}}</label>
                        <input id="password" type="password" class="form-input {{ $errors->has('password') ? ' error-input' : '' }}" name="password" required placeholder="{{__('message.password_placeholder')}}">

                        @if ($errors->has('password'))
                            <span class="span-error">{{ $errors->first('password') }}</span>
                        @endif
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="full-label">{{__('auth.confirm_password')}}</label>
                    <input id="password-confirm" type="password" class="form-input {{ $errors->has('password-confirm') ? ' error-input' : '' }}" name="password_confirmation" required>
                </div>

                <div class="padding-15-top align-right">
                  <button :disabled="$root.loading" type="submit" class="orange-btn normal-sq">{{__('message.register')}}</button>
                </div>
                @csrf
            </form>
        </div>
    </div>
  @endif

</div>

@endsection
