<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}"/>
    <!--favicon-->
    <link rel="icon" href="{{asset('adminbackend/assets/images/favicon-32x32.png')}}" type="image/png" />
    <!--plugins-->
    <link href="{{asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
    <link href="{{asset('adminbackend/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <link href="{{asset('adminbackend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    <link href="{{asset('adminbackend/assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{asset('adminbackend/assets/css/pace.min.css')}}" rel="stylesheet" />
    <script src="{{asset('adminbackend/assets/js/pace.min.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{asset('adminbackend/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('adminbackend/assets/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('adminbackend/assets/css/icons.css')}}" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{asset('adminbackend/assets/css/dark-theme.css')}}" />
    <link rel="stylesheet" href="{{asset('adminbackend/assets/css/semi-dark.css')}}" />
    <link rel="stylesheet" href="{{asset('adminbackend/assets/css/header-colors.css')}}" />
    <link href="{{ asset('adminbackend/assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" >
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

    <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Rukada - Responsive Bootstrap 5 Admin Template</title>
</head>

<body>
<!--wrapper-->
<div class="wrapper">
    <!--sidebar wrapper -->
    @include('admin.body.sidebar')
    <!--end sidebar wrapper -->
    <!--start header -->
    @include('admin.body.header')
    <!--end header -->
    <!--start page wrapper -->
    <div class="page-wrapper">
        @yield('main')
    </div>
    <!--end page wrapper -->
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
    @include('admin.body.footer')
</div>
<!--end wrapper-->

<!-- Bootstrap JS -->
<script src="{{asset('adminbackend/assets/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->
<script src="{{asset('adminbackend/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('adminbackend/assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{asset('adminbackend/assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{asset('adminbackend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
<script src="{{asset('adminbackend/assets/plugins/chartjs/js/Chart.min.js')}}"></script>
<script src="{{asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{asset('adminbackend/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
<script src="{{asset('adminbackend/assets/plugins/sparkline-charts/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('adminbackend/assets/plugins/jquery-knob/excanvas.js')}}"></script>
<script src="{{asset('adminbackend/assets/plugins/jquery-knob/jquery.knob.js')}}"></script>
<script>
    $(function() {
        $(".knob").knob();
    });
</script>
<script src="{{asset('adminbackend/assets/js/index.js')}}"></script>
<!--app JS-->
<script src="{{asset('adminbackend/assets/js/app.js')}}"></script>
<script src="{{asset('adminbackend/assets/js/validate.min.js')}}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{asset('adminbackend/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminbackend/assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>


    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch(type){
        case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

        case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

        case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

        case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
    }
    @endif

    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>

<script src="{{ asset('adminbackend/assets/plugins/input-tags/js/tagsinput.js') }}"></script>

<script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js' referrerpolicy="origin">
</script>

<script>
    tinymce.init({
        selector: '#mytextarea'
    });
</script>
<script type="text/javascript">
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    })
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                division_name: {
                    required : true,
                },
            },
            messages :{
                division_name: {
                    required : 'Please Enter Division Name',
                },
            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    function allDivisions(){
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/ajax/all/divisions",
            success: function (data){
                var rows = "";
                var count = 1;
                $.each(data.divisions,function (key,value){
                    rows += `<tr>
                                <td> ${count} </td>
                                <td>${value.division_name}</td>
                                <td>
                                    <a id="${value.id}" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#updateDivisionsModal" class="btn btn-info" onclick="viewDivision(this.id)">Edit</a>
                                    <a href="/delete/division/${value.id}" class="btn btn-danger" id="delete" >Delete</a>

                                </td>
                            </tr>`
                    count +=1;
                })
                $('#divisions').html(rows);
            }

        })
    }
    function allDistricts(){
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/ajax/all/districts",
            success: function (data){
                var rows = "";
                var count = 1;
                $.each(data.districts,function (key,value){
                    rows += `<tr>
                                <td> ${count} </td>
                                <td>${value.district_name}</td>
                                <td>${value.division.division_name}</td>
                                <td>
                                    <a id="${value.id}" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#updateDistrictModal" class="btn btn-info" onclick="viewDistrict(this.id)">Edit</a>
                                    <a href="/delete/district/${value.id}" class="btn btn-danger" id="delete" >Delete</a>

                                </td>
                            </tr>`
                    count +=1;
                })
                $('#districts').html(rows);
            }

        })
    }
    function addDivision(){
        var product_name = $('#division_name').val();
        $.ajax({
            type: "POST",
            dataType: "json",
            data:{
                division_name:product_name
            },
            url:'/add/divisions',
            success:function (data){
                $('#closeModal').click();
                allDivisions()
                //console.log(data)
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000,
                    showCloseButton: true,
                })
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        type: 'success',
                        title: data.success,
                    })
                }else{
                    Toast.fire({
                        type: 'success',
                        title: data.error,
                    })
                }
            }
        })
    }
    function addDistrict(){
        var division_id = $('#division_id option:selected').val();
        var district_name = $('#district_name').val();
        $.ajax({
            type: "POST",
            dataType: "json",
            data:{
                division_id:division_id,
                district_name:district_name
            },
            url:'/add/district',
            success:function (data){
                $('#closeModal').click();
                allDistricts()
                //console.log(data)
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000,
                    showCloseButton: true,
                })
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        type: 'success',
                        title: data.success,
                    })
                }else{
                    Toast.fire({
                        type: 'success',
                        title: data.error,
                    })
                }
            }
        })
    }
    function viewDivision(id){
        $.ajax({
            type: "GET",
            url: "/view/division/"+id,
            dataType: "json",
            success: function (data){
                $('#u_division_name').val(data.division.division_name)
                $('#id_division').val(data.division.id)
            }
        })
    }
    function viewDistrict(id){
        $.ajax({
            type: "GET",
            url: "/view/district/"+id,
            dataType: "json",
            success: function (data){
                $('#u_district_name').val(data.district.district_name)
                $('#id_district').val(data.district.id)
                $('#u_division_id').val(data.district.division.id).trigger('change');
            }
        })
    }
    function updateDivision(){
        var id = $('#id_division').val();
        var product_name = $('#u_division_name').val();
        $.ajax({
            type: "POST",
            dataType: "json",
            data:{
                division_name:product_name
            },
            url:'/update/divisions/'+id,
            success:function (data){
                $('#ucloseModal').click();
                allDivisions()
                //console.log(data)
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000,
                    showCloseButton: true,
                })
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        type: 'success',
                        title: data.success,
                    })
                }else{
                    Toast.fire({
                        type: 'success',
                        title: data.error,
                    })
                }
            }
        })
    }
    function updateDistrict(){
        var id = $('#id_district').val();
        var district_name = $('#u_district_name').val();
        var division_id = $('#u_division_id').val();
        $.ajax({
            type: "POST",
            dataType: "json",
            data:{
                district_name:district_name,
                division_id: division_id
            },
            url:'/update/district/'+id,
            success:function (data){
                $('#ucloseModal').click();
                allDistricts()
                //console.log(data)
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000,
                    showCloseButton: true,
                })
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        type: 'success',
                        title: data.success,
                    })
                }else{
                    Toast.fire({
                        type: 'success',
                        title: data.error,
                    })
                }
            }
        })
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="{{ asset('adminbackend/assets/js/code.js') }}"></script>

</body>

</html>
