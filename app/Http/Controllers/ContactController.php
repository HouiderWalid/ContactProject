<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Societe;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();
        if($contacts) {
            return view('contactPage', ['contacts' => $contacts]);
        }else {
            return abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $societes = Societe::all();
        if($societes) {
            return view('addContactPage', ['societes' => $societes]);
        }else {
            return abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {

            $societe = Societe::find($request->societe_id);

            if(!$societe || empty($societe)) {
                return response()->json(['code' => 404, 'messages' => 'La Société est introuvable.']);
            }

            $contact_validation = Validator::make($request->all(),[
                'contact_civilite'       => 'max:255',
                'contact_prenom'         => 'required|min:3|max:12|max:255',
                'contact_nom'            => 'required|unique:contacts||min:3|max:12|max:255',
                'contact_fonction'       => 'min:3|max:50|max:255',
                'contact_service'        => 'min:3|max:50|max:255',
                'contact_e_mail'         => 'required|email|unique:contacts|max:255',
                'contact_telephone'      => 'unique:contacts|min:10|max:20',
                'contact_date_naissance' => 'date'
            ]);

            if($contact_validation->fails()) {
                return response()->json(['code' => 400, 'messages' => $contact_validation->errors()]);
            }

            $contact = new Contact($request->all());

            $contact->contact_prenom = title_case($contact->contact_prenom);
            $contact->contact_nom    = title_case($contact->contact_nom);

            if(!$contact->save()) {
                return response()->json(['code' => 500, 'messages' => 'Une Erreur survenu lors du sauvegarde.']);
            }

            return response()->json(['code' => 200, 'messages' => 'Le Contact a bien été sauvgarder.']);

        }else {
            return abort(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::find($id);
        if($contact) {
            return view('viewContactPage', ['contact' => $contact]);
        }else {
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::find($id);
        $societes = Societe::all();
        if($contact && $societes) {
            return view('editContactPage', ['contact' => $contact, 'societes' => $societes]);
        }else {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->ajax()) {

            $contact = Contact::find($id);

            if(!$contact || empty($contact)) {
                return response()->json(['code' => 404, 'messages' => 'Le Contact est introuvable.']);
            }

            $societe = Societe::find($request->societe_id);

            if(!$societe || empty($societe)) {
                return response()->json(['code' => 404, 'messages' => 'La Société est introuvable.']);
            }

            $contact_validation = Validator::make($request->all(),[
                'contact_civilite'       => 'max:255',
                'contact_prenom'         => 'required|min:3|max:12|max:255',
                'contact_nom'            => ['required', Rule::unique('contacts')->ignore($contact->contact_id, 'contact_id'), 'min:3', 'max:12', 'max:255'],
                'contact_fonction'       => 'min:3|max:50|max:255',
                'contact_service'        => 'min:3|max:50|max:255',
                'contact_e_mail'         => ['required', 'email', Rule::unique('contacts')->ignore($contact->contact_id, 'contact_id'), 'max:255'],
                'contact_telephone'      => [Rule::unique('contacts')->ignore($contact->contact_id, 'contact_id'), 'min:10', 'max:20'],
                'contact_date_naissance' => 'date'
            ]);

            if($contact_validation->fails()) {
                return response()->json(['code' => 400, 'messages' => $contact_validation->errors()]);
            }

            $contact->contact_civilite       = $request->contact_civilite;
            $contact->contact_prenom         = title_case($request->contact_prenom);
            $contact->contact_nom            = title_case($request->contact_nom);
            $contact->societe_id             = $request->societe_id;
            $contact->contact_fonction       = $request->contact_fonction;
            $contact->contact_service        = $request->contact_service;
            $contact->contact_e_mail         = $request->contact_e_mail;
            $contact->contact_telephone      = $request->contact_telephone;
            $contact->contact_date_naissance = $request->contact_date_naissance;

            if(!$contact->isDirty()) {
                return response()->json(['code' => 200, 'messages' => 'Vous n\'avez rien modifier !']);
            }

            if(!$contact->save()) {
                return response()->json(['code' => 500, 'messages' => 'Une Erreur survenu lors du sauvegarde.']);
            }

            return response()->json(['code' => 200, 'messages' => 'Le Contact a bien été sauvgarder.']);

        }else {
            return abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        if(!$contact || empty($contact)) {
            return response()->json(['code' => 404, 'messages' => 'Le Contact est introuvable.']);
        }

        if($contact->delete()) {
            return response()->json(['code' => 200, 'messages' => 'Le Contact a bien été supprimer.']);
        }else {
            return response()->json(['code' => 500, 'messages' => 'Une Erreur survenu lors du suppression.']);
        }
    }
}
