@extends('layouts.app')
@section('title')

@endsection
@section('content')

<div class="container">
  <div class="medium-panel">
    <div class="panel-heading">
      <label class="full-label heading">{{__('message.promotions_manage')}}</label>
    </div>
    <div class="panel-body">
      <div class="shadow-2 margin-20-bottom">
        <div class="color-heading">
          <label class="full-label heading font-white">{{__('message.discount_code')}}</label>
        </div>
        <div class="panel-body">
          <ul>
            <li>{{__('message.discount_code_info1')}}<font class="font-red">{{__('message.entire_order')}}</font>{{__('message.discount_code_info1_end')}}</li>
            <li><p class="no-margin">{{__('message.discount_code_info2')}}</p></li>
          </ul>
          <div class="align-right padding-15-vertical">
            <a class="flat-btn font-15em" href="{{route('promotionCode')}}">{{__('message.proceed')}}&nbsp;<i class="fas fa-angle-double-right"></i></a>
          </div>
        </div>
      </div>

      <div class="shadow-2">
        <div class="color-heading">
          <label class="full-label heading font-white">{{__('message.product_discount')}}</label>
        </div>
        <div class="panel-body">
          <label class="heading">
            <font class="{{$points['discount'] ? 'font-green' : 'font-red'}}">{{__('message.promotions_points')}}&nbsp;:&nbsp;{{$points['discount']}}</font>
          </label>
          <ul>
            <li>{{__('message.product_discount_info1')}}</li>
            <li><p class="no-margin">{{__('message.product_discount_info3')}}</p></li>
            <li><p class="no-margin">{{__('message.product_discount_info2')}}</p></li>
            <li><p class="no-margin font-red">{{__('message.product_discount_info2_end')}}</p></li>
            <li><p class="no-margin font-red">{{__('message.product_discount_info4')}}</p></li>
          </ul>
          <div class="align-right padding-15-vertical">
            <a class="flat-btn font-15em" href="{{route('promotionDiscount')}}">{{__('message.proceed')}}&nbsp;<i class="fas fa-angle-double-right"></i></a>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>
@endsection
