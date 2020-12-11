@extends('dashboard')

@section('dashboard_body')
    <div class="container">
        <h1 class="container-fluid py-5 text-center">Details d'un Contact</h1>
        <div class="contact_view_page border p-3 shadow-sm">
            <div class="d-none contact_alert alert alert-danger alert-dismissible fade show" role="alert">
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
                        @if($contact->contact_civilite== "madame")
                        <div class="form-check form-check-inline">
                            <label class="cursor-pointer">
                                <input type="radio" name="contact_civilite" value="madame"  checked>
                                <i class="madame fas fa-female border rounded p-2"><p class="d-inline ml-2">Madame</p></i>
                            </label>
                        </div>
                        @elseif($contact->contact_civilite== "monsieur")
                        <div class="form-check form-check-inline">
                            <label>
                                <input class="cursor-default" type="radio" name="contact_civilite" value="monsieur" checked>
                                <i class="monsieur fas fa-male border rounded p-2"><p class="d-inline ml-2">Monsieur</p></i>
                            </label>
                        </div>
                        @endif
                    </div>
                    <div class="row d-flex justify-content-start">
                        <div class="col form-group">
                            <label class="font-weight-bold" for="contact_prenom">Prénom</label>
                            <p class="" id="contact_prenom" name="contact_prenom">{{ $contact->contact_prenom }}</p>
                        </div>
                        <div class="col form-group">
                            <label class="font-weight-bold" for="contact_nom">Nom</label>
                            <p class="" id="contact_nom" name="contact_nom">{{ $contact->contact_nom }}</p>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-start">
                        <div class="col form-group">
                            <label class="font-weight-bold" for="contact_fonction">Fonction</label>
                            <p id="contact_fonction" name="contact_fonction" >{{ $contact->contact_fonction }}</p>
                        </div>
                        <div class="col form-group">
                            <label class="font-weight-bold" for="contact_service">Service</label>
                            <p id="contact_service" name="contact_service" >{{ $contact->contact_service }}</p>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-start">
                        <div class="col form-group">
                            <label class="font-weight-bold" for="contact_e_mail">E-mail</label>
                            <p id="contact_e_mail" name="contact_e_mail" >{{ $contact->contact_e_mail }}</p>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-start">
                        <div class="col form-group">
                            <label class="font-weight-bold" for="contact_telephone">Téléphone mobile</label>
                            <p id="contact_telephone" name="contact_telephone" >{{ $contact->contact_telephone }}</p>
                        </div>
                        <div class="col form-group">
                            <label class="font-weight-bold" for="contact_date_naissance">Date de naissance</label>
                            <p id="contact_date_naissance" name="contact_date_naissance" >{{ $contact->contact_date_naissance }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="container border border-secondary ml-2 my-2 p-3 thick-border-left">
                    <h4>Société</h4>
                    @if($contact->societe)
                    <div class="form-group">
                        <label class="font-weight-bold" for="societe_nom">Nom</label>
                        <p id="societe_nom" name="societe_nom" type="text" >{{ $contact->societe->societe_nom }}</p>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="societe_adresse">Adresse</label>
                        <p id="societe_adresse" name="societe_adresse" >{{ $contact->societe->societe_adresse }}</p>
                    </div>
                    <div class="d-flex flex-row row">
                        <div class="form-group col-4">
                            <label class="font-weight-bold" for="societe_code_postal">Code postal</label>
                            <p id="societe_code_postal" name="societe_code_postal" >{{ $contact->societe->societe_code_postal }}</p>
                        </div>
                        <div class="form-group col-8">
                            <label class="font-weight-bold" for="societe_ville">Ville</label>
                            <p id="societe_ville" name="societe_ville" >{{ $contact->societe->societe_ville }}</p>
                        </div>
                    </div>
                    <div class="d-flex flex-row row">
                        <div class="form-group col-4">
                            <label class="font-weight-bold" for="societe_code_postal">Téléphone</label>
                            <p id="societe_code_postal" name="societe_telephone" >{{ $contact->societe->societe_telephone }}</p>
                        </div>
                        <div class="form-group col-8">
                            <label class="font-weight-bold" for="societe_ville">Site web</label>
                            <p id="societe_ville" name="societe_site_web" >{{ $contact->societe->societe_site_web }}</p>
                        </div>
                    </div>
                    @else
                    <p>Ce contact n'a pas de société.</p>
                    @endif
                </div>

            </div>
            <div class="contact_view_footer d-flex justify-content-start mt-4">
                <a desk="contact_list_button" href="{{ route('contact_list') }}" class="btn btn-secondary font-weight-bold mr-2"><i class="fas fa-table mr-2"></i>Retour à la liste des contact</a>
                <a desk="edit_contact_button" href="{{ route('edit_contact', ['id' => $contact->contact_id ]) }}" class="btn btn-secondary font-weight-bold mr-2" ><i class="fas fa-edit mr-2"></i>Modifier</a>
            </div>
        </div>
    </div>
@endsection