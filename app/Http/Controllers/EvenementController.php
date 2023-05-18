<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Company;
use App\Models\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvenementController extends Controller
{
    public function formEvenement(){
        return view('dashboard.evenement');
    }

    public function listevent(){
        $id_agent = Auth::user()->id;
        // dd($id_agent);
        $events = Evenement::all();
        // dd($events);
        $mesEvents = array();
        foreach($events as $element){
            if( $element['agent_id'] == $id_agent ){
                // dd($element->);
                $mesEvents[] = $element;
                
            }
        }

            // dd($mesEvents);
        $agents=Agent::all();
        $companies=Company::all();
        


        return view('dashboard.listEvenement', ['evenements'=>$events,'agents'=>$agents, 'companies'=>$companies ,'mesEvents'=>$mesEvents]);
    }

    

    public function creer(Request $request)
    {
        $agent_id = Auth::id(); // récupère l'id de l'agent connecté
        $agent = Agent::find($agent_id); // récupère l'objet Agent correspondant
        $company_id = $agent->company_id; // récupère l'id de la compagnie à laquelle l'agent appartient
        $company = Company::find($company_id); // récupère l'objet Company correspondant

        
        $messages = [
            'nom.required' => 'Le nom de l\'évènement est requisest requis',
            'description.required' => 'La description est requise',
            'date_evenement.required' => 'La date est requise',
            'heure_evenement.required' => 'L\'heure de l\'évènement est requis'
        ];

        $request = $request->validate([
            'nom' => ['required', 'string',],
            'description' => ['required', 'string',],
            'date_evenement' => ['required', 'date'],
            'heure_evenement' => ['required' , 'string']
        ], $messages);

        Evenement::create([
            'nom' => $request['nom'],
            'description' => $request['description'],
            'date_evenement' => $request['date_evenement'],
            'heure_evenement' => $request['heure_evenement'],
            'agent_id' => $agent_id

        ]);
        return redirect()->route('liste_evenement')->with('success', 'Évènement créé!');
    }

    public function delete(Evenement $event)
    {
        $event->delete();
        return redirect()->route('liste_evenement')->with('success', 'Évènement supprimé avec succès.');
    }

    public function update(Request $request, Evenement $event)
    {
        $agent_id = Auth::id(); // récupère l'id de l'agent connecté
        $messages = [
            'nom.required' => 'Le nom de l\'évènement est requisest requis',
            'description.required' => 'La description est requise',
            'date_evenement.required' => 'La date est requise',
            'heure_evenement.required' => 'L\'heure de l\'évènement est requis'
        ];

        $request = $request->validate([
            'nom' => ['required', 'string',],
            'description' => ['required', 'string',],
            'date_evenement' => ['required', 'date'],
            'heure_evenement' => ['required' , 'string']
        ], $messages);

        $event->update([
            'nom' => $request['nom'],
            'description' => $request['description'],
            'date_evenement' => $request['date_evenement'],
            'heure_evenement' => $request['heure_evenement'],
            'agent_id' => $agent_id
        ]);

        return redirect()->route('liste_evenement')->with('success', 'ÉvÈnement modifié avec succès.');
    }

    public function show(Evenement $event)
    {
        $event = Evenement::find($event);
        return view('dashboard.showEvenement', ['event'=>$event[0]]);
    }

}
