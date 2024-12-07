@extends('dashboard')
@section('user')
<!-- // Start Col md 9  -->

    <div class="row">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h4>Shipping Details</h4> </div>
                <hr>
                <div class="card-body">
                    <table class="table" style="background:#F4F6FA;font-weight: 600;">
                        <tr>
                            <th>Shipping Name:</th>
                            <th>{{ $order->name }}</th>
                        </tr>

                        <tr>
                            <th>Shipping Phone:</th>
                            <th>{{ $order->phone }}</th>
                        </tr>

                        <tr>
                            <th>Shipping Email:</th>
                            <th>{{ $order->email }}</th>
                        </tr>

                        <tr>
                            <th>Shipping Address:</th>
                            <th>{{ $order->adress }}</th>
                        </tr>


                        <tr>
                            <th>Country:</th>
                            <th>{{ $order->country->name }}</th>
                        </tr>

                        <tr>
                            <th>City:</th>
                            <th>{{ $order->city->name }}</th>
                        </tr>

                        <tr>
                            <th>Post Code  :</th>
                            <th>{{ $order->post_code }}</th>
                        </tr>

                        <tr>
                            <th>Order Date   :</th>
                            <th>{{ $order->order_date }}</th>
                        </tr>

                    </table>

                </div>

            </div>
        </div>
        <!-- // End col-md-6  -->


        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h4>Order Details
                        <span class="text-danger">Invoice : {{ $order->invoice_no }} </span></h4>
                </div>
                <hr>
                <div class="card-body">
                    <table class="table" style="background:#F4F6FA;font-weight: 600;">
                        <tr>
                            <th> Name :</th>
                            <th>{{ $order->customer->name }}</th>
                        </tr>

                        <tr>
                            <th>Phone :</th>
                            <th>{{ $order->customer->phone }}</th>
                        </tr>

                        <tr>
                            <th>Payment Type:</th>
                            <th>{{ $order->payment_method }}</th>
                        </tr>

                        @if($order->payment_method != 'Cash On Delivery')
                        <tr>
                            <th>Transx ID:</th>
                            <th>{{ $order->transaction_id }}</th>
                        </tr>
                        @endif
                        <tr>
                            <th>Invoice:</th>
                            <th class="text-danger">{{ $order->invoice_no }}</th>
                        </tr>

                        <tr>
                            <th>Order Amonut:</th>
                            <th>${{ $order->amount }}</th>
                        </tr>

                        <tr>
                            <th>Order Status:</th>
                            <th><span class="badge rounded-pill bg-warning">{{ $order->status }}</span></th>
                        </tr>

                    </table>

                </div>

            </div>
        </div>
        <!-- // End col-md-6  -->

    </div><!-- // End Row  -->


        <div class ="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4>Order Items</h4> </div>

                    <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                        <thead>
                        <tr>



                            <td class="col-md-1">
                                <label>
                                    Image
                                </label>
                            </td>
                            <td class="col-md-1">
                                <label>
                                    Product Name
                                </label>
                            </td>
                            <td class="col-md-1">
                                <label>
                                    Vendor Name
                                </label>
                            </td>
                            <td class="col-md-1">
                                <label>
                                    Product Code
                                </label>
                            </td>
                            <td class="col-md-1">
                                <label>
                                    Color
                                </label>
                            </td>
                            <td class="col-md-1">
                                <label>
                                    Size
                                </label>
                            </td>
                            <td class="col-md-1">
                                <label>
                                    Quantity
                                </label>
                            </td>
                            <td class="col-md-1">
                                <label>
                                    Price
                                </label>
                            </td>
                            <td class="col-md-1">
                                <label>
                                    Total
                                </label>
                            </td>
                        </tr>
                        </thead>
                        @foreach($order_items as $order_item)
                            <tr>
                                <td class="col-md-1">
                                    <label>
                                        <img src="{{asset($order_item->product->product_thambnail)}}">
                                    </label>
                                </td>
                                <td class="col-md-1">
                                    <label>
                                        {{$order_item->product->product_name}}
                                    </label>
                                </td>
                                @if($order_item->product->vendor_id == null)
                                    <td class="col-md-1">
                                        <label>
                                            Owner
                                        </label>
                                        </label>
                                    </td>
                                @else
                                    <td class="col-md-1">
                                        <label>
                                            {{$order_item->product->vendor->name}}
                                        </label>
                                    </td>
                                @endif

                                <td class="col-md-1">
                                    <label>
                                        {{$order_item->product->product_code}}
                                    </label>
                                </td>
                                @if($order_item->color == null)
                                    <td class="col-md-1">
                                        <label>
                                            ...
                                        </label>

                                    </td>
                                @else
                                    <td class="col-md-1">
                                        <label>
                                            {{$order_item->color}}
                                        </label>
                                    </td>
                                @endif
                                @if($order_item->size == null)
                                    <td class="col-md-1">
                                        <label>
                                            ...
                                        </label>

                                    </td>
                                @else
                                    <td class="col-md-1">
                                        <label>
                                            {{$order_item->size}}
                                        </label>
                                    </td>
                                @endif
                                <td class="col-md-1">
                                    <label>
                                        {{$order_item->qty}}
                                    </label>
                                </td>
                                <td class="col-md-1">
                                    <label>
                                        ${{$order_item->price}}
                                    </label>
                                </td>
                                <td class="col-md-1">
                                    <label>
                                       ${{$order_item->price * $order_item->qty }}
                                    </label>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                    </div>

                </div>

            </div>
        </div>




@endsection
