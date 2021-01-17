<?php

namespace App\Http\Controllers;

use App\Credit;
use App\Patient;
use Illuminate\Http\Request;
use Auth;

class CreditController extends Controller
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
        $credits = Credit::all();
        $context = [
            'credits'=> $credits
        ];
        return view('credit.index', $context);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create(Patient $patient)
    {
        $context = [
            'patient' =>$patient
        ];
        return view('credit.create', $context);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if($request['cleared'] == 1) {
            $request['cleared_on'] = now();
            $request['cleared_by'] = Auth::user()->id;
        }
        $request['due_date'] = date_create($request['due_date']);

        $credit = Credit::create($request->all());
        $patient = $credit->patient;
        return redirect(route('show_patient', [$patient, $patient->last_name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function show(Credit $credit)
    {
        $context = [
            'credit' => $credit
        ];
        return view('credit.show', $context);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function edit(Credit $credit)
    {
        dd('edit credit here', $credit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Credit $credit)
    {
        dd('update credit here', $credit, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Credit $credit)
    {
        dd('delete credit here', $credit->attributesToArray());
    }
}
