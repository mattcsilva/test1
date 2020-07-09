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
        return view('admin.vendas.index');
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

        Venda::create($data);

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
        // return Venda::where('vendedor_id', $id)->get();
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

    /**
     * Show vendas de um vendedor
     * 
     * @param int $vendedor_id
     * @return array
     */
    public function show_vendas($vendedor_id)
    {
        $data = [];
        
        $vendedor = \App\Vendedor::find($vendedor_id);
        $vendas = Venda::where('vendedor_id', $vendedor_id)->get();        

        foreach ($vendas as $key => $value)
        {
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

        return $data;
    }
}
