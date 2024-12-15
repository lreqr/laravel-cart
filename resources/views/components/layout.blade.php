<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('app_name') }}</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>
<body>
<nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('cart.index', ) }}">
            <img src="https://via.placeholder.com/360x360.png/00ee11?text=logo" alt="Logo" width="30" height="24"
                 class="d-inline-block align-text-top">
            {{ env('app_name') }}
        </a>
        <div class="d-flex align-items-center" id="user-cart" >
            <ul class="nav">
                @foreach (config('locales.supported') as $locale => $language)
                    <li>
                        <a href="{{ route(Route::currentRouteName(), ['locale' => $locale]) }}">
                            {{ $language }}
                        </a>
                    </li>
                    @if (!$loop->last)
                        /
                    @endif
                @endforeach
            </ul>
            @auth
                <h2 class="mx-2">{{ __('messages.welcome') }} {{auth()->user()->name}}</h2>
                <button class="btn btn-danger mx-2 logout-user">{{ __('messages.logout') }}</button>
            @else
                @foreach($testUsers as $testUser)
                    <button class="btn btn-primary mx-2 login-as-user" data-user-id="{{ $testUser['id'] }}">{{__('messages.welcome')}} {{ $testUser['name'] }}</button>
                @endforeach
            @endauth
            <div class="dropdown">
                <button class="btn btn-outline-secondary" type="button" id="cart-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <!-- SVG иконка корзины -->
                    <i class="fas fa-shopping-cart"></i>


                    <span class="ms-1">{{ __('messages.cart') }}</span>
                </button>
                <div class="dropdown-menu dropdown-menu-end p-3" id="cart" style="width: 300px; left: auto; right: 0;">
                    <h6 class="dropdown-header">Товары в корзине</h6>
                    <!-- Тестовый продукт -->
                    <div class="d-flex align-items-center border-bottom pb-2 mb-2">
{{--                        <img src="https://via.placeholder.com/60x60.png" alt="Продукт" class="me-3" width="60"--}}
{{--                             height="60">--}}
{{--                        <div>--}}
{{--                            <p class="mb-1">Продукт 1</p>--}}
{{--                            <small class="text-muted">Цена: $25.00</small>--}}
{{--                        </div>--}}
                    </div>
                    <a href="{{ route('cart.index', ['locale' => app()->getLocale()]) }}" class="btn btn-primary w-100">Перейти в корзину</a>
                </div>
            </div>
        </div>

    </div>
</nav>
{{ $slot }}
<script src="{{ mix('js/login-logout.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
