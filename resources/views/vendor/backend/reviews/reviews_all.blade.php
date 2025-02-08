@extends('vendor.vendor-dashboard')
@section('main')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Accepted Reviews</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Accepted Reviews</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Product </th>
                            <th>Image </th>
                            <th>User </th>
                            <th>Comment </th>
                            <th>Rating </th>
                            <th>Created At </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reviews as $key => $item)
                            <tr>
                                <td> {{ $key+1 }} </td>
                                <td>{{ $item->product->product_name }}</td>
                                <td> <img src="{{url($item->product->product_thambnail)}}" width="40px" height="40px" ></td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->comment }}</td>
                                <td>
                                    @for($i=1; $i<=$item->rating;$i++)
                                        <span style="color: gold">★</span>
                                    @endfor
                                    @for($i=1; $i<=(5-$item->rating);$i++)
                                        <span >★</span>
                                    @endfor
                                </td>
                                <td>{{ $item->created_at }}


                            </tr>
                        @endforeach


                        </tbody>

                    </table>
                </div>
            </div>
        </div>



    </div>




@endsection
