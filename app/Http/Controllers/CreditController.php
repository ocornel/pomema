<?php

namespace App\Http\Controllers;

use App\Credit;
use App\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController as HC;
use Auth;
use Illuminate\Support\Facades\Session;

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
    public function index($status_filter=null)
    {
        switch ($status_filter) {
            case HC::WIDGET_OUTSTANDING:
                $credits = Credit::all()->filter(function ($credit)  {
                    return $credit->cleared == false;
                })->values();;
                break;
            case HC::WIDGET_CLEARED:
                $credits = Credit::all()->filter(function ($credit)  {
                    return $credit->cleared == true;
                })->values();;
                break;
            case HC::CREDITS_OVERPAID:
                $credits = Credit::all()->filter(function ($credit)  {
                    return $credit->amount_due < 0;
                })->values();;
                break;
            default:
                $credits = Credit::all();
        }
        $context = [
            'status_filter'=>$status_filter,
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
            $request['cleared_by'] = Auth::user()->id;
        }
        $request['due_date'] = date_create($request['due_date']);
        $patient = Patient::find($request->patient_id);
        if ($patient->credit_due < 0) {
            $overpaid = $patient->credits->where('amount_due', '<', 0)->where('cleared', 0)->first();
            $over_amount = $overpaid->amount_due * -1;
            $overpaid ->update([
                'cleared'=>true,
                'amount_due'=>-1* $request->amount_due,
                'cleared_by' =>Auth()->user()->id,
                'cleared_on'=>now()
            ]);
            $credit = Credit::create($request->all());
            Session::flash('success', "Credit created successfully. An overpaid credit $overpaid->code has been utilized.");
            $credit->clear($over_amount);
        }
        else{
            $credit = Credit::create($request->all());
            Session::flash('success', "Credit created successfully.");
        }
        return redirect(route('show_patient', [$patient, $patient->last_name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Credit  $credit
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
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
//        We do not edit credit
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
//        dd('update credit here', $credit, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Credit $credit)
    {
//        dd('delete credit here', $credit->attributesToArray());
    }

    public function clear_credit(Request $request) {
        $credit = Credit::find($request->credit_id);
        if ($credit) {
            $amount_paid = $request->amount_paid;
            $result = $credit->clear($amount_paid);
            if ($overflow = $result['overflow'] > 0) {
                Session::flash('success', "Credit cleared successfully. An overpayment credit of $overflow created for use on next patient credit.");
            }
            elseif ($result['result'] == 'underpaid') {
                Session::flash('success', "Credit cleared. Balance used to create new credit due today.");
            }
            elseif ($result['result'] == 'cleared') {
                Session::flash('success', "Credit cleared successfully.");
            }
            return redirect(route('show_patient', [$credit->patient_id, $credit->patient->last_name]));

        }
        else Session::flash('error', "Credit you're attempting to clear not found.");
        return redirect(route('credits', HC::WIDGET_OUTSTANDING));
    }
}
