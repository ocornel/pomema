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
     * @param  \App\NextOfKin  $nok
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(NextOfKin $nok)
    {
        $context = [
            'nok' => $nok
        ];
        return view('nok.show', $context);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NextOfKin  $nok
     * @return \Illuminate\Http\Response
     */
    public function edit(NextOfKin $nok)
    {
        dd('edit nok here', $nok->attributesToArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NextOfKin  $nok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NextOfKin $nok)
    {
        dd('update nok here', $nok->attributesToArray(), $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NextOfKin  $nok
     * @return \Illuminate\Http\Response
     */
    public function destroy(NextOfKin $nok)
    {
        dd('delete nok here', $nok->attributesToArray());
    }
}
