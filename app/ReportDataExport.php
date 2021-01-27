<?php

namespace App;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportDataExport implements FromView
{
    protected $data = [];

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('utils.exports.reports_excel_export', $this->data);
    }
}
