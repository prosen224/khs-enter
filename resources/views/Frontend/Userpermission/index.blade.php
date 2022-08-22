@extends('Frontend.mainlayout',['title'=>'ALL User'])
@section('content-wrapper')



<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    All User
                </h5>
                <a class="btn btn-dark btn-sm float-right" href="{{route('user-permission.new')}}"><i class="fa-solid fa-plus"></i> &nbsp;Add User</a>
            </div>

            <div class="card-body">
                <div class="dt-responsive table-responsive ">
                    <table class="table table-striped table-bordered nowrap" id="trips_table" style="max-width: 100%">
                        <thead>
                            <tr>
                                <th style="width:10%">ID</th>
                                <th>User Name</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Power</th>
                                <th style="width:10%">Action</th>
                                
                            </tr>

                            <?php
                                $i = 0;
                                foreach($user as $v){
                                    $i++;             
                            ?>
                            <tr>
                               
                                <td><?php echo @$i; ?></td>                     
                                <td><?php echo @$v->name; ?></td>
                                <td><?php echo @$v->first_name; ?></td>                     
                                <td><?php echo @$v->last_name; ?></td>
                                <td><?php echo @$v->email; ?></td>
                                <td><?php echo @$model2->userroles[$v->role]?></td>
                                <td><a class="btn btn-sm btn-dark" href=""><i class="fa-solid fa-pen"></i></a>
                                <a class="btn btn-sm btn-danger delete-btn" href=""><i class="fa-solid fa-trash-can"></i></i></a></td>
                                
                            </tr>
                            <?php } ?>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
.btn > i {
    margin-right: 0px!important;
}
</style>













@endsection
