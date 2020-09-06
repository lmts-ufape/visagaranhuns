<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inspetor;
use App\User;
use Illuminate\Support\Facades\Auth;

class InspetorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listarInspetores()
    {
        $inspetores = Inspetor::all();
        return view('home', [ 'inspetores'  => $inspetores ]);
    }

    public function home()
    {
        return view('inspetor.home_inspetor');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Definir tela para cadastro de inspetor
        return view('inspetor.cadastro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::find(Auth::user()->id);
        
        $validator = $request->validate([
            'nome'     => 'required|string',
            'formacao' => 'required|string',
            'especializacao' => 'required|string',
            'password'       => 'required',
        ]);

        // Atualiza dados de user para inspetor
        $user->name = $request->nome;
        $user->password = bcrypt($request->password);
        $user->save();

        $inspetor = Inspetor::create([
            'formacao'       => $request->formacao,
            'especializacao' => $request->especializacao,
            'user_id'        => $user->id,
        ]);


        return redirect()->route('home');
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
