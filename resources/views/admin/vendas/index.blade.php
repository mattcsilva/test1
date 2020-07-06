@extends('layouts.app')

@section('content')

    @if($errors->all())
        @foreach ($errors->all() as $item)
            <li>{{$item}}</li>
        @endforeach
    @endif
    
    <button-open-modal-component
        target="adicionar"
        name="Adicionar">
    </button-open-modal-component>

    <table-component
        v-bind:cols="['ID', 'Nome', 'E-mail', 'Comissão', 'Valor venda', 'Data venda']"
        v-bind:items="{{$data}}">
    </table-component>

    <modal-component id="adicionar" title="Adicionar">

        <form-component id="formAdicionar" url="{{ route('vendas.store') }}" token="{{csrf_token()}}">
            <div class="form-group">
                <label for="vendedor_id">ID Vendedor</label>
                <input type="text" class="form-control" id="vendedor_id" name="vendedor_id" placeholder="Insira a ID do vendedor...">
            </div>
            <div class="form-group">
                <label for="valor">Valor da venda</label>
                <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" id="valor" name="valor" placeholder="Inseira um valor...">
            </div>
        </form-component>

        <slot slot="adicionar">
            <button class="btn btn-primary" form="formAdicionar">Adicionar</button>
        </slot>

    </modal-component>

@endsection