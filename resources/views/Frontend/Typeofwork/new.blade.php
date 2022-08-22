@extends('Frontend.mainlayout',['title'=>'Add Work Type'])
@section('content-wrapper')



<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    Type of work
                </h5>
                <a class="btn btn-sm btn-success float-right" href="{{route('type-of-work')}}"><i class="fa-solid fa-arrow-left"></i> Back</a>
            </div>

            <div class="card-body" style="width: 70%;margin: 0 auto;">
                <div class="dt-responsive">
                    <form id="type_of_works_form" method="POST" action="{{route('type-of-work.store')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{@$model->id}}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Type of work</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Type of work" value="{{@$model->typeofwork}}" />
                            <span class="error_name text-danger"></span>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    removeErrors();

    $(document).on('submit','#type_of_works_form',function(e){
        e.preventDefault();
        formSubmit('type_of_works_form','{{route('type-of-work.store')}}','POST');
    });
</script>
@endpush


















@endsection
