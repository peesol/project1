
    <nav class="navbar fixed-nav-bar">
        <div class="nav-container">
                <div class="side-menu-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="main-logo"><a href="/"></a></div>
                <div class="search-form">
                <form action="/search/result">
                    <input type="text" name="p" class="autocomplete search-input" placeholder="{{__('message.search')}}" autocomplete="off">
                    <button type="submit" class="search-btn"><span class="icon-search"></span></button>
                </form>
                </div>

            <div class="login-box">
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">{{__('message.login')}}</a></li>
                    <li><a href="{{ route('register') }}">{{__('message.register')}}</a></li>
                @else
                <div class="cart">
                  <cart-icon></cart-icon>
                </div>
                        <button class="dropdown-btn icon-login-dropdown"></button>
                        <div id="dropdown" class="dropdown-content">
                            <div class="dropdown-name">{{ Auth::user()->name }}</div>
                            <a href="{{ url('/' .  Auth::user()->shop->slug) }}">{{__('message.my_closet')}}</a>
                            <a href="{{ url('/profile/myproduct/new') }}">{{__('message.my_product')}}</a>
                            <a href="{{ url('/' . Auth::user()->shop->slug . '/edit' ) }}">{{__('message.closet_edit')}}</a>
                            <a href="{{ url('sell/product') }}">{{__('message.sell')}}</a>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">{{__('message.logout')}}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                        </div>
                @endif
            </div> <!-- div login box -->
        </div> <!-- div container -->
    </nav> <!--close nav -->
    <div class="second-nav">
        <div class="second-nav-cont">
            <div id="second-nav-link"><a href="{{ route('home') }}">{{__('message.home')}}</a></div>
            <div id="second-nav-link"><a href="{{ route('categoryMain') }}">{{__('message.category')}}</a></div>
            <div id="second-nav-link"><a href="{{ route('trending') }}">{{__('message.trending')}}</a></div>
            <div id="second-nav-link"><a href="{{ route('shops') }}">{{__('message.shops')}}</a></div>
        </div>
    </div>

    <div class="left-side-menu">
        <div class="sub-left-menu">
        <div class="sub-menu-search-bar flex">
                <form action="/search" autocomplete="off">
                    <input type="text" name="p" class="sub-search-input" placeholder="{{__('message.search')}}" autocomplete="off">
                    <button type="submit" class="sub-search-btn"><span class="icon-search"></span></button>
                </form>
        </div>
        @if (Auth::guest())
                <a href="{{ route('home')}} "><i class="icon-home"></i>&nbsp;{{__('message.home')}}</a>
                <a href="{{ route('trending') }}"><span class="icon-fire"></span>&nbsp;{{__('message.trending')}}</a>
                <a href="{{ route('shops') }}"><span class="icon-shop"></span>&nbsp;{{__('message.shops')}}</a>
                <p id="alt-cat">{{__('message.account')}}</p>
                <a href="{{ route('login') }}">{{__('message.login')}}</a>
                <a href="{{ route('register') }}">{{__('message.register')}}</a>
                <a id="cat" href="{{route('categoryMain')}}" >{{__('message.categories')}}</a>
                        @foreach($categories as $category)
                          <a href="{{ url('/category/'.$category->slug) }}">{{$category->showTranslate(App::getLocale())->name}}</a>
                        @endforeach
                <p id="alt-cat">{{__('message.language')}}</p>
                <language-select language="{{ App::getLocale() }}"></language-select>

        @else
                <a href="{{ route('home') }}"><i class="icon-home"></i>&nbsp;{{__('message.home')}}</a>
                <a href="{{ route('trending') }}"><span class="icon-fire"></span>&nbsp;{{__('message.trending')}}</a>
                <a href="{{ route('shops') }}"><span class="icon-shop"></span>&nbsp;{{__('message.shops')}}</a>
                <p id="alt-cat">{{__('message.account')}}</p>
                <a href="{{ url('/' .  Auth::user()->shop->slug) }}"><span class="icon-user"></span>&nbsp;{{__('message.my_closet')}}</a>
                <a href="{{ route('myCollection') }}"><span class="icon-bookmarks"></span>&nbsp;{{__('message.collections')}}</a>
                <a href="{{ route('promotionEdit') }}"><span class="icon-price-tag"></span>&nbsp;{{__('message.promotions')}}</a>
                <a href="{{ route('following') }}"><span class="icon-star-full"></span>&nbsp;{{__('message.following')}}</a>
                <a href="{{ route('sellingOrder') }}"><span class="icon-order"></span>&nbsp;{{__('message.orders')}}</a>

                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="icon-exit"></span>&nbsp;{{__('message.logout')}}</a>
                        <a id="cat" href="{{route('categoryMain')}}" >{{__('message.categories')}}</a>
                        @foreach($categories as $category)
                          <a href="{{ url('/category/'.$category->slug) }}">{{$category->showTranslate(App::getLocale())->name}}</a>
                        @endforeach
                <p id="alt-cat">{{__('message.language')}}</p>
                <language-select language="{{ App::getLocale() }}"></language-select>

        @endif
        </div>
    </div>
    <script>

    </script>
