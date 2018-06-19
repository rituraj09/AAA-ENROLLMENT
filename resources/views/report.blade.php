@extends('layouts.app')

@section('content')

<div class="shadow p-3 bg-white rounded">

<form action="{{url('report')}}" method="GET" role="search">
          {{ csrf_field() }}
    <div class="row">
    <div class="col-md-4"> 
    <div class="input-group">
    <label for="staticEmail" class="col-sm-2 col-form-label">District:</label>
    <div class="col-sm-10">
   <select class="form-control" name="dist_id">
        <option value="0">--Select--</option>
    @foreach($dist as $dist)
      <option value="{{$dist->id}} " " {{ $dist->id == $request->dist_id ? 'selected="selected"' : '' }}">{{$dist->districtname}}</option>
    @endforeach
  </select> 
  </div>
  </div>
    </div>
        <div class="col-md-5">
            <div class="input-group">
                <label for="staticEmail" class="col-sm-4 col-form-label">Report as On:</label>
                    <div class="col-sm-8">
                    <input id="date" type="text" autocomplete="off" 
                class="datepicker form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" 
                name="q" value="{{ $request->q }}">
                            
                    </div>
            </div>
        </div>
        <div class="col-md-2">
        <span class="input-group-btn">
              <button type="submit" class="btn btn-info"> Search
              </button>
              </span>
        </div>
        </div>
    </form>
    
@if(count($enrollment) > 0) 

<?php $i=1; $bpl=0; $apl=0; $minor=0; $tot=0; $card=0;?>
    <div class="row p-2">
        <div class="col-md-12">
            <table class="table table-bordered">
                <tr>
                    <th> SlNo.</th>
                    <th> District </th>
                    <th> BPL SCSP Enrolled</th>
                    <th> APL SCSP Enrolled</th>
                    <th> Minor SCSP Enrolled</th>
                    <th> Total Enrolled</th>
                    <th> Card Issued</th>
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
                    <td align="right">
                        {{  $enroll->bpl_scsp_enrolled }}      
                      <input type="hidden" val="{{ $bpl += $enroll->bpl_scsp_enrolled }}">      
                    </td>
                    <td align="right">
                        {{ $enroll->apl_scsp_enrolled }}
                      <input type="hidden" val="{{ $apl += $enroll->apl_scsp_enrolled }}">   
                    </td>
                    <td align="right">
                        {{ $enroll->minor_scsp_enrolled }}
                      <input type="hidden" val="{{ $minor += $enroll->minor_scsp_enrolled }}">   
                    </td>
                    <td align="right">
                        {{ $enroll->total_enrolled }}
                      <input type="hidden" val="{{ $tot += $enroll->total_enrolled }}">   
                    </td>
                    <td align="right">
                        {{ $enroll->scsp_card_issued }}
                      <input type="hidden" val="{{ $card += $enroll->scsp_card_issued }}">   
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
                <tr>
                    <td>
                    </td>                    
                    <td>
                    <b>Total</b>
                    </td>                    
                    <td align="right">
                    <b><?php echo $bpl;?></b>
                    </td>                    
                    <td align="right">
                    <b><?php echo $apl;?></b>
                    </td>                    
                    <td align="right">
                    <b><?php echo $minor;?></b>
                    </td>                    
                    <td align="right">
                    <b><?php echo $tot;?></b>
                    </td>     
                    <td align="right">
                    <b><?php echo $card;?></b>
                    </td>                 
                    <td>
                    </td>                    
                    <td>
                    </td>
                </tr>
            </table>
        </div> 
    </div>
</div>
@endif
@endsection