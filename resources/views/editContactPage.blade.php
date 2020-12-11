@extends('dashboard')

@section('dashboard_body')
    <div class="container">
        <h1 class="container-fluid py-5 text-center">Modifier un Contact</h1>
        <div class="contact_view_page border p-3 shadow-sm">
            <div id="alert_scroll_dest" class="d-none contact_alert alert alert-danger alert-dismissible fade show" role="alert">
                <p class="contact_alert_text m-0"></p>
                <button type="button" class="close pt-2 pr-3" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="contact_view_header d-flex flex-row align-items-end">
                <h2>{{ $contact->contact_prenom }}&nbsp;{{ $contact->contact_prenom }}<small class="text-muted ml-3">Contact</small></h2>
            </div>
            <div class="dropdown-divider mt-0"></div>
            <div class="contact_view_content d-flex justify-content-start flex-row flex-flow">
                <div class="container border border-secondary mr-2 my-2 p-3 thick-border-left">
                    <h4 class="cursor-pointer">Identité du contact</h4>
                    <div class="form-group">
                        <legend class="col-form-label font-weight-bold">Civilité</legend>
                        <div class="form-check form-check-inline">
                            <label class="cursor-pointer">
                                <input class="civilite readable" type="radio" name="contact_civilite" value="madame" @if($contact->contact_civilite== "madame") checked @endif>
                                <i class="madame fas fa-female border rounded p-2"><p class="d-inline ml-2">Madame</p></i>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label>
                                <input class="civilite readable" type="radio" name="contact_civilite" value="monsieur" @if($contact->contact_civilite== "monsieur") checked @endif>
                                <i class="monsieur fas fa-male border rounded p-2"><p class="d-inline ml-2">Monsieur</p></i>
                            </label>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-start">
                        <div class="col form-group">
                            <label class="font-weight-bold" for="contact_prenom">Prénom</label>
                            <input class="form-control readable" id="contact_prenom" name="contact_prenom" type="text" value="{{ ucfirst(strtolower($contact->contact_prenom)) }}" >
                            <div class="invalid-feedback contact_prenom_feedback"></div>
                        </div>
                        <div class="col form-group">
                            <label class="font-weight-bold" for="contact_nom">Nom</label>
                            <input class="form-control readable" id="contact_nom" name="contact_nom" type="text" value="{{ $contact->contact_nom }}" >
                            <div class="invalid-feedback contact_nom_feedback"></div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-start">
                        <div class="col form-group">
                            <label class="font-weight-bold" for="contact_fonction">Fonction</label>
                            <input class="form-control readable" id="contact_fonction" name="contact_fonction" type="text" value="{{ $contact->contact_fonction }}" >
                            <div class="invalid-feedback contact_fonction_feedback"></div>
                        </div>
                        <div class="col form-group">
                            <label class="font-weight-bold" for="contact_service">Service</label>
                            <input class="form-control readable" id="contact_service" name="contact_service" type="text" value="{{ $contact->contact_service }}" >
                            <div class="invalid-feedback contact_service_feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="font-weight-bold" for="contact_e_mail">E-mail</label>
                            <input class="form-control readable" id="contact_e_mail" name="contact_e_mail" type="text" value="{{ $contact->contact_e_mail }}" >
                            <div class="invalid-feedback contact_e_mail_feedback"></div>
                        </div>
                        <div class="col form-group">
                            <label class="font-weight-bold" for="societe_id">Société</label>
                            <select class="form-control custom-select readable" id="societe_id" name="societe_id">
                                <option value="{{ $contact->societe->societe_id }}">{{ $contact->societe->societe_nom }}</option>
                                @foreach ($societes as $societe)
                                    <option value="{{ $societe->societe_id }}">{{ $societe->societe_nom }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback societe_id_feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="font-weight-bold" for="contact_telephone">Téléphone mobile</label>
                            <input class="form-control readable" id="contact_telephone" name="contact_telephone" type="text" value="{{ $contact->contact_telephone }}" >
                            <div class="invalid-feedback contact_telephone_feedback"></div>
                        </div>
                        <div class="col form-group">
                            <label class="font-weight-bold" for="contact_date_naissance">Date de naissance</label>
                            <input class="form-control readable" id="contact_date_naissance" name="contact_date_naissance" type="text" value="{{ $contact->contact_date_naissance }}" >
                            <div class="invalid-feedback contact_date_naissance_feedback"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact_view_footer d-flex justify-content-start mt-4">
                <a href="{{ route('contact_list') }}" class="btn btn-secondary font-weight-bold mr-2"><i class="fas fa-table mr-2"></i>Retour à la liste des contact</a>
                <button onclick="updateContact({{ $contact->contact_id }})" id="edit_contact_button" class="btn btn-secondary font-weight-bold readable"><i class="fas fa-save mr-2"></i>Sauvegarder</button>
            </div>
        </div>
    </div>
@endsection