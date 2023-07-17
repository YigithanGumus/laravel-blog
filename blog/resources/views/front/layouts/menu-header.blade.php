 <!-- Navigation-->
 <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
     <div class="container px-4 px-lg-5">
         <a class="navbar-brand" href="{{ route('homepage') }}">Blog Sitesi v1</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
             aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
             Menu
             <i class="fas fa-bars"></i>
         </button>
         <div class="collapse navbar-collapse" id="navbarResponsive">
             <ul class="navbar-nav ms-auto py-4 py-lg-0">
                 <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('homepage') }}">Home</a>
                 </li>
                 @foreach ($pages as $page)
                     <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4"
                             href="{{ route('page', $page->slug) }}">{{ $page->title }}</a></li>
                 @endforeach
                 <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('contact') }}">İletişim</a></li>
             </ul>
         </div>
     </div>
 </nav>
 <!-- Page Header-->
 <header class="masthead" style="background-image: url('@yield('bg', asset('front/assets/img/home-bg.jpg'))')">
     <div class="container position-relative px-4 px-lg-5">
         <div class="row gx-4 gx-lg-5 justify-content-center">
             <div class="col-md-10 col-lg-8 col-xl-7">
                 <div class="site-heading">
                     <h2>@yield('title')</h2>
                 </div>
             </div>
         </div>
     </div>
 </header>
