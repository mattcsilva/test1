@extends('layouts.app')

@section('content')
    {{-- <example-component></example-component> --}}
    <tabela-component
        v-bind:cols="['ID', 'Nome', 'E-mail']"
        v-bind:items="{{$data}}"
    ></tabela-component>
@endsection