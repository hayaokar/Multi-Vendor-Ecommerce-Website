@extends('admin.admin-dashboard')
@section('main')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Coupon</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Coupon</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">

                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">

                                <form method="POST"  id="myForm" action="{{route('store.coupon')}}" >
                                    @csrf

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"> Coupon Name</h6>
                                        </div>
                                        <div class="col-sm-9 form-group text-secondary">
                                            <input type="text" name="coupon_name" class="form-control "  value="" required />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"> Coupon Discount (%)</h6>
                                        </div>
                                        <div class="col-sm-9 form-group text-secondary">
                                            <input type="text" name="coupon_discount" class="form-control "  value="" required />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"> Coupon Validity Date</h6>
                                        </div>
                                        <div class="col-sm-9 form-group text-secondary">
                                            <input type="date" name="coupon_validity" class="form-control "  value="" min="{{Carbon\Carbon::now()->format('Y-m-d')}}" required />
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Add Coupon" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    coupon_name: {
                        required : true,
                    },
                    coupon_discount: {
                        required : true,
                    },
                },
                messages :{
                    coupon_name: {
                        required : 'Please Enter Coupon Name',
                    },
                    coupon_discount: {
                        required : 'Please Enter Coupon Discount',
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

    </script>
@endsection
