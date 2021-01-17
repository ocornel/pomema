<?php

namespace App\Http\Controllers;

use App\NextOfKin;
use App\Patient;
use App\PatientNok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
            'noks' => $noks
        ];
        return view('nok.index', $context);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param null $nok_id
     * @param Patient|null $patient
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create($nok_id = null, Patient $patient = null, $is_primary=false)
    {
        $context = [
            'patient' => $patient,
            'nok_id' => $nok_id,
            'is_primary'=>$is_primary
        ];
        return view('nok.create', $context);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request['dob'] = date_create($request['dob']);
        $nok = NextOfKin::create($request->all());
        $pid = $request['patient_id'];
        if ($pid !=null) {
            foreach (PatientNok::wherePatientId($pid)->get() as $pnok) {
                $pnok->update(['is_primary'=>false]);
            }
            PatientNok::create([
                'patient_id' => $pid,
                'nok_id' => $nok->id,
                'created_by' => $request['created_by'],
                'is_primary' => $request['is_primary']
            ]);
        }
        Session::flash('success', 'Nex of Kin created');
        return redirect(route('noks'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\NextOfKin $nok
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
     * @param \App\NextOfKin $nok
     * @return \Illuminate\Http\Response
     */
    public function edit(NextOfKin $nok)
    {
        dd('edit nok here', $nok->attributesToArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\NextOfKin $nok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NextOfKin $nok)
    {
        dd('update nok here', $nok->attributesToArray(), $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\NextOfKin $nok
     * @return \Illuminate\Http\Response
     */
    public function destroy(NextOfKin $nok)
    {
        dd('delete nok here', $nok->attributesToArray());
    }

    public function associate_patient(NextOfKin $nok)
    {
        dd('Associate Next of Kin to existing or new Patient', $nok->attributesToArray());
    }
}
