<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('message.cancle_order') . ' - ' . config('app.name') }}</title>
    <!-- Styles -->
    <link href="https://s3-ap-southeast-1.amazonaws.com/files.closet/css/main.css" rel="stylesheet">
    <script>
    window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div class="container margin-30-top">
  @if(!$order->deleted_at)
  <div class="small-panel">
    <div class="panel-heading">
      <label class="heading">{{__('message.cancle_order')}}</label>
    </div>
    <div class="inbox-wrap panel-body">
      <h4>{{__('message.from')}}&nbsp;:&nbsp;{{$order->sender}}</h4>
      {{__('message.ordering_body')}}
      <table class="c-table margin-10-top">
        <tr>
          <th class="overflow-hidden">{{__('message.product_name')}}</th>
          <th>{{__('message.choice')}}</th>
          <th>{{__('message.price')}}</th>
          <th>{{__('message.qty')}}</th>
        </tr>
        @foreach(json_decode($order->body) as $item)
        <tr>
          <td class="overflow-hidden m-cell">{{$item->name}}</td>
          <td class="m-cell">{{$item->options->choice ? $item->options->choice : '---'}}</td>
          <td class="s-cell">{{$item->price}}</td>
          <td class="s-cell">{{$item->qty}}</td>
        </tr>
        @endforeach
      </table>
    </div>
    <div class="panel-body">
      <form action="{{ config('app.url') . '/order/'. $order->uid . '/cancle_email' }}" method="POST">
        <div class="align-right full-width">
          <button class="orange-btn normal-sq" onclick="proceed()" type="submit" >{{ __('message.proceed') }}</button>
        </div>
        {{ csrf_field() }}
        {{ method_field('PUT') }}
      </form>
    </div>
  </div>
  @endif
</div>
<script type="text/javascript">
function proceed() {
  if (confirm("{{__('message.confirm_prompt')}}")) {
    return true;
  }
  return false;
}
</script>
</body>
</html>
