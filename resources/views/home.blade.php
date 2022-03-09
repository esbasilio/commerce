@extends('layouts.theme.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
    <h5 class="text-center mt-5">Hola <b>{{Auth()->user()->name}}</b>, Bienvenid@ al sistema <b>{{Auth()->user()->getEnityRelationship()}}</b></h5>
    <div class="text-center">
    @if(Auth()->user()->getEnityRelationship()=='Commerce')
        <img width="205" src="{{ asset('assets/img/logo.png')}}" alt="">
    @else
        <img width="205" src="{{ asset('assets/img/tienda.png')}}" alt=""> 
    @endif
    </div>
    </div>
</div>
@endsection
