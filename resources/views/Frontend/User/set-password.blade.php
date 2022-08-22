<?php
$my_sr = $_GET["sp"];
$id = Crypt::decrypt($my_sr);
$query = \App\Models\User::findOrFail($id);
// dd($query);
?>
{{-- @if ($query) --}}
@extends('Frontend.loginlayout',['title'=>'Set Password'])
@section('content-wrapper')
<div class="container-fluid bg-dark" style="min-height: 100vh;">
    <div class="auth-wrapper" style="min-height: 55vh;">
        <div class="row">

            <div class="text-center col-sm-12">
                <img src="{{asset('assets/images/logo/aerial.svg')}}" class="img-fluid mb-4" alt="User-Profile-Image">
            </div>

            <div class="col-sm-12 px-3">
                <div class="card">
                    <div class="card-body text-center px-3">
                        <h4 class="mb-3">{{__('Set Password')}}</h4>
			   <span class="text-danger show_error_pass"></span>
                            <form id="set-password-form" action="javascript:void(0)" data-action="{{route("set-password")."/".$my_sr}}">
                            @csrf
                            <div class="form-group">
                                <input placeholder="{{__('Password')}}" type="password"  class="form-control pass" name="password">
                                <span class="password_error text-danger"></span>
                            </div>
                            <div class="form-group{{ $errors->has('confirm') ? ' has-error' : '' }}">
                                <input placeholder="{{__('Confirm Password')}}" type="password" class="form-control c_pass" name="password_mass">
                                <span class="password_mass_error text-danger"></span>
                            </div>
                            <div class="set-pass">
                                <button type="submit" id="reset-pass" class="btn btn-danger btn-block mb-4">{{__('Submit')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @endsection
@else
<h4 class="text-danger">Your Link is invalid</h4>
@endif --}}

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

    $(document).on("click","#reset-pass",function(){
        var pass = $(".pass").val();
        var c_pass = $(".c_pass").val();
        if(pass.length >= 8 && c_pass.length >= 8 && pass == c_pass){
            $("#set-password-form").submit();
        }else{
            $(".show_error_pass").html("Your password shouldn't be less than eight charecter and Both password must be matched.")
        }
    });
    $(document).on("submit","#set-password-form",function(){
        $.ajax({
            type: "post",
            url: $(this).data("action"),
            data: $("#set-password-form").serialize(),
            success: function (response) {
                let {status,message} = response;
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
            }
        });
    })

})
let set_pass = `<button type="submit" id="reset-pass" class="btn btn-danger btn-block mb-4">{{__('Submit')}}</button>`;
$(document).on({
    ajaxStart: function(){ $('.set-pass').html(loading_spinners)},
    ajaxStop: function() { $('.set-pass').html(set_pass)}
});
</script>
@endpush
