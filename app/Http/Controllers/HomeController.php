<?php

namespace App\Http\Controllers;

use App\Credit;
use App\Patient;
use App\Utils;
use Carbon\Carbon;
use Hamcrest\Util;
use http\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\UtilsController as UC;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public const WIDGET_U5 = 'Clients Under 5';
    public const WIDGET_O5 = 'Clients Over 5';
    public const WIDGET_OUTSTANDING = 'Total Outstanding Debts';
    public const WIDGET_CLEARED = 'Total Cleared Debts';
    public const WIDGET_DUE = 'Debts Due Soon';
    public const WIDGET_DEBT_TREND = 'Debts Trend';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $context = [
            'dashboard_items' => [
                ['title' => self::WIDGET_OUTSTANDING, 'description' => 'Total amount of credits pending'],
                ['title' => self::WIDGET_U5, 'description' => 'Number of clients under 5 years of age'],
                ['title' => self::WIDGET_O5, 'description' => 'Number of clients over 5 years of age']
            ]
        ];
        return view('home', $context);
    }

    public function load_widget(Request $request)
    {
        switch ($item_title = $request->item_title) {
            case self::WIDGET_OUTSTANDING:
                $values = $this->DashboardTotalOutstanding();
                $v1 = $values['outstanding'];
                $v2 = number_format($values['cleared']);
                $v3 = $values['percent_outstanding'];
                $request_content = [
                    'template' => 'components.dashboard_widget',
                    'item' => json_decode($request->item),
                    'widget_variables' => [
                        'value1' => $v1,
                        'value2' => "Cleared KSH: $v2",
                        'value3' => "Pending: $v3%",
                        'prefix' => 'KSH: '
                    ]
                ];
                return UC::template_code($request_content);
            case self::WIDGET_U5:
                $clients_under = $this->DashboardPatientAgeCount()['under'];
                $all_clients = $this->DashboardPatientAgeCount()['all'];
                $percent_under = Utils::safe_divide($clients_under, $all_clients, 4) * 100;
                $request_content = [
                    'template' => 'components.dashboard_widget',
                    'item' => json_decode($request->item),
                    'widget_variables' => [
                        'value1' => $clients_under,
                        'value2' => "Patients: $all_clients",
                        'value3' => "Under 5: $percent_under%",
                    ]
                ];
                return UC::template_code($request_content);
            case self::WIDGET_O5:
                $clients_over = $this->DashboardPatientAgeCount()['over'];
                $all_clients = $this->DashboardPatientAgeCount()['all'];
                $percent_over = Utils::safe_divide($clients_over, $all_clients, 4) * 100;
                $request_content = [
                    'template' => 'components.dashboard_widget',
                    'item' => json_decode($request->item),
                    'widget_variables' => [
                        'value1' => $clients_over,
                        'value2' => "Patients: $all_clients",
                        'value3' => "Over 5: $percent_over%",
                    ]
                ];
                return UC::template_code($request_content);
            case self::WIDGET_DUE:
                $values = $this->DashboardDebtsDueSoon(2);
                $due_debts = $values['credits'];
                $total = number_format($values['amount'], 2);
                $count = number_format($values['count']);
                $request_content = [
                    'template' => 'components.dashboard_table',
                    'table' => 'components.table_credits',
                    'variables' => [
                        'credits' => $due_debts
                    ],
                    'table_heading' => "Credits Due Soon and Past Due (KSH. $total from $count credits)"
                ];
                return UC::template_code($request_content);
            default:
                return ['content' => 'Unknown widget'];
        }
    }

    function DashboardDebtsDueSoon($days = 1)
    {
        $total_due_soon = 0;
        $credits = Credit::where('cleared', false)->where('amount_due', '>', 0)->get()
            ->filter(function ($credit) use (&$total_due_soon, $days) {
                $due_date = $credit->due_date;
                $soon_date = date('Y-m-d', strtotime("+$days days"));
                if (Carbon::parse($due_date)->lt($soon_date)) {
                    $total_due_soon += $credit->amount_due;
                    return true;
                }
                return false;
            })->values();
        return [
            'credits' => $credits,
            'amount' => $total_due_soon,
            'count' => $credits->count()
        ];
    }

    function DashboardTotalOutstanding()
    {
        $outstanding = Credit::whereCleared(false)->sum('amount_due');
        $cleared = Credit::whereCleared(true)->sum('amount_due');
        $percent_outstanding = Utils::safe_divide($outstanding, $outstanding + $cleared, 4) * 100;
        return [
            'outstanding' => $outstanding,
            'cleared' => $cleared,
            'percent_outstanding' => $percent_outstanding
        ];
    }

    function DashboardPatientAgeCount()
    {
        $over = 0;
        $under = 0;
        Patient::all()->filter(function ($patient) use (&$under, &$over) {
            $patient->years < 5 ? $under += 1 : $over += 1;
            return true;
        });
        return [
            'over' => $over,
            'under' => $under,
            'all' => Patient::all()->count()
        ];
    }

    function dashboard_item_link($item_title = null)
    {
        switch ($item_title) {
            case self::WIDGET_OUTSTANDING:
                return redirect(route('credits', self::WIDGET_OUTSTANDING));
            case self::WIDGET_U5:
                return redirect(route('patients', self::WIDGET_U5));
            case self::WIDGET_O5:
                return redirect(route('patients', self::WIDGET_O5));
            default:
                return redirect(route('home'));
        }
    }
}
