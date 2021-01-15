<?php

namespace App\Http\Controllers;

use App\candidato;
use App\linguagem;
use App\User;
use App\vaga;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\DB;

class CandidatosController extends Controller
{
    public function indexview()
    {
        $vaga = vaga::all();
        return view('auth.candidato', ['vaga' => $vaga]);
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prod = new candidato();
        $prod->candidato_id  = $request->id;
        $prod->nome = $request->nome;
        $prod->vaga_id = $request->vaga;
        $prod->vagaling_id  = $request->linguagem;
        $prod->save();
        return redirect()->route('home.candidatos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $linguagem = vaga::find($id);
        $linguagem_id = $linguagem->linguagem_id;
        echo json_encode(DB::table('linguagems')->where('id', $linguagem_id)->get());
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
