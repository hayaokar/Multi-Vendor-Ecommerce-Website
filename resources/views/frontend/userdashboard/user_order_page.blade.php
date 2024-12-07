@extends('dashboard')
@section('user')
    @php
    $alert = [
        'pending' => 'bg-warning',
        'confirm'=> 'bg-info',
        'processing'=>'bg-danger',
        'delivered'=>'bg-success'
]
    @endphp

        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Your Orders</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>SI</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Invoice</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $key=>$order)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$order->order_date}}</td>
                            <td><span class="badge rounded-pill {{$alert[$order->status]}}">{{$order->status}}</span></td>
                            <td>${{$order->amount}}</td>
                            <td>${{$order->invoice_no}}</td>
                            <td><a href="{{route('view.order',$order)}}" class="btn-sm btn-success"><i class="fa fa-eye"></i> View</a>
                                <a href="{{route('invoice.order',$order)}}" class="btn-sm btn-info"><i class="fa fa-download"></i> Invoice</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

@endsection
