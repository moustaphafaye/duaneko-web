<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Report;
use App\Models\Company;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\RegistersUsers;

class DashboardController extends Controller
{

    use RegistersUsers;

    public function index(): View
    {
        // dd('ok');
        $report_done=0;
        $report_done=0;
        $report_in_progress=0;
        $reports = Report::all();
        $TCompany = Company::all();
        $TotalAgent_Admin=Agent::all();
        $agent_admin=0;
        $agent=0;
        $nombre=0;
        $totalcompanies=0;
        
        foreach($reports as $element){
            // dd($element->status= \App\Enum\ReportStatusEnum::DONE);
            if($element->status == \App\Enum\ReportStatusEnum::DONE){
                $report_done++;
            }else{
                $report_in_progress++;
            }
            $nombre++;
            
        }
        foreach($TCompany as $tagents){
            $totalcompanies++;
        }
        foreach($TotalAgent_Admin as $Total){
            if($Total->role == \App\Enum\AgentRoleEnum::ADMIN_AGENT){
                $agent_admin++;
            }else{
                $agent++;
            }
        }
        
        return view('dashboard.index',['reports'=>$reports,'totalreport'=>$nombre,'report_done'=>$report_done,
                                        'report_in_progress'=>$report_in_progress,'totalcompanies'=>$totalcompanies,
                                        'agent_admin'=>$agent_admin,'agent'=>$agent]);
        // return view('dashboard.index');
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

    public function signaller(){
        return view('dashboard.signale');
    }

    public function reportzone(){
        $reports = Report::all();
        return view('dashboard.reportzone',['reports'=>$reports]);
    }
    
}
