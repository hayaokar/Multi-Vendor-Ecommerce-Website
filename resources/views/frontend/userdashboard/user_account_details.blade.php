@extends('dashboard')
@section('user')

        <div class="card">
            <div class="card-header">
                <h5>Account Details</h5>
            </div>
            <div class="card-body">



                <form method="post" name="enq" action="{{route('user.profile.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Name <span class="required">*</span></label>
                            <input required="" class="form-control" name="name" type="text" value="{{ $user->name }}" />
                        </div>
                        <div class="form-group col-md-6">
                            <label>UserName <span class="required">*</span></label>
                            <input required="" class="form-control" name="username" value="{{ $user->username }}" />
                        </div>
                        <div class="form-group col-md-12">
                            <label>Email <span class="required">*</span></label>
                            <input required="" class="form-control" name="email" type="text" value="{{ $user->email }}" />
                        </div>
                        <div class="form-group col-md-12">
                            <label>Phone <span class="required">*</span></label>
                            <input required="" class="form-control" name="phone" type="text" value="{{ $user->phone }}" />
                        </div>
                        <div class="form-group col-md-12">
                            <label>Address <span class="required">*</span></label>
                            <input required="" class="form-control" name="address" type="text" value="{{ $user->address }}" />
                        </div>
                        <div class="form-group col-md-12">
                            <label>User Photo <span class="required">*</span></label>
                            <input class="form-control" name="photo" type="file"  id="image" />
                        </div>

                        <div class="form-group col-md-12">
                            <label>  <span class="required">*</span></label>
                            <img id="showImage" src="{{ (!empty($user->photo)) ? url('upload/user_images/'.$user->photo):url('upload/no_image.jpg') }}" alt="User" class="rounded-circle p-1 bg-primary" width="110">
                        </div>



                        <div class="col-md-12">
                            <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Save Change</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection
