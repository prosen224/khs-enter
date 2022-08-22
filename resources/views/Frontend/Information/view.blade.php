@extends('Frontend.mainlayout',['title'=>'Type of Work'])
@section('content-wrapper')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-header">
                    <h5>
                        Information Details
                    </h5>
                    <a class="btn btn-success btn-sm float-right" href="{{route('information')}}"><i class="fa-solid fa-arrow-left"></i> &nbsp;Back</a>
                </div>
                
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-5 col-md-2 py-1 font-weight-bold">Date: </div>
                    <div class="col-7 col-md-10 py-1"><?php echo $information->date; ?></div>
                </div>

                <div class="row mb-2">
                    <div class="col-5 col-md-2 py-1 font-weight-bold">Technician: </div>
                    <div class="col-7 col-md-10 py-1"><?php echo $information->my_technician->name; ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 col-md-2 py-1 font-weight-bold">Client: </div>
                    <div class="col-7 col-md-10 py-1"><?php echo $information->my_client->name; ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 col-md-2 py-1 font-weight-bold">Type of Work: </div>
                    <div class="col-7 col-md-10 py-1"><?php echo $information->my_typeofwork->typeofwork; ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 col-md-2 py-1 font-weight-bold">Time Duration: </div>
                    <div class="col-7 col-md-10 py-1"><?php echo $information->hours." Hrs ".$information->minutes. " Mins" ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 col-md-2 py-1 font-weight-bold">Billable: </div>
                    <div class="col-7 col-md-10 py-1">
                        <?php
                            if($information->billable == 1){
                                echo "Yes";
                            }else{
                                echo "No";
                            }
                        ?>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 col-md-2 py-1 font-weight-bold">Billed Info: </div>
                    <div class="col-7 col-md-10 py-1"><?php echo $information->billed_info; ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 col-md-2 py-1 font-weight-bold">Payment Info: </div>
                    <div class="col-7 col-md-10 py-1"><?php echo $information->payment_info; ?></div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 col-md-2 py-1 font-weight-bold">Status: </div>
                    <div class="col-7 col-md-10 py-1">
                    <?php
                            if($information->status == 1){
                                echo "Approved";
                            }else{
                                echo "Pending";
                            }
                        ?>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 col-md-2 py-1 font-weight-bold">Details: </div>
                    <div class="col-7 col-md-10 py-1"><?php echo $information->details; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .view-table tr th{
        width:150px;
    }
    
</style>
@endsection