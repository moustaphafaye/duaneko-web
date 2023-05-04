<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportStoreRequest;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    // TODO: Ici c'est l'api pour l'utilisateur qui est connecter.
    public function reportStore(ReportStoreRequest $request)
    {

        $imageName=Str::random(32).".".$request->image->getClientOriginalExtension();
        $report=Report::create(
            array_merge(
            $request->validated() + ['user_id'=>auth()->id()],
               [
                    'image' => $imageName,
               ]
               )
        );
        Storage::disk('public')->put($imageName,file_get_contents($request->image));
        return response()->json(
            [
                'message' => "signalement inserer avec succes",
                'report'=>$report
            ],
            201
        );

    }

    // TODO: Ici c'est l'api pour l'utilisateur qui n'est pas connecter.
    public function reportPublicStore(ReportStoreRequest $request)
    {
        $imageName=Str::random(32).".".$request->image->getClientOriginalExtension();
        $report=Report::create(
            array_merge(
            $request->validated() ,
               [
                    'image' => $imageName,
               ]
               )
        );
        Storage::disk('public')->put($imageName,file_get_contents($request->image));
        return response()->json(
            [
                'message' => "signalement inserer avec succes",
                'report'=>$report
            ],
            201
        );

    }

    public function getReportStore() {
        $reports = Report::all();
        return response()->json(
            [
                'message' => "Listes de signalements",
                'reports'=>$reports
            ],
            200
        );
    }
}
