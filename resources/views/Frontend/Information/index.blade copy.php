@extends('Frontend.mainlayout',['title'=>'Information'])
@section('content-wrapper')

@php
$my_sortarr = [
    'id' => 'ID',
    'date' => 'Date',
    'technician' => 'Technician',
    'client' => 'Client',
    'type_of_work' => 'Type of Work',
    'billable' => 'Billable',
    'bill_info' => 'Bill Info',
    'payment_info' => 'Payment Info',
    'status' => 'Status',
];
@endphp

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    Information
                </h5>
                <a class="btn btn-success btn-sm float-right" href="{{route('information.new')}}"><i class="fa-solid fa-plus"></i> &nbsp;Add Info</a>
            </div>
           
            <div class="card-body">
                <div class="row">
                    <div class="col-3 pb-2">
                        <select name="sort_by" class="form-control form-control-sm sort_information" id="sort_information">
                            <option value="">Sort By</option>
                            @foreach($my_sortarr as $key => $value)
                                <option value="{{$key}}" {{(@$_GET['sort_by'] == $key)?"selected":""}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="dt-responsive table-responsive ">
                    <table class="table table-striped table-bordered nowrap" id="trips_table" style="max-width: 100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Technician</th>
                                <th>Client</th>
                                <th>Type of Work</th>
                                <th>Duration</th>
                                <th>Billable</th>
                                <th>Rate</th>
                                <th>Billed Info</th>
                                <th>Payment Info</th>
                                {{-- <th>Details</th> --}}
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; ?>
                            @foreach($information as $v)
                             <?php $i++; ?>

                            <tr>
                               <td>{{@$i}}</td>
                               <td>{{@$v->date}}</td>
                               <td>{{@$v->my_technician->name}}</td>
                               <td>{{@$v->my_client->name}}</td>
                               <td>{{@$v->my_typeofwork->typeofwork}}</td>                              
                               <td>{{@$v->duration}}</td>
                               <td>{!! (@$v->billable == 1 )? '<span class="badge badge-success">Yes</span>':'<span class="badge badge-danger">No</span>' !!}</td>
                               <td>{{@$v->rate}}</td>
                               <td>{{@$v->billed_info}}</td>
                               <td>{{@$v->payment_info}}</td>
                               {{-- <td style="white-space: normal;">{{$v->details}}</td> --}}
                               <td>{!! (@$v->status == 0)?'<span class="badge badge-info">Pending</span>':'<span class="badge badge-success">Approved</span>' !!}</td>
                               
                                <td>
                                    <a class="btn btn-sm btn-success" title="Show" href="{{route('information.show',$v->id)}}"><i class="fa-solid fa-eye"></i></a>
                                    {{-- <a class="btn btn-sm btn-dark" title="Edit" href="{{route('information.edit',$v->id)}}"><i class="fa-solid fa-pen"></i></a> --}}
                                    {{-- @can('isSuparAdmin') --}}
                                    <a class="btn btn-sm btn-danger delete-btn" title="Delete" href="{{route('information.delete',$v->id)}}"><i class="fa-solid fa-trash-can"></i></i></a>
                                    {{-- @endcan --}}
                                    @if(@$v->status == 0)
                                    <a class="btn btn-sm btn-info change-status-btn" title="Approve" href="{{route("information.change-status",$v->id)}}"><i class="fa-solid fa-thumbs-up"></i></a>
                                    @endif
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- pagination start --}}
                    {{$information->onEachSide(2)->links()}}
                    {{-- pagination end --}}
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
@push("scripts")
<script>
    $(document).ready(function() {
        // confirm change status
        $('.change-status-btn').click(function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to approve this information!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = url;
                }
            })
        });
        $(document).on("change",'#sort_information',function(){
            let url = "{{route('information')}}";
            let sort_by= $(this).val();
            console.log(sort_by);
            if(sort_by != ''){
                window.location.href = `${url}?sort_by=${sort_by}`;
            }
            
        })
    });
</script>
@endpush
