@extends('layouts.app')

@section('content')

@if(count($enrollment) > 0) 
<?php $i=1;?>
<div class="shadow p-3 bg-white rounded">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <tr>
                    <th> SlNo.</th>
                    <th> District </th>
                    <th> BPL SCSP Enrolled</th>
                    <th> APL SCSP Enrolled</th>
                    <th> Minor SCSP Enrolled</th>
                    <th> Total Enrolled</th>
                    <th> Report As On</th>
                    <th></th>
                </tr>
                @foreach( $enrollment as $enroll)
                <tr>
                    <td>  	
                    <?php echo $i;?>
                    </td>
                    <td>
                     
                      {{ $enroll->district->districtname }}  
                    </td>
                    <td>
                        {{ $enroll->bpl_scsp_enrolled }}            
                    </td>
                    <td>
                        {{ $enroll->apl_scsp_enrolled }}
                    </td>
                    <td>
                        {{ $enroll->minor_scsp_enrolled }}
                    </td>
                    <td>
                        {{ $enroll->total_enrolled }}
                    </td>
                    <td>
                        {{ date('d-m-Y', strtotime($enroll->reportdate))}}
                    </td>
                    <td align="center">
                    <a href="{{ url('report/'.$enroll->id ) }}" class="btn btn-sm btn-info">View</a>
                    </td>
                </tr>
                <?php $i++;?>
                @endforeach  
            </table>
        </div> 
    </div>
</div>
@endif
@endsection