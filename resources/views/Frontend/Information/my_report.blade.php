@if(count($information)>0  || count($information2)>0)
<table class="table table-striped table-bordered nowrap pt-3" id="trips_table" style="width: 100%; max-width: 100%; border:1px solid #ddd;border-collapse: collapse;text-align: center;white-space: normal;font-size: 12px;">
    
    <caption style="margin-bottom: 5px;font-size: 20px; font-weight: bold;caption-side: top; text-align: center;" >
       
        @if($pdf !=1)
        <h2>{{env("APP_NAME")}}</h2>
        <h6>Report</h6>
        @else
        <h2>KHS IT Solutions, Inc.</h2>
        <h6 style="border-bottom: 1px solid;">Phone: 469-440-9711, Web: www.khsitsolutions.com</h6>
        @endif
        
        @if($client_name)
        <span style="font-size: 14px">Client Name: {{@$client_name}}</span><br>
        @else
        <span style="font-size: 14px">All Client</span><br>
        @endif
        @if(count($information)>0)
        <span style="font-size: 14px">
            Detail description of work performed:
            @if($start_date && $end_date)
            <span style="font-size: 14px;margin-top: 20px;color: #19BCBF">
                From {{$start_date}} to {{$end_date}}
            </span>
            @else
            <span style="font-size: 14px;margin-top: 20px;color: #19BCBF">
                From Beginning to End
            </span>
            @endif
        </span>
    @endif
    </caption>
    @if(count($information)>0)
    <thead>
        <tr>
            <th style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;background: #eee;padding: 10px;width: 80px;">Date</th>
            <th style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;background: #eee;padding: 10px;">Resource</th>
            <th style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;background: #eee;padding: 10px;width: 80px;">Duration (Hrs)</th>
            @if($bill_payment == 1)
            <th style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;background: #eee;padding: 10px;">Billed</th>
            <th style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;background: #eee;padding: 10px;">Payment</th>
            @endif
            <th style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;background: #eee;padding: 10px;">Description</th>
            {{-- <th style="border-bottom:1px solid #ddd;background: #eee;padding: 10px;">Status</th> --}}
        </tr>
    </thead>
    <tbody>
        @php
            $total_hours=0;
            $total_minutes=0;
        @endphp
        @foreach($information as $v)
         @php
                $duration = $v->duration;
                $duration_array = explode(' ', $duration);
                $duration_hour = (int)$duration_array[0];
                $duration_min = (int)$duration_array[2];
                $total_hours +=  $duration_hour;
                $total_minutes +=  $duration_min;
         @endphp
        <tr>
           <td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 10px;">{{ date("d-m-Y", strtotime(@$v->date)) }}</td>
           <td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 10px;">{{@$v->my_technician->name}}</td>                          
           <td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 10px;">{{@$v->duration}}</td>    
           @if($bill_payment == 1)                                                       
           <td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 10px;white-space: normal; text-align: left;">{{@$v->billed_info}}</td>
           <td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 10px;white-space: normal; text-align: left;">{{@$v->payment_info}}</td>
            @endif
           <td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 10px;white-space: normal; text-align: left;">{{$v->details}}</td>
           {{-- <td style="border-bottom:1px solid #ddd;padding: 10px;">{!! ($v->status == 0)?'Pending':'Approved' !!}</td> --}}
        </tr>
        @endforeach
        @php
            $total_minutes = $total_minutes%60;
	        $total_hours += (int)$total_minutes/60;
        @endphp
        <tr>
            <td style="background: #39465C;color: #fff; padding: 10px;"></td>
            <td style="background: #39465C;color: #fff; padding: 10px;font-weight: bold;">Total : </td>
            <td style="background: #39465C;color: #fff; padding: 10px;font-weight: bold;">{{  round($total_hours). " Hrs ". $total_minutes ." Mins"}}</td>
            <td style="background: #39465C;color: #fff; padding: 10px;"></td>
            {{-- <td style="background: #39465C;color: #fff; padding: 10px;"></td> --}}
            @if($bill_payment == 1)
            <td style="background: #39465C;color: #fff; padding: 10px;"></td>
            <td style="background: #39465C;color: #fff; padding: 10px;"></td>
            @endif
        </tr>
    </tbody>
    @endif
</table>

@if(count($information2)>0)
<table class="table table-striped table-bordered nowrap pt-3" id="trips_table" style="width: 100%; max-width: 100%; border:1px solid #ddd;border-collapse: collapse;text-align: center;white-space: normal;font-size: 12px;">
    <caption style="margin-bottom: 5px;font-size: 20px; font-weight: bold;caption-side: top; text-align: center;" >
        <span style="font-size: 14px">
            Work details for which no charges have been applied:
            @if($start_date && $end_date)
            <span style="font-size: 14px;margin-top: 20px;color: #19BCBF">
                From {{$start_date}} to {{$end_date}}
            </span>
            @else
            <span style="font-size: 14px;margin-top: 20px;color: #19BCBF">
                From Beginning to End
            </span>
            @endif
        </span>
    </caption>
    <thead>
        <tr>
            <th style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;background: #eee;padding: 10px;width: 80px;">Date</th>
            <th style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;background: #eee;padding: 10px;">Resource</th>
            <th style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;background: #eee;padding: 10px;width: 80px;">Duration (Hrs)</th>
            @if($bill_payment == 1)
            <th style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;background: #eee;padding: 10px;">Billed</th>
            <th style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;background: #eee;padding: 10px;">Payment</th>
            @endif
            <th style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;background: #eee;padding: 10px;">Description</th>
            {{-- <th style="border-bottom:1px solid #ddd;background: #eee;padding: 10px;">Status</th> --}}
        </tr>
    </thead>
    <tbody>
        @php
            $total_hours=0;
            $total_minutes=0;
        @endphp
        @foreach($information2 as $v)
         @php
                $duration = $v->duration;
                $duration_array = explode(' ', $duration);
                $duration_hour = (int)$duration_array[0];
                $duration_min = (int)$duration_array[2];
                $total_hours +=  $duration_hour;
                $total_minutes +=  $duration_min;
         @endphp
        <tr>
           <td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 10px;">{{ date("d-m-Y", strtotime(@$v->date)) }}</td>
           <td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 10px;">{{@$v->my_technician->name}}</td>                          
           <td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 10px;">{{@$v->duration}}</td>    
           @if($bill_payment == 1)                                                       
           <td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 10px;white-space: normal; text-align: left;">{{@$v->billed_info}}</td>
           <td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 10px;white-space: normal; text-align: left;">{{@$v->payment_info}}</td>
            @endif
           <td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 10px;white-space: normal; text-align: left;">{{$v->details}}</td>
           {{-- <td style="border-bottom:1px solid #ddd;padding: 10px;">{!! ($v->status == 0)?'Pending':'Approved' !!}</td> --}}
        </tr>
        @endforeach
        @php
            $total_minutes = $total_minutes%60;
	        $total_hours += (int)$total_minutes/60;
        @endphp
        <tr>
            <td style="background: #39465C;color: #fff; padding: 10px;"></td>
            <td style="background: #39465C;color: #fff; padding: 10px;font-weight: bold;">Total : </td>
            <td style="background: #39465C;color: #fff; padding: 10px;font-weight: bold;">{{  round($total_hours). " Hrs ". $total_minutes ." Mins"}}</td>
            <td style="background: #39465C;color: #fff; padding: 10px;"></td>
            {{-- <td style="background: #39465C;color: #fff; padding: 10px;"></td> --}}
            @if($bill_payment == 1)
            <td style="background: #39465C;color: #fff; padding: 10px;"></td>
            <td style="background: #39465C;color: #fff; padding: 10px;"></td>
            @endif
        </tr>
    </tbody>
</table>
@endif
@else
    <span class="text-danger">No Data Found</span>
@endif  