@extends('master')

@section('content')
    <div class="container-fluid d-flex px-0">
        <div class="col-4">
            @include('partials.fields')
        </div>

        <div class="col-8">
            @include('partials.calendar')
        </div>
    </div>    
@endsection
