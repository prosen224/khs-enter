@extends('Frontend.mainlayout',['title'=>'Add Infromation'])
@section('content-wrapper')



<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    Add Infromation
                </h5>
                <a class="btn btn-sm btn-success float-right" href="{{route('information')}}"><i class="fa-solid fa-arrow-left"></i> Back</a>
            </div>
            @php
                // dd($model);
            @endphp
            <div class="card-body">
                <div class="dt-responsive">
                    <form id="information_form" method="POST" action="{{route('information.store')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{@$model->id}}">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="info2">Technician</label>
                                    <select name="technician" class="form-control" id="info2">
                                        <option value="">Select technician</option>
                                        @foreach($technican as $v)
                                            <option value="{{$v->id}}" {{(@$model->technician_id == $v->id)?"selected":""}}>{{$v->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="error_technician text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="info3">Client</label>
                                    <select name="client" class="form-control" id="info3">
                                        <option value="">Select Client</option>
                                        @foreach($client as $v)
                                            <option value="{{$v->id}}" {{(@$model->client_id == $v->id)?"selected":""}}>{{$v->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="error_technician text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="info4">Type of Work</label>
                                    <select name="typeofwork" class="form-control" id="info4">
                                        <option value="">Select Work Type</option>
                                        @foreach($typeofwork as $v)
                                            <option value="{{$v->id}}" {{(@$model->typeofwork_id == $v->id)?"selected":""}}>{{$v->typeofwork}}</option>
                                        @endforeach
                                    </select>
                                    <span class="error_technician text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="info1">Date</label>
                                    <input type="date" name="date" class="form-control" value="{{@$model->date}}" id="info1" aria-describedby="emailHelp" placeholder="" >
                                    <span class="error_date text-danger"></span>
                                </div>
                            </div>
                            @php
                               // dd(explode(' ',$model->duration));
                               if(isset($model->duration)){
                                   $duration = explode(' ',$model->duration);
                                   $duration_hour = $duration[0];
                                   $duration_min = $duration[2];
                               }
                            @endphp
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="info5">Hours</label>
                                    <select  name="hours" class="form-control" id="info5">
                                        <option value="">Select Hours</option>
                                        @for($i=0; $i<=100; $i++)
                                            <option value="{{$i}}" {{(@$duration_hour == $i)?"selected":""}}>{{$i}}</option>
                                        @endfor
                                    </select>
                                    <span class="error_hours text-danger"></span>
                                </div>
                            </div>
                         
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="info6">Minutes</label>
                                    <select name="minutes" class="form-control" id="info6">
                                        <option value="">Select Minutes</option>
                                        @for($i=0; $i<=59; $i++)
                                            <option value="{{$i}}" {{(@$duration_min == $i)?"selected":""}}>{{$i}}</option>
                                        @endfor
                                    </select>
                                    <span class="error_minutes text-danger"></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="info7">Billed Info</label>
                                    <input type="text" name="billed_info" class="form-control" id="info7" aria-describedby="emailHelp" placeholder="" value="{{@$model->billed_info}}" >
                                    <span class="error_billed_info text-danger"></span>            
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="info8">Payment Info</label>
                                    <input type="text" name="payment_info" class="form-control" value="{{@$model->payment_info}}" id="info8" aria-describedby="emailHelp" placeholder="" >
                                    <span class="error_payment_info text-danger"></span>         
                                </div>
                            </div>
                        </div>

                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-1 pt-0">Billable:</legend>
                                <div class="col-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="billable" id="yes" value="1" checked>
                                        <label class="form-check-label" for="yes">
                                            Yes
                                        </label>
                                    </div>
                                    </div>
                                    <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="billable" id="no" value="0" {{(@$model->billable == 0)?"checked":""}}>
                                        <label class="form-check-label" for="no">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-group">
                            <label for="info9">Details</label>
                            <textarea id="info9" class="form-control" name="details" value="{{@$model->details}}">{{@$model->details}}</textarea>
                            <span class="error_details text-danger"></span>          
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
@endsection
@push('scripts')
    

<script>
    removeErrors();

    $(document).on('submit','#information_form',function(e){
        e.preventDefault();
        formSubmit('information_form','{{route('information.store')}}','POST');
    });

</script>

@endpush