<?php

namespace App\Http\Controllers;

use App\vaga;
use Illuminate\Http\Request;

class CRUDVagaController extends Controller
{
    public function indexview()
    {
        return view('authadmin.crudvagas');
    }

    public function index()
    {
        $prods = vaga::all();
        return $prods->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prods = vaga::all();
        return $prods->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prod = new vaga();
        $prod->nome = $request->input('nome');
        $prod->linguagem_id = $request->input('linguagem_id');
        $prod->save();
        return json_encode($prod);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prod = vaga::find($id);
        if (isset($prod)) {
            return json_encode($prod);            
        }
        return response('Vaga não encontrado', 404);
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
        $prod = vaga::find($id);
        if (isset($prod)) {
            $prod->nome = $request->input('nome');
            $prod->linguagem_id = $request->input('linguagem_id');
            $prod->save();
            return json_encode($prod);
        }
        return response('Vaga não encontrado', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prod = vaga::find($id);
        if (isset($prod)) {
            $prod->delete();
            return response('OK', 200);
        }
        return response('Vaga não encontrado', 404);
    }
}
