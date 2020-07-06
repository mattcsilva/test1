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
        $lista = [];
        $data = Venda::select('id', 'valor', 'created_at', 'vendedor_id')->get();

        foreach ($data as $key => $value) {
            $vendedor = \App\Vendedor::find($value->vendedor_id);

            $obj = new stdClass;
            $obj['id'] = $vendedor->id;
            $obj['nome'] = $vendedor->nome;
            $obj['email'] = $vendedor->email;
            $obj['comissao'] = 0;
            $obj['valor'] = $data[$key]['valor'];
            $obj['data'] = $data[$key]['created_at'];
        }

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

        $validator = \Validator::make($data, [
            "vendedor_id" => "required",
            "valor" => "required"
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErros($validator);
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
