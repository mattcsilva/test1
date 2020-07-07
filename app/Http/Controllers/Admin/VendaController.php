<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Venda;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $lista = Venda::select('id', 'valor', 'created_at', 'vendedor_id')->get();

        foreach ($lista as $key => $value)
        {
            $vendedor = \App\Vendedor::find($value->vendedor_id);

            $obj = new \stdClass;
            $obj->id = $value->id;
            $obj->nome = $vendedor->nome;
            $obj->email = $vendedor->email;
            $obj->comissao = round($value->valor * app('App\Venda')->getComissao() / 100, 2);
            $obj->valor = $value->valor;
            $obj->data = $value->created_at;

            array_push($data, $obj);
        }

        $data = json_encode($data);

        return view('admin.vendas.index', compact('data'));
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
        $data = $request->all();

        /*$existsVendedor = \App\Vendedor::find($data['vendedor_id']);
        if(!$existsVendedor)
        {
            $data['vendedor_id'] = false;
        }*/

        $validator = \Validator::make($data, [
            "vendedor_id" => [
                "required",
                'exists:vendedors,id'
            ],
            "valor" => "required"
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        \App\Venda::create($data);

        return redirect()->back();
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
