@extends('layouts.app')

@section('content')

<div class="container">
            @if($shop->count())
            <div class="shop-panel">
              @include('shop.partials._header',[
                  'shop' => $shop
              ])

                    <div class="shop-nav-bar">
                        <ul class="shop-nav-ul">
                            <button type="submit" class="product-nav-btn" onclick='document.location.href="/{{$shop->slug}}"'>{{__('message.home')}}</button>
                            <button type="submit" class="product-nav-btn-active">{{__('message.product')}}</button>
                            <button type="submit" class="product-nav-btn" onclick='document.location.href="/{{$shop->slug}}/collection"'>{{__('message.collection')}}</button>
                            <button type="submit" class="product-nav-btn" onclick='document.location.href="/{{$shop->slug}}/about"'>{{__('message.about')}}</button>
                        </ul>
                    </div>
        <div style="padding: 15px 45px;"><h3 class="no-margin">{{__('message.products')}}&nbsp;({{$products->count()}})</h3></div>
            <div class="panel-body flex">
                    @if ($products->count())
                        @foreach ($products as $product)

                        <div class="products-wrap s-products-margin">
                          <div class="products-img">
                                  <a href="/product/{{ $product->uid}}">
                                  <img class="products-img-thumb" src="{{$product->getImage()}}">
                                  </a>
                          </div>
                                    <h3 class="product-name"><a class="link-text" href="/product/{{ $product->uid}}">{{ $product->name }}</a></h3>
                                    <div class="product-detail-wrap">
                                    <p class="product-p">{{__('message.price')}} : {{ $product->price }}</p>
                                    @if($product->type->id !== 1)
                                    <p class="product-p">{{__('message.category')}} : {{ $product->type->showTranslate(App::getLocale())->name}}</p>
                                    @else
                                    <p class="product-p">{{__('message.category')}} : {{$product->subcategory->showTranslate(App::getLocale())->name}}</p>
                                    @endif
                                    </div>
                        </div>

                        @endforeach
                    @else
                    <h3 style="text-align: center; margin:50px auto;">{{__('message.no_shop_product')}}</h3>
                    @endif
                    </div>
                </div>

            </div>
@endif

</div>
<script>
    window.addEventListener('load', function () {
        var follow = new Vue({
          el: '.shop-header'
        });
        var vote = new Vue({
          el: '.shop-vote',
          data: {
            url: '{{config('app.url')}}'
          }
        });
    });
</script>
@endsection
