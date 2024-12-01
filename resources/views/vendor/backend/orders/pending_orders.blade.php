@extends('vendor.vendor-dashboard')
@section('main')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Pending Orders</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Pending Orders</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>SI</th>
                            <th>Product</th>
                            <th>Date</th>
                            <th>Invoice</th>
                            <th>Amount</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $key => $item)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td> <div class="d-flex align-items-center">
                                        <div class="recent-product-img">
                                            <img src="{{url($item->product->product_thambnail)}}" alt="">
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="mb-1 font-14">{{$item->product->product_name}}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$item->order->order_date}}</td>
                                <td>{{$item->order->invoice_no}}</td>
                                <td>${{$item->order->amount}}</td>
                                <td>{{$item->order->payment_method}}</td>
                                <td><span class="badge rounded-pill bg-success">{{$item->order->status}}</span></td>
                                <td><a href="" class="btn btn-info" title="Details"><i class="fa fa-eye"></i></a> </td>


                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection
