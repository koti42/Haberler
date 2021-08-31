<!DOCTYPE html>
<html lang="zxx">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>CNC HABER</title>
    <!-- plugin css for this page -->
    <link rel="stylesheet"href="{{asset('front/assets/vendors/mdi/css/materialdesignicons.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('front/assets/vendors/aos/dist/aos.css/aos.css')}}" />
    <!-- End plugin css for this page -->
    <link rel="shortcut icon" href="{{asset('front/assets/images/favicon.png')}}" />
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('front/assets/css/style.css')}}">
    <!-- endinject -->
  </head>
  <body>
    <div class="container-scroller">
      <div class="main-panel">
        <!-- partial:partials/_navbar.html -->
       @include('front.component.header')

        <!-- partial -->
      @component('front.component.banner')

      @endcomponent

        <div class="content-wrapper">
          <div class="container">
           @component('front.component.flash-news')

           @endcomponent
            <div class="row" data-aos="fade-up">
                @component('front.component.category')

                @endcomponent
               @component('front.component.featured-news')

               @endcomponent
            </div>
          @component('front.component.video')

          @endcomponent
          @component('front.component.selected-news')

          @endcomponent
          </div>
        </div>
        <!-- main-panel ends -->
        <!-- container-scroller ends -->

        <!-- partial:partials/_footer.html -->
         @include('front.layouts.footer')

      <!-- partial -->
      </div>
    </div>
    <!-- inject:js -->
    <script src="{{asset('front/assets/vendors/js/vendor.bundle.base.js')}}"></script>

    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="{{asset('front/assets/vendors/aos/dist/aos.js/aos.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="{{asset('front/assets/js/demo.js')}}"></script>
    <script src="{{asset('front/assets/js/jquery.easeScroll.js')}}"></script>
    <!-- End custom js for this page-->
  </body>
</html>
