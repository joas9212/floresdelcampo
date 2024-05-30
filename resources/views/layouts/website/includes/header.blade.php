<header id="website_header" class="container-xl">

    <div id="website_header_menu" class="row pt-2 pb-2">
        
        <div class="col-3"></div>
        <div class="col-6"></div>
        <div class="col-3 text-end float-end">
            @if (Route::has('login'))
                <ul class="row m-0 p-0 text-end">
                    @auth
                        <li class="col-4"><a href="{{route('dashboard')}}">dashboard</a></li>
                    @else
                        <li class="col-4"><a href="{{route('login')}}">Login</a></li>

                        @if (Route::has('register'))
                        <li class="col-4"><a href="{{route('register')}}">Register</a></li>
                        @endif
                    @endauth
                </ul>
            @endif
        </div>
    </div>
 
    <div id="website_header_head" class="row mb-3">
        <div class="col-3"></div>

        <div id="logo" class="col-6 text-center">
            <a href="{{route('home')}}">
                <img class="w-25" src="{{ asset('img/logo original rediseñado.png') }}" alt="logo">
            </a>
        </div>

        <div id="website_header_cart" class="col-3">
            <div id="website_header_cart_contain" class="float-end position-sticky">
                <a href="{{route('cart')}}" class="d-flex">
                    <div id="website_header_cart_icon" class="d-inline-block border border-1 border-gray-500 d-flex">
                        <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M4 4a1 1 0 0 1 1-1h1.5a1 1 0 0 1 .979.796L7.939 6H19a1 1 0 0 1 .979 1.204l-1.25 6a1 1 0 0 1-.979.796H9.605l.208 1H17a3 3 0 1 1-2.83 2h-2.34a3 3 0 1 1-4.009-1.76L5.686 5H5a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div id="website_header_cart_status" class="d-inline-block  d-flex">
                        0  MY CART / $0.00
                    </div>
                </a>
            </div>
        </div>

    </div>
</header>

<div id="website_header_cart_sticky_contain" class="position-fixed mt-2">
    <a href="{{route('cart')}}" class="d-flex">
        <div id="website_header_cart_sticky_icon" class="d-inline-block border border-1 border-gray-500 d-flex">
            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M4 4a1 1 0 0 1 1-1h1.5a1 1 0 0 1 .979.796L7.939 6H19a1 1 0 0 1 .979 1.204l-1.25 6a1 1 0 0 1-.979.796H9.605l.208 1H17a3 3 0 1 1-2.83 2h-2.34a3 3 0 1 1-4.009-1.76L5.686 5H5a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div id="website_header_cart_sticky_status" class="d-inline-block  d-flex">
            0  MY CART / $0.00
        </div>
    </a>
</div>