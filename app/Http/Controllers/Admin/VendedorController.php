<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \App\Venda;

class VendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Busca todos os vendedores
        $data = \App\Vendedor::select('id', 'nome', 'email')->get();

        foreach ($data as $key => $value)
        {
            $data[$key]['comissao'] = 0;

            // Busca venda do vendedor atual do FOR
            $search_venda = Venda::where('vendedor_id', $value->id)->get();

            foreach ($search_venda as $v)
            {
                // Calculado comissao de cada vendedor
                $data[$key]['comissao'] += round($v->valor * app('App\Venda')->getComissao() / 100, 2);
            }
        }
        
        return view('admin.vendedors.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Retorna todas as props
        $data = $request->all();

        // Valida campos
        $validator = \Validator::make($data, [
            "nome" => "required",
            "email" => 'required'
        ]);

        // Caso alguma prop invalida retorna a pagina com erros encontrados
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        // Insere
        $create =\App\Vendedor::create($data);

        // Retorna objeto com as props desejadas
        $retorno = new \stdClass;
        $retorno->id = $create->id;
        $retorno->nome = $create->nome;
        $retorno->email = $create->email;

        return redirect()->back()->with('status', json_encode($retorno));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
