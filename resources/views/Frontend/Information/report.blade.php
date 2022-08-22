@extends('Frontend.mainlayout',['title'=>'Add Report'])
@section('content-wrapper')



<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    Reports
                </h5>
            </div>

            <div class="card-body">
                <div class="dt-responsive">
                    <form id="information_form" action="" >
                        @csrf
                        <div class="row mb-2">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="info2">Client's Name</label>
                                    <select name="client" class="form-control" id="info2">
                                        <option value="">All Client's</option>
                                        @foreach($client as $v)
                                            <option value="{{$v->id}}" {{(@$model->client == $v->id)?"selected":""}}>{{$v->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="error_technician text-danger"></span>
                                </div>
                            </div>
                            
                            
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="info1">Start Date</label>
                                    <input type="date" name="start_date" class="form-control" value="{{@$model->date}}" id="info1" aria-describedby="emailHelp" placeholder="" >
                                    <span class="error_date text-danger"></span>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="info3">End Date</label>
                                    <input type="date" name="end_date" class="form-control" value="{{@$model->date}}" id="info3" aria-describedby="emailHelp" placeholder="" >
                                    <span class="error_date text-danger"></span>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="approved_report">Approved Status</label>
                                    <select name="approved_report" id='approved_report' class="form-control">
                                        <option value="">All</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="bill_payment">With Billed & Payment?</label>
                                    <select name="bill_payment" id='bill_payment' class="form-control">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="submit_btn_div">
                            <button type="submit" class="btn btn-primary report_submit" value="1" data-action="{{route('information.report')}}"><i class="fa-solid fa-filter"></i>Show Report</button>
                            <button type="button" class="btn btn-warning report_submit" value="2" data-action="{{route('information.report')}}?pdf=1"><i class="fa-solid fa-download"></i>Download Report</button>
                        </div>
                        
                    </form>
                </div>
                <div class="dt-responsive table-responsive pt-3">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $(document).on("click",".report_submit",function(){
                if($(this).val() == 2){
                    // open new tab and form submit with new tab
                    let client_name = $("#info2").val();
                   
                    let start_date = $("#info1").val();
                    let end_date = $("#info3").val();
                    let approved_report = $("#approved_report").val();
                    let bill_payment = $("#bill_payment").val();
                    let url = $(this).data('action')+"?&client_name="+client_name+"&start_date="+start_date+"&end_date="+end_date+"&approved_report="+approved_report +"&bill_payment="+bill_payment;
                    window.open(url, '_blank');
                    // window.open(url, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
                    // console.log(url);
                    // var win = window.open($(this).data('action')+"?pdf=1?client_name="+client_name+?", '_blank');
                    // win.focus();

                }
            })
            // ajax setup form
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on("submit","#information_form",function(e){
                e.preventDefault();
                let url = $(this).attr('action');
                $.ajax({
                    url:url,
                    type:'GET',
                    data:$(this).serialize(),
                    dataType:'json',
                    success:function(data){
                        console.log(data);
                        $(".table-responsive").html(data);
                    }
                });
               
            });
        })
    </script>
@endpush