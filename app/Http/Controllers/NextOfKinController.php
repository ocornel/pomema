<?php

namespace App\Http\Controllers;

use App\NextOfKin;
use App\Patient;
use App\PatientNok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\UtilsController as UC;
use Auth;

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
    public function create($nok_id = null, Patient $patient = null, $is_primary = false)
    {
        $context = [
            'patient' => $patient,
            'nok_id' => $nok_id,
            'is_primary' => $is_primary
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
        if ($pid != null) {
            foreach (PatientNok::wherePatientId($pid)->get() as $pnok) {
                $pnok->update(['is_primary' => false]);
            }
            PatientNok::create([
                'patient_id' => $pid,
                'nok_id' => $nok->id,
                'created_by' => $request['created_by'],
                'is_primary' => $request['is_primary']
            ]);
            Session::flash('success', 'Contact person created and associated successfully.');
            $patient = Patient::find($pid);
            return redirect(route('show_patient', [$patient, $patient->last_name]));
        }
        Session::flash('success', 'Next of Kin created successfully.');
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(NextOfKin $nok)
    {
        $context = [
            'nok' => $nok
        ];
//        dd('edit nok here', $nok->attributesToArray());
        return view('nok.create', $context);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\NextOfKin $nok
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, NextOfKin $nok)
    {
        $request['dob'] = date_create($request['dob']);
        $nok->update($request->all());
        Session::flash('success', 'Next of Kin updated successfully.');
        return redirect(route('show_nok', $nok));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\NextOfKin $nok
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(NextOfKin $nok)
    {
        $nok->delete();
        Session::flash('success', 'Next of Kin Deleted');
        return  redirect(route('noks'));
    }

    public function associate_patient(NextOfKin $nok)
    {
        $context = [
            'nok'=>$nok
        ];
        return view('patient.associate_patient', $context);    }

    public function nok_patient_association(Request $request)
    {
        $origin = $request->origin;
        $origin_id = $request->origin_id;
        $other_id = $request->other_id;
        if ($origin == 'patient') {
            $pid = $origin_id;
            $nid = $other_id;
        } else {
            $nid = $origin_id;
            $pid = $other_id;
        }

        $patient = Patient::find($pid);
        $nok = NextOfKin::find($nid);
        if ($pid == 0 or $nid == 0) {
            if ($patient) {
                return $this->render_assoc_component($origin_id);
            }
            if ($nok) {
                return $this->render_assoc_component($origin_id, 'nok');
            }
        } else {
            $this->update_association($pid, $nid);
            return $this->render_assoc_component($origin_id, $origin);
        }
    }

    public function render_assoc_component($candidate_id, $origin = 'patient')
    {
        if ($origin == 'patient') {
            $candidate = Patient::find($candidate_id);
            $associated = $candidate->noks;
        } else {
            $candidate = NextOfKin::find($candidate_id);
            $associated = $candidate->patients;
        }
        $associated_ids = [];
        foreach ($associated as $a) {
            array_push($associated_ids, $a->id);
        }

        if ($origin == 'patient') {
            $other = NextOfKin::all()->filter(function ($nok) use ($associated_ids) {
                return !in_array($nok->id, $associated_ids);
            });
        } else {
            $other = Patient::all()->filter(function ($patient) use ($associated_ids) {
                return !in_array($patient->id, $associated_ids);
            });
        }

        $request_content = [
            'template' => 'components.patient_nok_association',
            'associated' => $associated,
            'candidate_id' => $candidate->id,
            'origin' => $origin,
            'other' => $other
        ];
        return UC::template_code($request_content);
    }

    public function update_association($patient_id, $nok_id)
    {
        if ($pnok = PatientNok::wherePatientId($patient_id)->whereNokId($nok_id)->first()) {
            $pnok->delete();
        } else {
            PatientNok::create([
                'patient_id' => $patient_id,
                'nok_id' => $nok_id,
                'created_by' => Auth::user()->id]);
        }
        return true;
    }
}
