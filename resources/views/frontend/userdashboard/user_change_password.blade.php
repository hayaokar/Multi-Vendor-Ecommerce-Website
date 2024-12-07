@extends('dashboard')
@section('user')

    <div class="card">
        <div class="card-header">
            <h5>Change Password </h5>
        </div>
        <div class="card-body">



            <form method="post" name="enq" action="{{route('user.change.password')}}" enctype="multipart/form-data">
                @csrf
                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{session('status')}}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{session('error')}}
                    </div>
                @endif
                <div class="row">

                    <div class="form-group col-md-12">
                        <label>Old Password <span class="required">*</span></label>
                        <input type="password" class="form-control @error('old_password') is-invalid @enderror"
                               name="old_password" id="old_password" placeholder="Old Password" />

                        @error('old_password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label>New Password <span class="required">*</span></label>
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                               name="new_password" id="new_password" placeholder="New Password" />

                        @error('new_password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label>Confirm New Password <span class="required">*</span></label>
                        <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation"   placeholder="Confirm New Password" />
                    </div>


                    <div class="col-md-12">
                        <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Save Change</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
