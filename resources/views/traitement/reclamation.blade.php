@extends('app')

@section('titre', 'Liste des réclamations')

@section('option_btn')

    <li class="dropdown chats-dropdown">
        <a href="{{ route('index_accueil') }}" class="dropdown-toggle nk-quick-nav-icon">
            <div class="icon-status icon-status-na">
                <em class="icon ni ni-home"></em>
            </div>
        </a>
    </li>

@endsection

@section('content')

    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-head nk-block-head-sm" >
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content" style="margin:0px auto;">
                                        <h3 class="text-center">
                                            <span>Suivis des rèclamations</span>
                                            <em class="icon ni ni-list-index"></em>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-lg-12 col-xxl-12">
                                <div class="card card-bordered card-preview">
                                    <div class="card-inner">
                                        <table class="datatable-init table">
                                            <thead>
                                                <tr class="text-center">
                                                    <th></th>
                                                    <th>Lieu</th>
                                                    <th>Détecteur</th>
                                                    <th>Date de création</th>
                                                    <th>Date Limite de traitement</th>
                                                    <th>Nombre d'action</th>
                                                    <th>Action éffectuée</th>
                                                    <th>Date de réalisation</th>
                                                    <th>Statut</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($ams as $key => $am)
                                                    <tr class="text-center">
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{ $am->lieu }}</td>
                                                        <td>{{ $am->detecteur }}</td>
                                                        <td>
                                                            {{ 
                                                                \Carbon\Carbon::parse($am->date_fiche)->format('d/m/Y')
                                                            }}
                                                        </td>
                                                        @if(\Carbon\Carbon::parse($am->date_fiche)->addDays($am->nbre_traitement)->format('d/m/Y') === \Carbon\Carbon::now()->toDateString())
                                                        <td class="text-danger" >
                                                            {{ \Carbon\Carbon::parse($am->date_fiche)->addDays($am->nbre_traitement)->format('d/m/Y') }}
                                                        </td>
                                                        @endif
                                                        @if(\Carbon\Carbon::parse($am->date_fiche)->addDays($am->nbre_traitement)->format('d/m/Y') !== \Carbon\Carbon::now()->toDateString())
                                                        <td class="text-success" >
                                                            {{ \Carbon\Carbon::parse($am->date_fiche)->addDays($am->nbre_traitement)->format('d/m/Y') }}
                                                        </td>
                                                        @endif
                                                        <td class="text-primary" >
                                                            {{ $am->nbre_action }}
                                                        </td>
                                                        <td class="text-success" >
                                                            {{ $am->nbre_action_eff }}
                                                        </td>
                                                        @if ($am->date_cloture1 !== null)
                                                        <td>
                                                            {{ 
                                                                \Carbon\Carbon::parse($am->date_cloture1)->format('d/m/Y')
                                                            }}
                                                        </td>
                                                        @endif
                                                        @if ($am->date_cloture1 === null)
                                                        <td>
                                                            Action(s) à réaliser {{$am->nbre_action_non}}
                                                        </td>
                                                        @endif
                                                        @if ( $am->statut === 'valider' )
                                                            <td class="text-center" >Valider</td>
                                                        @endif
                                                        @if ( $am->statut === 'terminer' )
                                                            <td class="text-center">
                                                                En attente du delai de traiatement de l'éfficacité
                                                            </td>
                                                        @endif
                                                        @if ( $am->statut === 'date_efficacite' )
                                                            <td class="text-center">
                                                                En attente de l'évaluation de l'éfficacité
                                                            </td>
                                                        @endif
                                                        @if ( $am->statut === 'cloturer' )
                                                            <td class="text-center" >Clôturer</td>
                                                        @endif
                                                        <td>
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#modalDetail{{ $am->id }}"
                                                                href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-warning">
                                                                <em class="icon ni ni-eye"></em>
                                                            </a>
                                                            @if ($am->nbre_action_non === 0 )
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#modalDate{{ $am->id }}"
                                                                href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-info">
                                                                <em class="icon ni ni-calendar"></em>
                                                            </a>
                                                            @endif
                                                            @if ($am->date1 !== null && $am->date1 <= \Carbon\Carbon::now()->toDateString() && $am->date2 >= \Carbon\Carbon::now()->toDateString() )
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#modalEfficacite{{ $am->id }}"
                                                                href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-primary">
                                                                <em class="icon ni ni-focus"></em>
                                                            </a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach($ams as $key => $am)
        <div class="modal fade zoom" tabindex="-1" id="modalDetail{{ $am->id }}">
            <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Détails</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
                    </div>
                    <div class="modal-body">
                        <form class="nk-block">
                            <div class="row g-gs">
                                <div class="col-md-12 col-xxl-12" id="groupesContainer">
                                    <div class="">
                                        <div class="card-inner">
                                            <div class="row g-4">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Date
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $am->date_fiche }}" readonly type="date" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Lieu
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $am->lieu }}" readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Détecteur
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $am->detecteur }}" readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Réclamations
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <textarea readonly required name="causes" class="form-control no-resize" id="default-textarea">{{ $am->reclamations }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Conséquences
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <textarea readonly required name="causes" class="form-control no-resize" id="default-textarea">{{ $am->consequences }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Causes
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <textarea readonly required name="causes" class="form-control no-resize" id="default-textarea">{{ $am->causes }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach($actionsData[$am->id] as $key => $actions)
                                <div class="col-md-12 col-xxl-122" id="groupesContainer">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="card-head">
                                                <h5 class="card-title">
                                                    Action Corrective {{ $key+1 }}
                                                </h5>
                                            </div>
                                            <div class="row g-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group text-center">
                                                        <label class="form-label" for="Cause">
                                                            Processus
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $actions['processus'] }}" readonly type="text" class="form-control text-center" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group text-center">
                                                        <label class="form-label" for="Cause">
                                                            Réclamation
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $actions['reclamation'] }}" readonly type="text" class="form-control text-center" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group text-center">
                                                        <label class="form-label" for="Cause">
                                                            Causes
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $actions['cause'] }}" readonly type="text" class="form-control text-center" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group text-center">
                                                        <label class="form-label" for="Cause">
                                                            Action
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $actions['action'] }}" readonly type="text" class="form-control text-center" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($actions['statut'] === 'realiser')
                                                <div class="col-lg-4">
                                                    <div class="form-group text-center">
                                                        <label class="form-label" for="Cause">
                                                            Délai
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ \Carbon\Carbon::parse($actions['delai'])->format('d/m/Y') }}" readonly type="text" class="form-control text-center" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group text-center">
                                                        <label class="form-label" for="Cause">
                                                            Date de realisation
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ \Carbon\Carbon::parse($actions['date_action'])->format('d/m/Y') }}" readonly type="text" class="form-control text-center" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group text-center">
                                                        <label class="form-label" for="Cause">
                                                            Date du Suivi
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ \Carbon\Carbon::parse($actions['date_suivi'])->format('d/m/Y H:i:s') }}" readonly type="text" class="form-control text-center" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($actions['date_action'] <=  $actions['date_suivi'])
                                                <div class="col-lg-12">
                                                    <div class="form-group text-center">
                                                        <div class="form-control-wrap">
                                                            <input value="Action Réaliser dans les délais" readonly type="text" class="form-control text-center bg-success" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @if ($actions['date_action'] >  $actions['date_suivi'])
                                                <div class="col-lg-12">
                                                    <div class="form-group text-center">
                                                        <div class="form-control-wrap">
                                                            <input value="Action Réaliser hors délais" readonly type="text" class="form-control text-center bg-warning" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Commentaire
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <textarea readonly required name="causes" class="form-control no-resize" id="default-textarea">{{ $actions['commentaire_am'] }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @if ($actions['statut'] === 'non-realiser')
                                                <div class="col-lg-12">
                                                    <div class="form-group text-center">
                                                        <div class="form-control-wrap">
                                                            <input value="Action Non Réaliser" readonly type="text" class="form-control text-center bg-danger" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($ams as $am)
        <div class="modal fade zoom" tabindex="-1" id="modalEfficacite{{ $am->id }}">
            <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Suivi</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em
                                class="icon ni ni-cross"></em></a>
                    </div>
                    <div class="modal-body">
                        <div class="nk-block">
                            <form class="row g-gs" method="post" action="">
                                @csrf
                                <div class="col-lg-12 col-xxl-12" >
                                    <div class="card">
                                        <div class="card-inner">
                                                <div class="row g-4">
                                                    <div class="col-lg-5">
                                                        <div class="form-group">
                                                            <label class="form-label" for="email-address-1">
                                                                Action éfficace
                                                            </label>
                                                            <select required name="efficacite" class="form-select ">
                                                                <option value="">
                                                                    Choisir
                                                                </option>
                                                                <option value="efficace">
                                                                    oui
                                                                </option>
                                                                <option value="non_efficace">
                                                                    non
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label" for="Coût">
                                                                Date de vérification de l'éfficacité
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input readonly name="date_efficacite" type="date" class="form-control"  value="{{ \Carbon\Carbon::now()->toDateString() }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <div class="form-group text-center">
                                                            <label class="form-label" for="description">
                                                                Commentaire
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <textarea name="commentaire" class="form-control no-resize" id="default-textarea"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group text-center">
                                                            <button type="submit" class="btn btn-lg btn-success btn-dim">
                                                                <em class="ni ni-check me-2 "></em>
                                                                <em >Enregistrer</em>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($ams as $am)
        <div class="modal fade zoom" tabindex="-1" id="modalDate{{ $am->id }}">
            <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Intervale d'évaluation de l'éfficacitée</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="nk-block">
                            <form class="row g-gs" method="post" action="{{ route('date_recla') }}">
                                @csrf
                                <input type="text" name="amelioration_id" value="{{ $am->id }}" style="display: none;">
                                <div class="col-lg-12 col-xxl-12" >
                                    <div class="card">
                                        <div class="card-inner">
                                                <div class="row g-4">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-label">
                                                                Début
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input id="date1" name="date1" type="date" class="form-control text-center" value="{{ \Carbon\Carbon::now()->toDateString() }}" onchange="checkDate()" min="{{ \Carbon\Carbon::now()->toDateString() }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-label">
                                                                Jours
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <select id="nbre_jour_eff" class="form-select " >
                                                                    @for ($i = 1; $i <= 31; $i++)
                                                                        <option {{ $i === 1 ? 'selected' : '' }} value="{{ $i }}" >
                                                                            {{ $i }} Jour
                                                                        </option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-label">
                                                                Fin
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input readonly id="date2" name="date2" type="text" class="form-control text-center">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-xxl-12">
                                                        <div class="form-group text-center">
                                                            <button type="submit" class="btn btn-lg btn-success btn-dim">
                                                                <em class="ni ni-check me-2 "></em>
                                                                <em >Enregistrer</em>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Écoute des changements sur le champ de date et le champ du nombre de jours
            document.getElementById('date1').addEventListener('change', updateDateLimite);
            document.getElementById('nbre_jour_eff').addEventListener('change', updateDateLimite);

            function updateDateLimite() {
                var dateDebut = document.getElementById('date1').value;
                var nbreJours = parseInt(document.getElementById('nbre_jour_eff').value);

                // Vérification si la date de début est sélectionnée et le nombre de jours est valide
                if (dateDebut && !isNaN(nbreJours)) {
                    var dateLimite = new Date(dateDebut);
                    dateLimite.setDate(dateLimite.getDate() + nbreJours);

                    // Extraction des éléments de date individuels
                    var jour = ('0' + dateLimite.getDate()).slice(-2); // Jour
                    var mois = ('0' + (dateLimite.getMonth() + 1)).slice(-2); // Mois (ajouter +1 car les mois commencent à 0)
                    var annee = dateLimite.getFullYear(); // Année

                    // Formatage de la date au format dd/mm/aaaa
                    var formattedDate = jour + '/' + mois + '/' + annee;

                    // Mettre à jour la valeur du champ "Date limite de traitement"
                    document.getElementById('date2').value = formattedDate;
                }
            }

            // Appel initial pour mettre à jour la date limite lors du chargement de la page
            updateDateLimite();
        });
    </script>

    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('9f9514edd43b1637ff61', {
          cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel-action-r');
        channel.bind('my-event-action-r', function(data) {
            Swal.fire({
                        title: "Alert!",
                        text: "Nouvelle(s) Réclamation(s)",
                        icon: "info",
                        confirmButtonColor: "#00d819",
                        confirmButtonText: "OK",
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
        });
    </script>


@endsection
