@extends('Frontend.loginlayout',['title'=>'Login'])
@section('content-wrapper')
<div class="container-fluid bg-dark" style="min-height: 100vh;">

    

    <div class="auth-wrapper" style="min-height: 55vh;">
        <div class="row">

            <div class="text-center col-sm-12 mt-5">
                <img src="{{asset('assets/images/logo/pro.png')}}" width="150" class="img-fluid mb-4" alt="User-Profile-Image">
            </div>

            <div class="col-sm-12 px-3">
                <div class="card">
                    <div class="card-body text-center px-3">
                        <h4 class="mb-3">{{__('Login')}}</h4>

                        <form id="user_login_form"  action="javascript:void(0)" >
                            @csrf
                            {{-- <div class="form-group">
                                <input placeholder="{{__('Username')}}" type="email" class="form-control bg-light" name="email" >
                                <span class="text-danger error_email"></span>
                            </div> --}}
                            <div class="form-group">
                                <input placeholder="{{__('Username')}}" type="text" class="form-control bg-light" name="name" >
                                <span class="text-danger error_name d-flex"></span>
                            </div>

                            <div class="form-group">
                                <input placeholder="{{__('Password')}}" type="password" class="form-control bg-light" name="password" >
                                <span class="text-danger error_password d-flex"></span>
                            </div>

                            <div class="mb-2 text-center">
                                <div class="form-group d-inline">
                                    <div class="radio d-inline">
                                        <input type="checkbox" name="radio-in-1" id="remember_me_login" checked>
                                        <label for="remember_me_login" class="cr">{{__('Remember me')}}</label>
                                        <br><span class="pls_remember text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="login-btn">
                            <button type="submit" class="btn btn-success btn-block mb-4 text-uppercase font-weight-bold" id="user_login_btn">{{__('Login')}}</button>
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

    $(document).on("submit","#user_login_form",function(e){
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "{{route('login')}}",
            data: $("#user_login_form").serialize(),
            success: function (response) {
                let {status,message} = response;
                if(status == 'error'){
                    $.each(response['errors'], function (key, value) {
                        $('.error_'+key).html(value);
                    });
                    if(message != '' && message != undefined){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: `${message}`,
                        })
                    }
                }
                if(status == "success"){
                    Swal.fire({
                        icon: 'success',
                        title: 'Welcome',
                        text: `${message}`,
                        button:false,
                        timer: 3000
                    })
                    window.location = "{{route('home')}}";
                }
                if(status == "inactive"){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: `${message}`,
                    })
                }
            }
        });
    })
})

var login_btn = `<button type="submit" class="btn btn-success btn-block mb-4 text-uppercase font-weight-bold" id="user_login_btn">{{__('Login')}}</button>`;
$(document).on({
    ajaxStart: function(){ $('.login-btn').html(loading_spinners)},
    ajaxStop: function() { $('.login-btn').html(login_btn)}
});
</script>
@endpush
