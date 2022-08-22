@extends('Frontend.mainlayout',['title'=>'Add Technician'])
@section('content-wrapper')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    Add Technician
                </h5>
                <a class="btn btn-sm btn-success float-right" href="{{route('technician')}}"><i class="fa-solid fa-arrow-left"></i> Back </a>
            </div>

            <div class="card-body" style="width: 70%;margin: 0 auto;">
                <div class="dt-responsive">
                    <form id="technician_form" method="POST" action="{{route('technician.store')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{@$model->id}}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Technician Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Technician Name" value="{{@$model->name}}" >
                            <span class="error_name text-danger field_errors"></span>
                        </div>
                        <div class="submit_btn_div">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    

<script>
    removeErrors();

    $(document).on('submit','#technician_form',function(e){
        e.preventDefault();
        formSubmit('technician_form','{{route('technician.store')}}','POST');
    });

</script>

@endpush













@endsection
