@extends('Frontend.mainlayout',['title'=>'ALL User'])
@section('content-wrapper')



<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    All User
                </h5>
                <a class="btn btn-success btn-sm float-right" href="{{route('registration')}}"><i class="fa-solid fa-plus"></i> &nbsp;Add User</a>
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
                                <th>Status</th>
                                <th style="width:10%">Action</th>
                                
                            </tr>

                            <?php
                                $i = 0;
                                foreach($user as $v){
                                    $i++;             
                            ?>
                            @if($v->name !="coder71")
                            <tr>
                               
                                <td><?php echo @$i; ?></td>                     
                                <td><?php echo @$v->name; ?></td>
                                <td><?php echo @$v->first_name; ?></td>                     
                                <td><?php echo @$v->last_name; ?></td>
                                <td><?php echo @$v->email; ?></td>
                                <td><?php echo (@$model2->userroles[$v->role])?@$model2->userroles[$v->role]:"Super Admin"?></td>
                                <td>{!!
                                 ($v->status == 0)?'<span class="badge badge-danger">InActive</span>':'<span class="badge badge-success">Active</span>' 
                                 !!}</td>
                                <td>
                                    @if($v->role != 99)
                                    @if($v->status == 1)
                                    <a class="btn btn-sm btn-warning change-user-status" href="{{route('user.change-status',[$v->id,0])}}" title="Make inactive"><i class="fa-solid fa-thumbs-down"></i></a>
                                    @else
                                    <a class="btn btn-sm btn-success change-user-status" href="{{route('user.change-status',[$v->id,1])}}" title="Make Active"><i class="fa-solid fa-thumbs-up"></i></a>
                                    @endif
                                    @endif
                            </td>
                                @endif
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
@push('scripts')
<script>
    $(document).ready(function() {
        $(document).on("click",".change-user-status",function(e){
            // confirm change status
            e.preventDefault();
            var url = $(this).attr('href');
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to change status!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = url;
                }
            })
        });
    });
</script>
@endpush
