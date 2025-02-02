@extends('admin.admin-dashboard')
@section('main')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All {{$type}}</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All  {{$type}}</li>
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
                        <th>Sl</th>
                        <th>Image </th>
                        <th>Name </th>
                        <th>Email </th>
                        <th>Phone </th>
                        <th>Status </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $item)
                    <tr>
                        <td> {{ $key+1 }} </td>
                        <td> <img src="{{!(empty($item->photo))?url('upload/user_images'.$item->photo):url('upload/no_image.jpg') }}" style="width: 70px; height:40px;" >  </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td> @if($item->userOnline())

                            <span class="badge rounded-pill bg-success">Active Now</span>
                            @else

                            <span class="badge rounded-pill bg-danger">{{\Carbon\Carbon::parse($item->last_seen)->diffForHumans()}}</span>
                            @endif
                        </td>


                    </tr>
                    @endforeach


                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Sl</th>
                        <th>Image </th>
                        <th>Name </th>
                        <th>Email </th>
                        <th>Phone </th>
                        <th>Status </th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>



</div>




@endsection
