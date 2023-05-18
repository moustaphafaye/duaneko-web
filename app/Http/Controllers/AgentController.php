<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agents = Agent::whereIn('role', ['agent', 'admin_agent'])->get();
        return view('dashboard.listAgents', ['agents'=>$agents]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.agents');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
    */

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'role' => ['required', 'string',],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * Create a new user instance after a valid registration.
     *
     * @param  Request  $request
     * @return \App\Models\Agent
    */
    public function store(Request $request)
    {
        $messages = [
            'email.required' => 'L\'email est requis',
            'password.required' => 'Le mot de passe est requis',
            'first_name.required' => 'Le prénom est requis',
            'last_name.required' => 'Le nom est requis',
            'role.required' => 'Le rôle est requis',
            'company_id.required' => 'La société est requise',
            'phone.required' => 'Le numéro de téléphone est requis',
        ];

        $request = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'role' => ['required', 'string',],
            'company_id' => ['required', 'string',],
            'phone' => ['required', 'string',],
        ], $messages);

        Agent::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'role' => $request['role'],
            'password' => Hash::make($request['password']),
            'company_id' =>$request['company_id']
        ]);

        return redirect()->route('agents')->with('success', 'Agent créé avec succès.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Agent $agent)
    {
        $agent = Agent::find($agent);
        return view('dashboard.showAgents', ['agent'=>$agent[0]]);
    }
    

    public function MyAgents()
    {
        // $id = Auth::user()->id
        $id_company = Auth::user()->company_id;
        // dd( $id_company);
        $mesAgents = array();
        $agent = Agent::all();
        $i = 0;
        // $articles = Agent::orderBy('created_at', 'desc')->paginate(10);
         foreach($agent as $element){
            if( $element['company_id'] == $id_company ){
                // dd($element->);
                $mesAgents[] = $element;
                
            }
        }
       
        return view('dashboard.mesagents', ['myagents'=>$mesAgents]);
    }


    public function showData(Agent $agent)
    {
        // $agent = Agent::find($agent);
        return view('updateAgents', compact('agent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agent $agent)
    {
        $messages = [
            'email.required' => 'L\'email est requis',
            'password.required' => 'Le mot de passe est requis',
            'first_name.required' => 'Le prénom est requis',
            'last_name.required' => 'Le nom est requis',
            'role.required' => 'Le rôle est requis',
            'company_id.required' => 'La société est requise',
            'phone.required' => 'Le numéro de téléphone est requis',
        ];

        $request = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string',],
        ], $messages);

        $agent->update([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
        ]);
        //  dd(Auth::user()->id );
            if(Auth::user()->role == 'admin'){
                return redirect()->route('listAgents')->with('success', 'Agent modifié avec succès.');
            }else{
                // mesagents
                return redirect()->route('mesagents')->with('success', 'Agent modifié avec succès.');
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Agent $agent)
    {
        $agent->delete();
        return redirect()->route('listAgents')->with('success', 'Agent supprimé avec succès.');
    }
}
