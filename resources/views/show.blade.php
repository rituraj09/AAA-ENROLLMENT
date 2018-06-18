@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-2">&nbsp;</div>
    <div class="col-md-8">
    <div class="col-md-12  p-1">
    <a href="{{ url('report')}}" class="btn btn-sm btn-primary">Back</a>
    </div>
        <div class="shadow p-3 mb-5 bg-white rounded">
            <div class="row p-1">
                <div class="col-md-4">
                    <b>District Name:</b>
                </div>
                <div class="col-md-6">
                    {{ $enroll->district->districtname}}
                </div>
            </div>
            <div class="row p-1">
                <div class="col-md-4">
                    <b>TPA Name:</b>
                </div>
                <div class="col-md-6">
                {{ $enroll->atalvendors->name }}  
                </div>
            </div>
            <div class="row p-1">
                <div class="col-md-4">
                    <b>Vendor Name:</b>
                </div>
                <div class="col-md-6"> 
                {{ $enroll->tpa->name }}  
                </div>
            </div>
            <div class="row p-1">
                <div class="col-md-4">
                    <b>Targeted Persons:</b>
                </div>
                <div class="col-md-6">
                    {{ $enroll->targeted_persons }}
                </div>
            </div>
            <div class="row p-1">
                <div class="col-md-4">
                    <b>No. of Kits deployed:</b>
                </div>
                <div class="col-md-6">
                    {{ $enroll->number_of_kits_deployed }}
                </div>
            </div>
            <div class="row p-1">
                <div class="col-md-4">
                    <b>BPL SCSP Enrolled:</b>
                </div>
                <div class="col-md-6">
                    {{ $enroll->bpl_scsp_enrolled }}
                </div>
            </div>
            <div class="row p-1">
                <div class="col-md-4">
                    <b>BPL District Kiosk Enrolled:</b>
                </div>
                <div class="col-md-6">
                    {{ $enroll->bpl_district_kiosk_enrolled }}
                </div>
            </div>
            <div class="row p-1">
                <div class="col-md-4">
                    <b>APL SCSP Enrolled:</b>
                </div>
                <div class="col-md-6">
                    {{ $enroll->apl_scsp_enrolled }}
                </div>
            </div>
            <div class="row p-1">
                <div class="col-md-4">
                    <b>APL District Kiosk Enrolled:</b>
                </div>
                <div class="col-md-6">
                    {{ $enroll->apl_district_kiosk_enrolled }}
                </div>
            </div>
            <div class="row p-1">
                <div class="col-md-4">
                    <b>Minor SCSP Enrolled:</b>
                </div>
                <div class="col-md-6">
                    {{ $enroll->minor_scsp_enrolled }}
                </div>
            </div>
            <div class="row p-1">
                <div class="col-md-4">
                    <b>Minor District Kiosk Enrolled:</b>
                </div>
                <div class="col-md-6">
                    {{ $enroll->minor_district_kiosk_enrolled }}
                </div>
            </div>
            <div class="row p-1">
                <div class="col-md-4">
                    <b>Total Enrolled:</b>
                </div>
                <div class="col-md-6">
                    {{ $enroll->total_enrolled }}
                </div>
            </div>
            <div class="row p-1">
                <div class="col-md-4">
                    <b>SCSP Card Issued:</b>
                </div>
                <div class="col-md-6">
                    {{ $enroll->scsp_card_issued }}
                </div>
            </div>
            <div class="row p-1">
                <div class="col-md-4">
                    <b>District kiosk Card Issued:</b>
                </div>
                <div class="col-md-6">
                    {{ $enroll->district_kiosk_card_issued }}
                </div>
            </div>
            <div class="row p-1">
                <div class="col-md-4">
                    <b>Fee collected from APL:</b>
                </div>
                <div class="col-md-6">
                    {{ $enroll->fee_collected_from_apl }}
                </div>
            </div>
            <div class="row p-1">
                <div class="col-md-4">
                    <b>Report Date:</b>
                </div>
                <div class="col-md-6">
                    {{ $enroll->reportdate }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection