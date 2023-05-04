

 <!DOCTYPE html>
 <html lang="en-us">
          <!-------------MAIN HEDAR LINK------------------->
                  @include('layouts.frontend.hedar')
          <!----------------MAIN HEDAR LINK---------------->

 <body>
     <!---------- navigation ------------->
       @include('layouts.frontend.navbar')
     <!---------- /navigation ------------->
    
     <!--------- BANNER LINK ----------->
     {{-- @include('layouts.frontend.banner') --}}
     <!---------- BANNER LINK ------------>
     
     <!---------- tranding Link ----------->
     

     @yield('mainsection')

      <!---------- RIGHTBAR ------------->
      {{-- @include('layouts.frontend.rightbar') --}}
       <!--------- RIGHTBAR ------------->

     

     <!----------MAIN FOOTER LING--------->
     @include('layouts.frontend.footer')
    <!----------MAIN FOOTER LING--------->

     <!----------MAIN SCRIPT  LING--------->
     @include('layouts.frontend.script')
     <!----------MAIN SCRIPT  LING--------->

  </html>
