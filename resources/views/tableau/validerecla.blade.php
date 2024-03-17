@extends('app')

@section('titre', 'Vérification des réclamations')

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
                                        <h3 class="">
                                            <span>Vérifications des réclamations </span>
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
                                                <tr class="">
                                                    <th></th>
                                                    <th>Lieu</th>
                                                    <th>Détecteur</th>
                                                    <th>Date de création</th>
                                                    <th>Date limite de traitement</th>
                                                    <th>Statut</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($ams as $key => $am)
                                                    <tr class="">
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{ $am->lieu }}</td>
                                                        <td>{{ $am->detecteur }}</td>
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($am->date_fiche)->translatedFormat('j F Y ') }}
                                                        </td>
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($am->date_limite)->translatedFormat('j F Y ') }}
                                                        </td>
                                                        @if ($am->statut === 'update')
                                                            <td>
                                                                <span class="badge badge-dim bg-info">
                                                                    <em class="icon ni ni-info"></em>
                                                                    <span class="fs-12px" >Modification détecter</span>
                                                                </span>
                                                            </td>
                                                        @elseif ($am->statut === 'non-valider')
                                                            <td>
                                                                <span class="badge badge-dim bg-danger">
                                                                    <em class="icon ni ni-alert"></em>
                                                                    <span class="fs-12px" >Non valider</span>
                                                                </span>
                                                            </td>
                                                        @elseif ($am->statut === 'soumis')
                                                            <td>
                                                                <span class="badge badge-dim bg-warning">
                                                                    <em class="icon ni ni-stop-circle"></em>
                                                                    <span class="fs-12px" >En attente de validation</span>
                                                                </span>
                                                            </td>
                                                        @endif
                                                        <td>
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#modalDetail{{ $am->id }}"
                                                                href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-warning">
                                                                <em class="icon ni ni-eye"></em>
                                                            </a>
                                                            @if ($am->statut === 'soumis' || $am->statut === 'update')
                                                                <a data-bs-toggle="modal"
                                                                    data-bs-target="#modalConfirme{{ $am->id }}"
                                                                    href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-success border border-1 border-white rounded">
                                                                    <em class="icon ni ni-check"></em>
                                                                </a>
                                                                <a data-bs-toggle="modal"
                                                                    data-bs-target="#modalRejet{{ $am->id }}"
                                                                    href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-danger border border-1 border-white rounded">
                                                                    <em class="icon ni ni-cross"></em>
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
                                <div class="col-md-12 col-xxl-122">
                                    <div class="card">
                                        <div class="card-inner">
                                            <div class="card-head">
                                                <h5 class="card-title">
                                                    Action {{ $key+1 }}
                                                </h5>
                                            </div>
                                            <div class="row g-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group ">
                                                        <label class="form-label" for="Cause">
                                                            Action
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $actions['action'] }}" readonly type="text" class="form-control " id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group ">
                                                        <label class="form-label" for="Cause">
                                                            Causes
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $actions['cause'] }}" readonly type="text" class="form-control " id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group ">
                                                        <label class="form-label" for="Cause">
                                                            Réclamation
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $actions['reclamation'] }}" readonly type="text" class="form-control " id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group ">
                                                        <label class="form-label" for="Cause">
                                                            Processus
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $actions['processus'] }}" readonly type="text" class="form-control " id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group ">
                                                        <label class="form-label" for="Cause">
                                                            Délai
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ \Carbon\Carbon::parse($actions['delai'])->translatedFormat('j F Y ') }}" readonly type="text" class="form-control " id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
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
        <div class="modal fade" tabindex="-1" id="modalConfirme{{ $am->id }}" aria-modal="true" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content"><a href="#" class="close" data-bs-dismiss="modal"><em
                            class="icon ni ni-cross"></em></a>
                    <div class="modal-body modal-body-lg text-center">
                        <div class="nk-modal">
                            <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-check bg-success">
                                
                            </em>
                            <h4 class="nk-modal-title">Confirmation</h4>
                            <div class="nk-modal-text">
                                <div class="caption-text">
                                    <span>Voulez-vous vraiment confirmer la validation ?</span>
                                </div>
                            </div>
                            <div class="nk-modal-action">
                                <a id="form_val" href="/valider/{{ $am->id }}" class="btn btn-lg btn-mw btn-success me-2">
                                    oui
                                </a>
                                <a href="#" class="btn btn-lg btn-mw btn-danger"data-bs-dismiss="modal">
                                    non
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($ams as $am)
        <div class="modal fade" id="modalRejet{{ $am->id }}" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Rejet</h5><a href="#" class="close" data-bs-dismiss="modal"
                            aria-label="Close"><em class="icon ni ni-cross"></em></a>
                    </div>
                    <div class="modal-body">
                        <form id="form_rejet" action="{{ route('rejet_recla') }}" method="post" >
                            @csrf
                            <div class="form-group">
                                <label class="form-label" for="pay-amount">Motif</label>
                                <div class="form-control-wrap">
                                    <textarea required name="motif" class="form-control no-resize" id="default-textarea"></textarea>
                                    <input type="text" value="{{ $am->id }}" name="amelioration_id" style="display: none;">
                                </div>
                            </div>
                            <div class="form-group ">
                                <button type="submit" class="btn btn-lg btn-success">
                                    Sauvgarder
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

        <script>
            document.getElementById("form_val").addEventListener("click", function(event) {

                $('.modal').modal('hide');
                $(`#modalLoadv`).modal('hide');
                $(`#modalLoadv`).modal('show');

            });
            document.getElementById("form_rejet").addEventListener("submit", function(event) {
                event.preventDefault(); // Empêche la soumission par défaut du formulaire
                
                $('.modal').modal('hide');
                $(`#modalLoadr`).modal('hide');
                $(`#modalLoadr`).modal('show');

                // Si toutes les validations passent, soumettre le formulaire
                this.submit();
            });
        </script>

    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('9f9514edd43b1637ff61', {
          cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel-new-recla');
        channel.bind('my-event-new-recla', function(data) {
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

    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('9f9514edd43b1637ff61', {
          cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel-update-recla');
        channel.bind('my-event-update-recla', function(data) {
            Swal.fire({
                        title: "Alert!",
                        text: "Modification(S) Détectée(s)",
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
