<?php

namespace App\Http\Controllers;

use App\NextOfKin;
use App\Patient;
use App\PatientNok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class PatientController extends Controller
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
        $patients = Patient::all();
        $context = [
            'patients' => $patients
        ];
        return view('patient.index', $context);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('patient.create');
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
        $nok_id = $request['p_nok_id'];
        $patient = Patient::create($request->all());
        Session::flash('success', 'Patient created');
        $nok = NextOfKin::where('id_number', $nok_id)->first();
        if ($nok) {
            PatientNok::create([
                'patient_id' => $patient->id,
                'nok_id' => $nok->id,
                'created_by' => $patient->created_by,
                'is_primary' => true
            ]);
            return redirect(route('patients'));
        } else
//            redirect to creating nok with this id number
            $nok_context = [
                'patient' => $patient,
                'nok_id' => $nok_id,
                'is_primary'=>true
            ];
        return redirect(route('create_nok', $nok_context));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Patient $patient
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Patient $patient)
    {
        $context = [
            'patient' => $patient
        ];
        return view('patient.show', $context);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Patient $patient
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Patient $patient)
    {
        $context = [
            'patient' => $patient
        ];
        return view('patient.create', $context);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Patient $patient
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Patient $patient)
    {
        $request['dob'] = date_create($request['dob']);
        $nok_id = $request['p_nok_id'];
        $patient->update($request->all());
        $nok = NextOfKin::where('id_number', $nok_id)->first();
        if ($nok) {
            foreach (PatientNok::where('patient_id', $patient->id)->get() as $pnok) {
                $pnok->update(['is_primary' => false]);
            }
            PatientNok::updateOrCreate([
                'patient_id' => $patient->id,
                'nok_id' => $nok->id],
                [
                    'created_by' => Auth::user()->id,
                    'is_primary' => true
                ]);
            Session::flash('success', 'Patient created.');
            return redirect(route('show_patient', [$patient, $patient->last_name]));
        } else
//            redirect to creating nok with this id number
            $nok_context = [
                'patient' => $patient,
                'nok_id' => $nok_id,
                'is_primary'=>true
            ];
        return redirect(route('create_nok', $nok_context));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        dd('delete patient here', $patient->attributesToArray());
    }

    public function associate_nok(Patient $patient)
    {
        dd('Associate Patient to existing or new Contact Person', $patient->attributesToArray());
    }
}
