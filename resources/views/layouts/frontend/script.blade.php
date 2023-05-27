  <!-- JS Plugins -->
  <script src="{{asset('frontend/plugins/jQuery/jquery.min.js')}}"></script>

  <script src="{{asset('frontend/plugins/bootstrap/bootstrap.min.js')}}"></script>

  <script src="{{asset('frontend/plugins/slick/slick.min.js')}}"></script>

  <script src="{{asset('frontend/plugins/instafeed/instafeed.min.js')}}"></script>


  <!-- Main Script -->
  <script src="{{asset('frontend/js/script.js')}}"></script></body>

  <!-- include summernote js -->
 <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

  <!---------TOSTER MIAN JS---------->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
     integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
     crossorigin="anonymous" referrerpolicy="no-referrer"></script>

 <!-- Toastr Script -->

 <script>
     @if (Session::has('message'))
         var type = "{{ Session::get('alert-type', 'info') }}"
         switch (type) {
             case 'info':
                 toastr.info("{{ Session::get('message') }}");
                 break;
             case 'success':
                 toastr.success("{{ Session::get('message') }}");
                 break;
             case 'warning':
                 toastr.warning("{{ Session::get('message') }}");
                 break;
             case 'error':
                 toastr.error("{{ Session::get('message') }}");
                 break;
         }
     @endif
 </script>

  <!----------SWEET ALLERT------------>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <!-- Sweetalert Script -->
 <script>
     $('.delete').click(function(event) {
         var form = $(this).closest("form");
         event.preventDefault();
         Swal.fire({
             title: 'Do you want to delete this row?',
             text: "Once deleted, you will not be able to recover this!",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes, delete it',
             reverseButtons: true
         }).then((result) => {
             if (result.isConfirmed) {
                 form.submit()
             }
         })
     });
 </script>

 <!---------LOGOUT SCRIPT------------->
 <script>
     $('.logout').click(function(event) {
         var form = $(this).closest("form");
         event.preventDefault();
         Swal.fire({
             title: 'Do you want to log out now?',
             text: "",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes',
             cancelButtonText: 'No',
             reverseButtons: true
         }).then((result) => {
             if (result.isConfirmed) {
                 form.submit()
             }
         })
     });
 </script>

 <script>
     $(document).ready(function() {
         $('.summernote').summernote();
     });
 </script>