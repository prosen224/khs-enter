@extends('Frontend.loginlayout',['title'=>'Registration'])
@section('content-wrapper')
<div class="container-fluid bg-dark" style="min-height: 100vh;">

    <div class="text-center text-md-right mt-3 mb-4">
        <a class="btn btn-sm btn-danger m-0" href="{{route('login')}}">{{__("LOGIN")}}</a>
    </div>

    <div class="auth-wrapper" style="min-height: 55vh;">
        <div class="row">

            <div class="text-center col-sm-12">
                <img src="{{asset('assets/images/logo/aerial.svg')}}" class="img-fluid mb-4" alt="User-Profile-Image">
            </div>

            <div class="col-sm-12 px-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="mb-3">{{__('Registration')}}</h5>
                        <form id="user_registration_form" action="javascript:void(0)">
                            @csrf

                            <div class="row mb-2">

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group mb-2 text-left">
                                        <input id="" type="text" class="form-control " name="first_name" value="" placeholder="{{__('First Name')}}" title="{{__('First Name')}}">
                                        <span class="text-danger error_first_name"></span>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group mb-2 text-left">
                                        <input id="" type="text" class="form-control " name="last_name" value=""  placeholder="{{__('Last Name')}}" title="{{__('Last Name')}}">
                                        <span class="text-danger error_last_name"></span>
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-2">

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group mb-2 text-left">
                                        <input placeholder="{{__('Phone')}}" type="text" class="form-control" name="phone" title="{{__('Phone')}}">
                                        <span class="text-danger error_phone"></span>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group mb-2 text-left">
                                        <input placeholder="{{__('E-mail')}}" type="email" class="form-control" name="email" title="{{__('E-mail')}}">
                                        <span class="text-danger error_email"></span>
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-2">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group mb-2 text-left">
                                        <input placeholder="{{__('User Name')}}" type="text" class="form-control" name="user_name" title="{{__('User Name')}}">
                                        <span class="text-danger error_user_name"></span>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group mb-3 text-left">
                                        <input placeholder="{{__('Password')}}" id="password" type="password" class="form-control" name="password" autocomplete="current-password" title="{{__('Password')}}">
                                        <span class="text-danger error_password"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="reg-btn">
                                <button type="submit" id="user_registration_btn" class="btn btn-danger btn-block mb-4">{{__('Register')}}</button>
                            </div>
                        </form>
                    </div>
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
                        window.location = "{{route('login')}}";
                        }
                    })
                }
            }
        });
    })
});


var reg_btn = `<button type="submit" id="user_registration_btn" class="btn btn-danger btn-block mb-4">{{__('Register')}}</button>`;
$(document).on({
    ajaxStart: function(){ $('.reg-btn').html(loading_spinners)},
    ajaxStop: function() { $('.reg-btn').html(reg_btn)}
});

</script>
@endpush
