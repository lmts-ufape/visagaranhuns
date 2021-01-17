<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use App\AreaTipodocemp;
use App\AreaTipodocresp;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Listagem de todas as areas
        $areas = Area::orderBy('nome', 'ASC')->paginate(50);
        return view('coordenador/areas_coordenador', ['areas' => $areas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Redireciona para página de cadastro de área
        return view('area.cadastro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = $request->validate([
            'nomeArea' => 'required|string',
        ]);

        $area = Area::create([
            'nome' => $request->nomeArea,
        ]);

        foreach ($request->tipos as $key) {
            $areaTipoDocEmp = AreaTipodocemp::create([
                'area_id'       => $area->id,
                'tipodocemp_id' => $key,
            ]);
        }

        $areaTipoDocEmp = AreaTipodocresp::create(['area_id' => $area->id, 'tipodocresp_id'=> "1",]);
        $areaTipoDocEmp = AreaTipodocresp::create(['area_id' => $area->id, 'tipodocresp_id'=> "2",]);
        $areaTipoDocEmp = AreaTipodocresp::create(['area_id' => $area->id, 'tipodocresp_id'=> "3",]);
        $areaTipoDocEmp = AreaTipodocresp::create(['area_id' => $area->id, 'tipodocresp_id'=> "4",]);
        $areaTipoDocEmp = AreaTipodocresp::create(['area_id' => $area->id, 'tipodocresp_id'=> "5",]);
        $areaTipoDocEmp = AreaTipodocresp::create(['area_id' => $area->id, 'tipodocresp_id'=> "6",]);
        $areaTipoDocEmp = AreaTipodocresp::create(['area_id' => $area->id, 'tipodocresp_id'=> "7",]);
        $areaTipoDocEmp = AreaTipodocresp::create(['area_id' => $area->id, 'tipodocresp_id'=> "8",]);
        $areaTipoDocEmp = AreaTipodocresp::create(['area_id' => $area->id, 'tipodocresp_id'=> "9",]);
        $areaTipoDocEmp = AreaTipodocresp::create(['area_id' => $area->id, 'tipodocresp_id'=> "10",]);

        session()->flash('success', 'Área foi cadastrada!');
        return back();
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
