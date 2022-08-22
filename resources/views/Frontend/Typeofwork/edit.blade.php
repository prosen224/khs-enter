@extends('Frontend.mainlayout',['title'=>'Update Work Type'])
@section('content-wrapper')



<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    Update Work Type
                </h5>
                <a class="btn btn-sm btn-dark float-right" href="{{route('type-of-work')}}">Back</a>
            </div>

            <div class="card-body">
                <div class="dt-responsive">
                    

            <form method="POST" action="{{route('type-of-work.update', $s_edit3->id)}}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Type of work</label>
                    <input type="text" name="name" value="<?php echo $s_edit3->typeofwork?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" >
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
