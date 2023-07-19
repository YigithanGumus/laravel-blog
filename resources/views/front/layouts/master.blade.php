<!DOCTYPE html>
<html lang="tr">

    @include('front.layouts.header')

<body>

   @include('front.layouts.menu-header')

    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            @yield('content')
        </div>
    </div>

    @include('front.layouts.footer')

</body>
</html>
