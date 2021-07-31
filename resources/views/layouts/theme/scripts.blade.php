 <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
 <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
 <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
 <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
 <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
 <script src="{{ asset('assets/js/app.js') }}"></script>
 
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 
 
 <script>
     $(document).ready(function() {
         App.init();
     });
 </script>
 <script src="{{ asset('assets/js/custom.js') }}"></script>
 <script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
 <script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }}"></script>
 <script src="{{ asset('plugins/nicescroll/nicescroll.js') }}"></script>
 <script src="{{ asset('plugins/currency/currency.js') }}"></script>
 <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

 <script>
     function noty(msg, option = 1) {
         Snackbar.show({
             text: msg.toUpperCase(),
             actionText: 'CERRAR',
             actionTextColor: '#FFF',
             backgroundColor: option == 1 ? '#3B3F5C' : '#E7515A',
             pos: 'top-right'
         });
     }
 </script>

 @livewireScripts