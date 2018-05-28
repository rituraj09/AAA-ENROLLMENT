@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Upload Excel') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('upload') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="excel_data" class="col-sm-4 col-form-label text-md-right">{{ __('Upload Excel') }}</label>

                            <div class="col-md-6">
                                <input id="excel_data" type="file" class="form-control{{ $errors->has('excel_data') ? ' is-invalid' : '' }}" name="excel_data" value="{{ old('excel_data') }}" required autofocus>

                                @if ($errors->has('excel_data'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('excel_data') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="text" class="datepicker form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" value="{{ old('date') }}" required autofocus>

                                @if ($errors->has('date'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Upload') }}
                                </button>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
