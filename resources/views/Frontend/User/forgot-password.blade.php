@extends('Frontend.loginlayout',['title'=>'Forgot Password'])
@section('content-wrapper')
<div class="container-fluid bg-dark" style="min-height: 100vh;">

    <div class="text-center text-md-right mt-3 mb-4">
        <a class="btn btn-sm btn-danger text-uppercase m-0" href="{{route('login')}}">{{__("Back to login")}}</a>
    </div>
        <div class="auth-wrapper" style="min-height: 55vh;">
            <div class="row">
                <div class="text-center col-sm-12">
                    <img src="{{asset('assets/images/logo/aerial.svg')}}" class="img-fluid mb-4" alt="User-Profile-Image">
                </div>
                <div class="col-sm-12 px-3">
                    <div class="card">
                        <div class="card-body text-center px-3">
                            <h5 class="mb-3">{{__('Forgot Password')}}</h5>
                            <form id="forgot-password-form" action="javascript:void(0)">
                                @csrf
                                <div class="form-group">
                                    <input placeholder="{{__('Enter your email address')}}" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                    <span class="text-danger error_email"></span>
                                </div>
                                <div class="forgot-pass">
                                    <button type="submit" id="fotgot-password-btn" class="btn btn-danger mt-2 text-uppercase font-weight-bold">{{__('Submit')}}</button>
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

    // method="POST" action="{{route("forgot-password")}}"
    $(document).on("click","#fotgot-password-btn",function(){
        var em = $.trim($("input[name='email']").val());
        if(em.length > 5){
            $("#forgot-password-form").submit();
        }else{
            $(".error_email").html(`Please input a valid E-mail`);
        }
    });
    $(document).on("submit","#forgot-password-form",function(e){
        var em = $.trim($("input[name='email']").val());
        e.preventDefault();
        $.ajax({
            type: "post",
            url: '{{route("forgot-password")}}',
            data: {"email":em},
            success: function (response) {
                let {status,message}=response;
                if(status == "success"){
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
                if(status == "error"){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: `${message}`,
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "{{route('registration')}}";
                        }
                    })
                }
            }
        });
    })
})
let forgot_password = `<button type="submit" id="fotgot-password-btn" class="btn btn-danger mt-2 text-uppercase font-weight-bold">{{__('Submit')}}</button>`;
$(document).on({
    ajaxStart: function(){ $('.forgot-pass').html(loading_spinners)},
    ajaxStop: function() { $('.forgot-pass').html(forgot_password)}
});
</script>
@endpush
