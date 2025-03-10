<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Justi_retardo_sociale;
use Illuminate\Http\Request;

class justiRetardoSocialeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $justificado = Justi_retardo_sociale::with('expedienteDisciplinario')->get();
        return view('justi_retardo_sociale.index', compact('justificado'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $matricula = Alumno::all();
        return view('justi_retardo_sociale.create', compact('matricula'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
