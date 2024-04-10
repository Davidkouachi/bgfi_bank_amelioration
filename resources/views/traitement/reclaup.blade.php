@extends('app')

@section('titre', 'Liste des reclamations non acceptées')

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
                                            <span>Liste des reclamations non acceptées</span>
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
                                                <tr>
                                                    <th></th>
                                                    <th>Lieu</th>
                                                    <th>Détecteur</th>
                                                    <th>Date création</th>
                                                    <th>Date limite de traitement</th>
                                                    <th>Nombre d'actions</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($ams as $key => $am)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{ $am->lieu }}</td>
                                                        <td>{{ $am->detecteur }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($am->date_fiche)->translatedFormat('j F Y ') }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($am->date_limite)->translatedFormat('j F Y ') }}</td>

                                                        <td>{{ $am->nbre_action }}</td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <a data-bs-toggle="modal" data-bs-target="#modalMotif{{ $am->id }}" href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-danger">
                                                                    <em class="icon ni ni-cc-alt"></em>
                                                                </a>
                                                                <form method="post" action="{{ route('index_non_accepte2') }}">
                                                                @csrf
                                                                    <input type="text" name="id" value="{{ $am->id }}" style="display: none;">
                                                                    <button type="submit" class="btn btn-icon btn-white btn-dim btn-sm btn-info border border-1 border-white rounded">
                                                                        <em class="icon ni ni-edit"></em>
                                                                    </button>
                                                                </form>
                                                            </div>
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

    @foreach($ams as $am)
        <div class="modal fade zoom" tabindex="-1" id="modalMotif{{ $am->id }}">
            <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Détails Motif</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
                    </div>
                    <div class="modal-body">
                        <form class="nk-block">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-label" for="Cause">
                                            Motif(s)
                                        </label>
                                        <div class="form-control-wrap">
                                            <textarea disabled  class="form-control no-resize" id="default-textarea">{{ $am->motif }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('9f9514edd43b1637ff61', {
          cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel-rejet-recla');
        channel.bind('my-event-rejet-recla', function(data) {
            Swal.fire({
                        title: "Alert!",
                        text: "Nouvelle Fiche(s) de Réclamation(s) non-valider",
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
