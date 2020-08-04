<footer class="sticky-footer">
    <div class="container">
        <div class="text-center">
            <small>Copyright © FinDoctor 2020</small>
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
                <h5 class="modal-title" id="exampleModalLabel">{{trans('menu.leave')}}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">{{trans('menu.leave_title')}}</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">{{trans('menu.cancel')}}</button>

                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-primary">
                    {{trans('menu.logout')}}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript-->
{{-- <script src="{{asset('js/jquery-2.2.4.min.js') }}"></script> --}}
{{-- <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/jquery.easing.min.js')}}"></script>
<script src="{{asset('js/Chart.min.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('js/jquery.selectbox-0.2.js')}}"></script>
<script src="{{asset('js/retina-replace.min.js')}}"></script>
<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script> --}}
<!-- Custom scripts for all pages-->
{{-- <script src="{{asset('js/admin.js') }}"></script> --}}
<!-- Custom scripts for this page-->
{{-- <script src="{{asset('js/dropzone.js') }}"></script> --}}
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>


<script src="{{asset('vendor/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<script src="{{asset('vendor/moment/moment.min.js')}}"></script>
<script src="{{asset('vendor/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{asset('vendor/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script src="{{asset('vendor/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

<script src="{{asset('vendor/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>


 
<script src="{{asset('vendor/daterangepicker/daterangepicker.js')}}"></script>


<script src="{{asset('vendor/bootstrap-fileinput/js/plugins/piexif.js')}}"></script>
<script src="{{asset('vendor/bootstrap-fileinput/js/plugins/sortable.js')}}"></script>
<script src="{{asset('vendor/bootstrap-fileinput/js/plugins/purify.js')}}"></script>
<script src="{{asset('vendor/bootstrap-fileinput/js/fileinput.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap-fileinput/js/locales/ru.js')}}"></script>
<script src="{{asset('vendor/bootstrap-fileinput/themes/fas/theme.js')}}"></script>
<script src="{{asset('vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('js/common_scripts.min.js')}}"></script>
<script src="{{asset('js/functions.js')}}"></script>

{{-- <script src="{{asset('vendor/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script> --}}

{{-- <script src="{{asset('vendor/adminlte/dist/js/adminlte.min.js')}}"></script> --}}

<script src="{{asset('js/doctor-spes.js')}}"></script>
{{-- <script src="{{asset('js/bootstrap-datepicker.js')}}"></script> --}}

