<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use sluggable;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        return view('dashboard.listCompanies', ['companies'=>$companies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.companies');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Le nom est requis',
            'slug.required' => 'Le slug est requis',
        ];

        $request = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
        ], $messages);

        Company::create([
            'name' => $request['name'],
            'slug' => $request['slug'],
        ]);
        return redirect()->route('companies')->with('success', 'Company créée!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $company = Company::find($company);
        return view('dashboard.showCompanies', ['company'=>$company[0]]);
    }

    public function showData(Company $company)
    {
        // $company = Company::find($company);
        return view('updateCompanies', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $company = Company::find($id);
        // return view('dashboard.editCompanies', ['company'=>$company]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
          
        $company->update([
            'name' => $request['name'],
            // 'slug' => $request['slug'],
        ]);
      

        return redirect()->route('listCompanies')->with('success', 'La compagnie a été mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Company $company)
    {
        $company->delete();
        return redirect()->route('listCompanies')->with('success', 'Company supprimee!');
    }
}
