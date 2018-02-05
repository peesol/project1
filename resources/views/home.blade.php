@extends('layouts.app')

@section('content')

@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
@endsection

@section('css')
<link href="https://s3-ap-southeast-1.amazonaws.com/files.closet/css/extra/banner-slick-theme.css" rel="stylesheet">
<link href="https://s3-ap-southeast-1.amazonaws.com/files.closet/css/extra/slick.css" rel="stylesheet">
@endsection
<div class="container">
            <div class="large-panel">
                <div class="top-grid">
                  <div class="top-banner">
                    <img src="https://s3-ap-southeast-1.amazonaws.com/images.closet.com/banner/banner1.jpg" alt="banner">
                    <img src="https://s3-ap-southeast-1.amazonaws.com/images.closet.com/banner/banner2.jpg" alt="banner">
                  </div>
                  <div class="banner-side-nav">
                    <ul >
                      <li><h4 class="no-margin">{{__('message.category')}}</h4></li>
                      @foreach($categories as $category)
                      <li><a href="#" class="link-text">{{$category->showTranslate(App::getLocale())->name}}</a></li>
                      @endforeach
                    </ul>
                  </div>
                </div>
            </div>
            @if(Auth::guest())
            <div class="large-panel margin-top-10px">
              <div class="panel-body">
                <p class="no-margin">{{__('message.home_signup')}}&nbsp;<a href="route('register')" class="link-text">{{__('message.home_signup_link')}}</a></p>
              </div>
            </div>
            @endif

            <div class="large-panel margin-top-10px">

                <div class="panel-body">
                  <h4 class="no-margin">Flash sale</h4>
                </div>
                <div class="content-grid">

                </div>
            </div>



</div>
<script>
$('.top-banner').slick({
  dots: true,
  infinite: true,
  speed: 300,
  autoplay: true,
  autoplaySpeed: 4000,
  pauseOnFocus: false,
  responsive: [
    {
      breakpoint: 500,
      settings: {
        arrows: false,
        infinite: true,
        dots: true
      }
    },
  ]
});
$('.category-carousel').slick({
  infinite: false,
  speed: 300,
  slidesToShow: 6,
  slidesToScroll: 6,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 4,
        infinite: false,
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});
</script>
<style media="screen">
.side-grid {
  display: none;
}

.content-grid{
  display: grid;
  grid-template-columns: 50% 50%;
  grid-template-rows: 300px;
}
@media (min-width: 992px) {
  .content-grid{
    display: grid;
    grid-template-columns: 100%;
  }
}
</style>
@endsection
