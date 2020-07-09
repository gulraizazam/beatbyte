<!-- /.content-wrapper-->

    <footer class="sticky-footer">

      <div class="container">

        <div class="text-center">

          <small>Copyright © Beat Byte 2020</small>

        </div>

      </div>

    </footer>

    <!-- Scroll to Top Button-->

    <a class="scroll-to-top rounded" href="#page-top">

      <i class="fa fa-angle-up"></i>

    </a>

    <!-- Logout Modal-->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

      <div class="modal-dialog" role="document">

        <div class="modal-content">

          <div class="modal-header">

            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>

            <button class="close" type="button" data-dismiss="modal" aria-label="Close">

              <span aria-hidden="true">×</span>

            </button>

          </div>

          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>

          <div class="modal-footer">

            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

            <a class="btn btn-primary" href="{{route('getlogout')}}">Logout</a>

          </div>

        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript-->

    <script src="{{asset('js/jquery.min.js')}}"></script>

    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->

    <script src="{{asset('js/jquery.easing.min.js')}}"></script>

    <script src="{{asset('js/datatables/jquery.dataTables.js')}}"></script>
     <script src="{{asset('js/formsubmit.js')}}"></script>
    <script src="{{asset('js/datatables/dataTables.bootstrap4.js')}}"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

    <!-- Custom scripts for this page-->

    <script src="{{asset('js/sb-admin-datatables.min.js')}}"></script>

  

    <!-- Custom scripts for all pages-->

    <script src="{{asset('js/sb-admin.min.js')}}"></script>

    <script src="{{asset('js/dropzone.js')}}"></script>


    @yield('scripts')

   