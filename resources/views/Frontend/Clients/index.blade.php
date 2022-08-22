@extends('Frontend.mainlayout',['title'=>'Clients'])
@section('content-wrapper')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    Clients
                </h5>
                <a class="btn btn-success btn-sm float-right" href="{{route('clients.new')}}"><i class="fa-solid fa-plus"></i> &nbsp;Add New</a>
            </div>

            <div class="card-body">
                <div class="dt-responsive table-responsive ">
                    <table class="table table-striped table-bordered nowrap" id="trips_table" style="max-width: 100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client Name</th>
                                <th>Rate</th>
                                <th style="width:10%">Action</th>
                                
                            </tr>
                            <?php $i=0; ?>
                            @foreach($clients as $v)
                            <?php $i++ ;?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $v->name?></td>
                                <td><?php echo $v->rate?></td>
                                <td><a class="btn btn-sm btn-dark" href="{{route('clients.edit', [$v->id])}}"><i class="fa-solid fa-pen"></i></a>
                                <a class="btn btn-sm btn-danger delete-btn" href="{{route('clients.delete', [$v->id])}}"><i class="fa-solid fa-trash-can"></i></i></a></td>
                                
                            </tr>
                            @endforeach
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
