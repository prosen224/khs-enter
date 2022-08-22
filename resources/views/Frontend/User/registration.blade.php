@extends('Frontend.mainlayout',['title'=>'Add User'])
@section('content-wrapper')



<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    Add User
                </h5>
                <a class="btn btn-sm btn-success float-right" href="{{route('all-user')}}"><i class="fa-solid fa-arrow-left"></i> Back</a>
            </div>

            <div class="card-body">
                <div class="dt-responsive">
                    <form id="user_registration_form" action="javascript:void(0)">
                        @csrf
                        <input type="hidden" name="user_id" value="{{@$model->id}}">
                        <div class="row mb-2">

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group mb-2 text-left">
                                    <input id="" type="text" class="form-control " value="{{@$model->first_name}}" name="first_name"  placeholder="{{__('First Name')}}" title="{{__('First Name')}}">
                                    <span class="text-danger error_first_name"></span>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group mb-2 text-left">
                                    <input id="" type="text" class="form-control " name="last_name"  placeholder="{{__('Last Name')}}" title="{{__('Last Name')}}" value="{{@$model->last_name}}">
                                    <span class="text-danger error_last_name"></span>
                                </div>
                            </div>

                        </div>

                        <div class="row mb-2">

                            {{-- <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <select class="form-control" name="role">
                                        <option value="">Select Role</option>
                                        @foreach($model->userroles as $k=>$v)                               
                                            <option value="{{$k}}" <?= (@$model->role == $k)?"selected":"" ?>>{{$v}}</option>
                                        @endforeach
                                    </select> --}}
                                    <input type="hidden" name="role" value="1">
                                    {{-- <span class="text-danger error_role"></span>       --}}
                                {{-- </div>
                            </div> --}}

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group mb-2 text-left">
                                    <input placeholder="{{__('E-mail')}}" type="email" class="form-control" name="email" title="{{__('E-mail')}}" value="{{@$model->email}}">
                                    <span class="text-danger error_email"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group mb-2 text-left">
                                    <input placeholder="{{__('User Name')}}" type="text" class="form-control" name="user_name" title="{{__('User Name')}}" value="{{@$model->name}}">
                                    <span class="text-danger error_user_name"></span>
                                </div>
                            </div>

                        </div>

                        <div class="row mb-2">
                            

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group mb-3 text-left">
                                    <input placeholder="{{__('Password')}}" id="password" type="password" class="form-control" name="password" autocomplete="current-password" title="{{__('Password')}}" value="">
                                    <span class="text-danger error_password"></span>
                                </div>
                            </div>
                        </div>
                        <div class="reg-btn d-flex justify-content-center">
                            <button type="submit" id="user_registration_btn" class="btn btn-success btn-block mb-4" style="width: 50%;
                            margin: 0 auto;">{{(@$model->id)?"Update":'Save'}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')

<script src="{{ asset('assets/plugins/sweetalert/sweetalert2.min.js') }}"></script>
<script src="{{asset('assets/js/custom/loading.js')}}"></script>

<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



    $(document).on("click","#user_registration_btn",function(){
        $("#user_registration_form").submit();
    });
    $(document).on("submit","#user_registration_form",function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '{{route("registration")}}',
            data: $("#user_registration_form").serialize(),
            success: function (response) {
                let {status,message} = response;
                if(status == 'error'){
                    $.each(response['errors'], function (key, value) {
                        $('.error_'+key).html(value);
                    });
                }
                if(status=='success'){
                    $('#user_registration_form')[0].reset();
                    Swal.fire({
                        icon: 'success',
                        title: 'Welcome',
                        text: `${message}`,
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "{{route('all-user')}}";
                        }
                    })
                }
            }
        });
    })
});


var reg_btn = `<button type="submit" id="user_registration_btn" class="btn btn-success btn-block mb-4" style="width: 50%;                     margin: 0 auto;">{{__('Register')}}</button>`;
$(document).on({
    ajaxStart: function(){ $('.reg-btn').html(loading_spinners)},
    ajaxStop: function() { $('.reg-btn').html(reg_btn)}
});

</script>
@endpush
