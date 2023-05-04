<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Report;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\View\View;

class DashboardController extends Controller
{

    use RegistersUsers;

    public function index(): View
    {
        // dd('ok');
        return view('dashboard.index');
    }

    public function report(): View
    {
        // TODO: Renvoyez la liste des signalements de l'entreprise.

        $reports = Report::all();
        return view('dashboard.report', compact('reports'));
    }

    public function agents(): View
    {
        $companies = Company::all();
        return view('dashboard.agents', ['companies'=>$companies]);
    }

    public function detailsReports(): View
    {
        return view('dashboard.detailsReports');
    }

    public function showReport($id)
    {
        $report = Report::findOrFail($id);
        return view('dashboard.showReport', compact('report'));
    }
}
