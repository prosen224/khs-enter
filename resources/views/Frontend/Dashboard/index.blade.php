@extends('Frontend.mainlayout',['title'=>'Dashbord'])
@section('content-wrapper')

<div class="row">
    <div class="col-md-3 p-1">
        <a href="{{route('information')}}">
            <div class="card table-card widget-purple-card bg-c-yellow mb-2">
                <div class="row-table">
                    <div class="col-sm-4 card-body-big">
                        <i class="fas fa-info"></i>
                    </div>
                    <div class="col-sm-8">
                        <h4>{{@$information}}</h4>
                        <h6>Information</h6>
                    </div>
                </div>
            </div>
        </a>
    </div>
    
    <div class="col-md-3 p-1">
        <a href="{{route('technician')}}">
            <div class="card table-card widget-primary-card bg-c-blue mb-2">
                <div class="row-table">
                    <div class="col-sm-4 card-body-big">
                        <i class="feather icon-anchor"></i>
                    </div>
                    <div class="col-sm-8">
                        <h4>{{$technicians}}</h4>
                        <h6>Technicians</h6>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3 p-1">
        <a href="{{route('clients')}}">
            <div class="card table-card widget-purple-card bg-success mb-2">
                <div class="row-table">
                    <div class="col-sm-4 card-body-big">
                        <i class="feather icon-user-check"></i>
                    </div>
                    <div class="col-sm-8">
                        <h4>{{$clients}}</h4>
                        <h6>Clients</h6>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3 p-1">
        <a href="{{route('type-of-work')}}">
            <div class="card table-card widget-purple-card bg-danger mb-2">
                <div class="row-table">
                    <div class="col-sm-4 card-body-big">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="col-sm-8">
                        <h4>{{$typeofwork}}</h4>
                        <h6>Type Of Work</h6>
                    </div>
                </div>
            </div>
        </a>
    </div>

    @can('isSuparAdmin')
    <div class="col-md-3 p-1">
        <a href="{{route('all-user')}}">
            <div class="card table-card widget-primary-card bg-secondary mb-2">
                <div class="row-table">
                    <div class="col-sm-4 card-body-big">
                        <i class="feather icon-user"></i>
                    </div>
                    <div class="col-sm-8">
                        <h4>{{ $users }}</h4>
                        <h6>Total User</h6>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endcan

</div>
@endsection
