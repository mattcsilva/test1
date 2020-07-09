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

    <table-component
        :cols="['ID', 'Nome', 'E-mail', 'Comissão', 'Valor venda', 'Data venda']"
        :search="true">
    </table-component>

    <modal-component id="adicionar" title="Venda">

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