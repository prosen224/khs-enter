@extends('Frontend.mainlayout',['title'=>'Add Clients'])
@section('content-wrapper')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    Add Client
                </h5>
                <a class="btn btn-sm btn-success float-right" href="{{route('clients')}}"><i class="fa-solid fa-arrow-left"></i> Back</a>
            </div>

            <div class="card-body" style="width: 70%;margin: 0 auto;">
                <div class="dt-responsive">
                    <form id="client_form" method="POST" action="{{route('clients.store')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{@$model->id}}">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="mb-0">Client Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Client Name" value="{{@$model->name}}">
                            <span class="error_name text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail2" class="mb-0">Rate</label>
                            <input type="text" name="rate" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" placeholder="Rate" value="{{@$model->rate}}" >
                            <span class="error_rate text-danger"></span>
                        </div>
                        <div class="submit_btn_div">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save</button>
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

    $(document).on('submit','#client_form',function(e){
        e.preventDefault();
        formSubmit('client_form','{{route('clients.store')}}','POST');
    });

</script>
@endpush
















@endsection
