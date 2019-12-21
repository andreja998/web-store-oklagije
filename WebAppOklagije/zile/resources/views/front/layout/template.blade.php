<!doctype html>
<html lang="{{ app()->getLocale() }}">
@include('front.components.common.head')
<body>
	@include('front.components.common.info')
    @include('front.components.common.nav')
    @yield('content')
    @include('front.components.common.footer')
    @include('front.components.common.login')
    @include('front.components.common.scripts')
</body>
</html>