<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{__('message.transaction').' - Closet' }}</title>
    <!-- Styles -->
    <link href="https://s3-ap-southeast-1.amazonaws.com/files.closet/css/main.css" rel="stylesheet">
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.3.7/cleave.min.js"></script>
    <script>
window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};

window.Closet = {
    url:'{{ config('app.url') }}',
    locale:'{{ App::getLocale() }}',
        user:{
            user: {{ Auth::check() ? Auth::user()->id : 'null' }},
            authenticated: {{ Auth::check() ? 'true':'false'}},
        }
    };
    </script>
</head>
<body>
        <div class="padding-30-vertical">
          @if(!$order->trans)
          <div class="small-panel">
            <div class="panel-heading">
              <label class="heading">{{__('message.transaction')}}</label>
            </div>
            <div class="inbox-wrap panel-body">
              <h4>{{__('message.from')}}&nbsp;:&nbsp;{{$order->reciever}}</h4>
              {{__('message.ordering_body')}}
              <div class="overflow-x-auto">
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
                  <tr>
                    <td colspan="4" class="no-border">{{__('message.total')}}&nbsp;:&nbsp;<span>{{ number_format($order->total).' '.'฿' }}</span></td>
                  </tr>
                  <tr>
                    <td colspan="4" class="no-border">{{__('message.shipping_fee')}}&nbsp;:&nbsp;
                      @foreach (json_decode($order->shipping) as $shipping)
                        @if($shipping->free)
                        <span class="font-bold font-green">{{__('message.free_shipping')}}</span>
                        @else
                        <span class="font-bold">{{ number_format($order->shipping_fee).' '.'฿' }}</span>
                        @endif
                      @endforeach
                    </td>
                  </tr>
                  <tr>
                    <td colspan="4">
                      <h4 class="no-margin">
                        {{__('message.total_price')}}&nbsp;:&nbsp;<span class="font-green">{{number_format($order->total + $order->shipping_fee)}}</span>&nbsp;฿
                      </h4>
                    </td>
                  </tr>
                </table>
              </div>
              <h4 class="font-red">*{{__('message.transaction_notice')}}</h4>
              <form method="post" action="/order/{{$order->uid}}/transaction_email">
                <div class="form-group">
                  <label class="full-width margin-20-bottom">{{__('message.transaction_time')}}</label>
                  <input class="width-120 form-input date" required pattern=".{10,}" name="date" placeholder="{{__('message.date_format')}}">
                  <input class="width-120 form-input time" required  name="time" placeholder="{{__('message.time_format')}}">
                </div>
                <div class="form-group">
                  <label class="full-width margin-20-bottom">{{__('message.transaction_bank')}}</label>
                  <select required class="select-input" name="provider">
                    <option value="" selected disabled>--- Select ---</option>
                    @foreach ($accounts as $account)
                      <option value="{{$account->provider_name}}">{{$account->provider_name}}</option>
                    @endforeach
                  </select>
                </div>
              <div class="align-center padding-30-top">
                <button class="half-width-res padding-10 orange-btn" type="submit">{{__('message.confirm')}}</button>
              </div>
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              </form>
            </div>
          </div>
          @else
          <div style="margin-top:50px;">
            <div class="medium-panel">
              <div class="panel-body">
                <h3 class="font-green">{{__('message.already_transacted')}}</h3>
              </div>
            </div>
          </div>
          @endif
        </div>
        <script>
        var date = new Cleave('.date', {
          date: true,
          datePattern: ['d', 'm', 'Y']
        });
        var time = new Cleave('.time', {
          delimiter: ' : ',
          blocks: [2, 2, 2],
        });
        </script>
</body>
</html>
