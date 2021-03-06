<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Home
Route::get('/home', 'HomeController@index')->name('home');

// Mail
Route::middleware(['auth'])->get('/send-mail', function () {

    $total = "0";
    $quantidade = "0";

    $vendas = \App\Venda::select(DB::raw('DATE(created_at) as date, SUM(valor) as total'), DB::raw('count(*) as vendas'))->whereRaw('Date(created_at) = CURDATE()')->groupBy('date')->get();

    if(sizeof($vendas) > 0)
    {
        $total = strval($vendas[0]['total']);
        $quantidade = strval($vendas[0]['vendas']);
    }

    $request = [
        'title' => 'Relatório de vendas do dia atual',
        'body' => 'Quantidade de vendas: ' . $quantidade . ' | Soma de vendas: ' . $total
    ];

    Mail::to("matheuscabralsilva95@gmail.com")->send(new \App\Mail\sendMail($request));

    return view("emails.sucesso");
});

// All
Route::middleware(['auth'])->prefix('admin')->namespace('Admin')->group(function(){
    Route::resource('vendedors', 'VendedorController');
    Route::resource('vendas', 'VendaController');
    Route::get('/vendas/vendedors/{vendedor_id}', 'VendaController@show_vendas')->name('vendas_vendedors.show_vendas');
});