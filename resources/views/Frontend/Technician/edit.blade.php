@extends('Frontend.mainlayout',['title'=>'Update Technician'])
@section('content-wrapper')



<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    Update Technician
                </h5>
                <a class="btn btn-sm btn-dark float-right" href="{{route('technician')}}">Back</a>
            </div>

            <div class="card-body">
                <div class="dt-responsive">
                    

            <form method="POST" action="{{route('technician.update', $s_edit->id)}}">
            
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" value="<?php echo $s_edit->name?>" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" >
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                </div>
                <button type="submit" class="btn btn-primary">Update</button>

            </form>



                </div>
            </div>
        </div>
    </div>
</div>


















@endsection
