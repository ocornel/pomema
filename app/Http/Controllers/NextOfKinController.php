<?php

namespace App\Http\Controllers;

use App\NextOfKin;
use Illuminate\Http\Request;

class NextOfKinController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $noks = NextOfKin::all();
        $context = [
            'noks'=> $noks
        ];
        return view('nok.index', $context);    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd("create nok here");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd('store nok here', $request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NextOfKin  $nextOfKin
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(NextOfKin $nextOfKin)
    {
        $context = [
            'nok' => $nextOfKin
        ];
        return view('nok.show', $context);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NextOfKin  $nextOfKin
     * @return \Illuminate\Http\Response
     */
    public function edit(NextOfKin $nextOfKin)
    {
        dd('edit nok here', $nextOfKin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NextOfKin  $nextOfKin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NextOfKin $nextOfKin)
    {
        dd('update nok here', $nextOfKin, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NextOfKin  $nextOfKin
     * @return \Illuminate\Http\Response
     */
    public function destroy(NextOfKin $nextOfKin)
    {
        dd('delete nok here', $nextOfKin);
    }
}
