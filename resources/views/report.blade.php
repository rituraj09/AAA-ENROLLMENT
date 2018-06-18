@extends('layouts.app')

@section('content')
<table class="table table-bordered">
<tr>
<th> SlNo.</th>
<th> District </th>
<th> bpl_scsp_enrolled</th>
<th> apl_scsp_enrolled</th>
<th> minor_scsp_enrolled</th>
<th> total_enrolled</th>
</tr>
@forach( $enrollment as $enroll)
<tr>
<td> 
{{ $enroll-> }}	
</td>
<td>
</td>
<td>
	
</td>
<td>
	
</td>
</tr>
</table>
@endsection