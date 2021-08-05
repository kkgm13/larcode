@extends('layout')
@section('content')
<div id="app">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <meeting-component></meeting-component>
            </div>
            <div class="col-4">
                <addform-component></addform-component>
            </div>
        </div>
    </div>
</div>
@endsection