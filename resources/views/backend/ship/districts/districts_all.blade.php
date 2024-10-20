@include('backend.ship.districts.add_district')

@extends('admin.admin-dashboard')
@section('main')
    <div class="modal fade custom-modal" id="updateDistrictModal" tabindex="-1" aria-labelledby="updateDistrictModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update District</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="ucloseModal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="id_district" >
                        <div >
                            <div >
                                <h6>Division Name</h6>
                            </div>
                            <div class="mb-3 form-group text-secondary">
                                <select name="u_division_id" id="u_division_id" class="form-select">
                                    <option></option>
                                    @foreach($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div >
                            <div >
                                <h6>District Name</h6>
                            </div>
                            <div class="mb-3 form-group text-secondary">
                                <input type="text" id="u_district_name" class="form-control "  value="" required />
                            </div>
                        </div>

                        <div class="row">
                            <div ></div>
                            <div class="text-secondary">
                                <input type="submit" class="btn btn-primary px-4" value="Update Division" onclick="updateDistrict()"/>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">All District </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All District</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a data-toggle="modal" data-bs-toggle="modal" data-bs-target="#addDistrictModal"  type="button" class="btn btn-primary">Add District</a>
                </div>
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
                            <th>Division Name </th>
                            <th>District Name </th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="districts">
                        @foreach($district as $key => $item)
                            <tr>
                                <td> {{ $key+1 }} </td>
                                <td> {{ $item['division']['division_name'] }}</td>
                                <td> {{ $item->district_name }}</td>
                                <td>
                                    <a id="{{$item->id}}" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#updateDistrictModal" class="btn btn-info" onclick="viewDistrict(this.id)">Edit</a>
                                    <a href="{{ route('delete.district',$item->id) }}" class="btn btn-danger" id="delete" >Delete</a>

                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Division Name </th>
                            <th>District Name </th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>



    </div>




@endsection
