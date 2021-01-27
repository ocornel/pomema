<?php

namespace App\Http\Controllers;

use App\Patient;
use App\ReportDataExport;
use Illuminate\Http\Request;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\View;
use PDF;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function patient_credit(Patient $patient, $format = null)
    {
        $context = [
            'report_title' => "Credit Report for $patient->full_name",
            'report_summary' => ['Pending' => number_format($patient->credit_due, 2),
                'Cleared' => number_format($patient->credit_cleared, 2),
                'Total' => number_format($patient->credit_total, 2)
            ],
            'report_data' => [
                'patient' => $patient,
                'credits' => $patient->credits
            ]
        ];

        if (!$format) {
            return view('utils.reports.patient_credit_report', $context);
        } elseif ($format == 'PDF') {
            $pdf = PDF::loadView('utils.reports.pdfs.patient_credit_report', $context);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream($context['report_title'] . " " . now()->format("Y_m_d_his"));
        } elseif ($format == 'XLS') {
            $table = View::make('components.table_credits', $context['report_data'])->render();
            $name = $context['report_title'];

            $excel_data = [
                'name' => $name,
                'user' => Auth::user(),
                'table' => $table,
            ];
            $excel_data += $context;
            $excel = Excel::download(new ReportDataExport($excel_data), $name . date('d_m_Y__Hi') . '.xlsx');;
            return $excel;
        } else {
            Session::flash('error', 'No Option provided');
            return redirect()->back();
        }
    }
}
