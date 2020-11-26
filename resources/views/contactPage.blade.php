@extends('home')

@section('title', 'Contact Page')

@section('content')
    <div class="mx-5">
        <h1 class="container-fluid py-5 text-center">List des contacts</h1>
        <div class="d-flex justify-content-end"><a href="{{ route('add_contact') }}" class="btn btn-secondary font-weight-bold mb-2"><i class="fas fa-plus mr-2"></i>Ajouter un contact</a></div>
        <table class="display hover nowrap" id="contact_page_table">
            <thead class="font-weight-bold">
                <tr>
                    <th>Civilité</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Téléphone</th>
                    <th>E-mail</th>
                    <th>Société</th>
                    <th>Ville</th>
                    <th><i class="fas fa-cog ma-5"></i></th>
                </tr>
            </thead>
            <tbody class="font-weight-normal">
                @foreach ($contacts as $contact)
                    <tr class="table_rows">
                        @if($contact->contact_civilite == 'madame')
                            <td><i class="fas fa-female"></i></td>
                        @elseif($contact->contact_civilite == 'monsieur')
                            <td><i class="fas fa-male"></i></td>
                        @endif
                        <td>{{ $contact->contact_prenom }}</td>
                        <td>{{ $contact->contact_nom }}</td>
                        <td>{{ $contact->contact_telephone }}</td>
                        <td>{{ $contact->contact_e_mail }}</td>
                        <td>{{ $contact->societe->societe_nom }}</td>
                        <td>{{ $contact->societe->societe_ville }}</td>
                        <td class="edit-column">
                            <a href="{{ route('view_contact', ['id' => $contact->contact_id ]) }}"><i class="text-secondary hovered fas fa-eye mr-2"></i></a>
                            <a href="{{ route('edit_contact', ['id' => $contact->contact_id ]) }}"><i class="text-secondary hovered fas fa-edit mr-2"></i></a>
                            <a dusk="contact_delete_button" style="cursor: pointer" onclick="deleteContact(this, {{ $contact->contact_id }})"><i class="text-secondary hovered fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection