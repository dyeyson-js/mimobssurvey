@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8" style="min-height:400px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header">
                            <h3 class="text-center">SEDPI Online Survey</h3>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('survey.mimopbs') }}">Money In Money Out - Personal Balance Sheet Survey</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
            </div>
        </div>
    </div>
@endsection