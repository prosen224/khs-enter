@extends('Frontend.mainlayout',['title'=>'Add User'])
@section('content-wrapper')



<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    Add User
                </h5>
                <a class="btn btn-sm btn-dark float-right" href="{{route('user-permission')}}">Back</a>
            </div>

            <div class="card-body">
                <div class="dt-responsive">
                    

            <form method="POST" action="{{route('user-permission.store')}}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">User Name</label>
                    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" >
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror               
                </div>



                <div class="form-group">
                    <label for="exampleInputEmail2">First Name</label>
                    <input type="text" name="firstname" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" placeholder="" >
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror               
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail3">Last Name</label>
                    <input type="text" name="lastname" class="form-control" id="exampleInputEmail3" aria-describedby="emailHelp" placeholder="" >
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror               
                </div>


                <div class="form-group">
                    <label for="exampleInputEmail4">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail4" aria-describedby="emailHelp" placeholder="" >
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror               
                </div>


                <div class="form-group">
                    <label for="exampleInputEmail5">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputEmail5" aria-describedby="emailHelp" placeholder="" >
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror               
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Power</label>
                    <select class="form-control" name="role">
                        @foreach($xyz->userroles as $k=>$v)                               
                            <option value="{{$k}}">{{$v}}</option>
                        @endforeach
                    </select>             
                </div>

                
                <button type="submit" class="btn btn-primary">Save</button>

            </form>



                </div>
            </div>
        </div>
    </div>
</div>

@endsection
