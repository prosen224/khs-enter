@if(count($information)>0)
<table class="table table-striped table-bordered nowrap pt-3" id="trips_table" style="width: 100%; max-width: 100%; margin: 0; border:1px solid #ddd;border-collapse: collapse;text-align: left;white-space: normal;font-size: 11px;">
    
    <caption style="margin-bottom: 10px;font-size: 24px; font-weight: bold;caption-side: top; text-align: left;" >
        <h2 style="text-align: center;">{{env("APP_NAME")}}</h2>
        <h6 style="text-align: center;font-size: 16px;margin-bottom: 0;">Report</h6>
        @if($client_name)
        <span style="font-size: 12px;">Client Name: {{@$client_name}}</span><br>
        @else
        <span style="font-size: 12px;">All Client</span><br>
        @endif
        <span style="font-size: 12px;">
        Detail description of work performed:
        @if($start_date && $end_date)
        <span style="font-size: 12px;margin-top: 5px;color: #19BCBF">
            From {{$start_date}} to {{$end_date}}
        </span>
        @else
        <span style="font-size: 12px;margin-top: 5px;color: #19BCBF">
            From Beginning to End
        </span>
        @endif
    </span>
    </caption>
    
    <thead>
        <tr>
            <th style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;background: #eee;padding: 5px;width: 70px;">Date2</th>
            <th style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;background: #eee;padding: 5px;">Resource</th>
            <th style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;background: #eee;padding: 5px;width: 80px;">Duration (Hrs)</th>
            @if($bill_payment == 1)
            <th style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;background: #eee;padding: 5px;">Billed</th>
            <th style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;background: #eee;padding: 5px;">Payment</th>
            @endif
            <th style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;background: #eee;padding: 5px;width: 300px;">Description</th>
            <!--<th style="border-bottom:1px solid #ddd;background: #eee;padding: 5px;">Status</th>-->
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
           <td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px;">{{ date("d-m-Y", strtotime(@$v->date)) }}</td>
           <td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px;">{{@$v->my_technician->name}}</td>                          
           <td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px;">{{@$v->duration}}</td>    
           @if($bill_payment == 1)                                                       
           <td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px;white-space: normal; text-align: left;">{{@$v->billed_info}}</td>
           <td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px;white-space: normal; text-align: left;">{{@$v->payment_info}}</td>
            @endif
           <td style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding: 5px;white-space: normal; text-align: left;">{{$v->details}}</td>
           <!--<td style="border-bottom:1px solid #ddd;padding: 5px;">{!! ($v->status == 0)?'Pending':'Approved' !!}</td>-->
        </tr>
        @endforeach
        @php
            $total_minutes = $total_minutes%60;
	        $total_hours += (int)$total_minutes/60;
        @endphp
        <tr>
            <td style="background: #39465C;color: #fff; padding: 5px;"></td>
            <td style="background: #39465C;color: #fff; padding: 5px;font-weight: bold;">Total : </td>
            <td style="background: #39465C;color: #fff; padding: 5px;font-weight: bold;">{{  round($total_hours). " Hrs ". $total_minutes ." Mins"}}</td>
            <td style="background: #39465C;color: #fff; padding: 5px;"></td>
            @if($bill_payment == 1)
            <td style="background: #39465C;color: #fff; padding: 5px;"></td>
            <td style="background: #39465C;color: #fff; padding: 5px;"></td>
            @endif
            <!--<td style="background: #39465C;color: #fff; padding: 5px;"></td>-->
        </tr>
    </tbody>
</table>
@else
    <span class="text-danger">No Data Found</span>
@endif  