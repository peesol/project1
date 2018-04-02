<div class="panel-body">
    <p>
      <span class="font-bold font-grey">{{__('message.price')}}</span>&nbsp;:&nbsp;
      @if($product->discount_price)
      <strike>{{ number_format($product->price) }}</strike>
      <small class="icon-next-arrow font-grey"></small>
      <font class="font-bold font-large font-green">{{ number_format($product->discount_price) }}&nbsp;{{__('message.baht')}}</font>
      @else
      <font class="font-bold font-large">{{ number_format($product->price) }}</font>&nbsp;{{__('message.baht')}}
      @endif
    </p>
    <h3 class="{{ $product->stock ? 'font-green' : 'font-red'}} margin-10">{{ $product->stock ? __('message.instock') : __('message.outstock')}}</h3>
    <label class="full-label {{ $product->shipping_free ? 'font-green' : 'not-display'}}">
      <span class="icon-truck"></span>&nbsp;{{__('message.free_shipping')}}
    </label>
    <p class="no-margin"><span class="font-bold font-grey">{{__('message.shipping')}}</span> : {{ $product->shipping ? $product->shipping : __('message.undefined') }}</p>
    <p class="no-margin {{ $product->shipping_free ? 'not-display' : ''}}"><span class="font-bold font-grey">{{__('message.shipping_fee')}}</span> : {{ $product->shipping_fee ? $product->shipping_fee.' '.__('message.baht') : __('message.undefined') }}</p>
    <p class="no-margin"><span class="font-bold font-grey">{{__('message.shipping_time')}}</span> : {{ $product->shipping_time ? $product->shipping_time.'&nbsp;'.__('message.days') : __('message.undefined') }}</p>
</div>
