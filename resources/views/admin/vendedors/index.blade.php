@extends('layouts.app')

@section('content')

    @if($errors->all())
        <div class="text-center">
            @foreach ($errors->all() as $item)
                <li>{{$item}}</li>
            @endforeach
        </div>
    @endif

    @if (session('status'))
        <div class="text-center alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    
    <div class="container pb-3">
        <button-open-modal-component
            target="adicionar"
            name="Adicionar">
        </button-open-modal-component>
    </div>

    <table-component
        v-bind:cols="['ID', 'Nome', 'E-mail', 'Comissão']"
        v-bind:items="{{$data}}">
    </table-component>

    <modal-component id="adicionar" title="Vendedor">

        <form-component id="formAdicionar" url="{{ route('vendedors.store') }}" token="{{csrf_token()}}">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Insira o nome...">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Insira o e-mail...">
            </div>
        </form-component>

        <slot slot="adicionar">
            <button class="btn btn-primary" form="formAdicionar">Adicionar</button>
        </slot>

    </modal-component>

@endsection