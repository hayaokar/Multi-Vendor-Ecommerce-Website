@extends('admin.admin-dashboard')
@section('main')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Active Vendors</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Active Vendors</li>
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
                            <th>Shop Name</th>
                            <th>Vendor Username</th>
                            <th>Join Date</th>
                            <th>Vendor Email</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($vendors as $key => $vendor)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$vendor->name}}</td>
                                <td>{{$vendor->username}}</td>
                                <td>{{$vendor->date}}</td>
                                <td>{{$vendor->email}}</td>
                                <td><span  class="btn btn-success">{{$vendor->status}}</span></td>
                                <td>
                                    <a href="{{route('deactivate.vendor',$vendor->id)}}" class="btn btn-danger">Deactivate Vendor </a>

                                </td>

                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection
