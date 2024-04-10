@extends('app')

@section('titre', 'Liste des actions effectuées')

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
                        <div class="nk-block-between">
                                    <div class="nk-block-head-content" style="margin:0px auto;">
                                        <h3 class="text-center">
                                            <span>Liste des Actions éffectuées</span>
                                            <em class="icon ni ni-list-index"></em>
                                        </h3>
                                    </div>
                                </div>
                    </div>
                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-md-12 col-xxl-12">
                                <div class="card card-bordered card-preview">
                                    <div class="card-inner">
                                        <table class="datatable-init table">
                                            <thead>
                                                <tr class="text-center">
                                                    <th></th>
                                                    <th>Action</th>
                                                    <th>Cause</th>
                                                    <th>Délai</th>
                                                    <th>Date de traitement</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($actions as $key => $action)
                                                    <tr class="text-center">
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{ $action->action }}</td>
                                                        <td>{{ $action->cause }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($action->delai)->format('d/m/Y') }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($action->date_action)->format('d/m/Y') }}</td>
                                                        @if ( $action->delai >= $action->date_action )
                                                            <td>
                                                                <span class="badge badge-dim bg-success">
                                                                    <em class="icon ni ni-info"></em>
                                                                    <span class="fs-12px" >Réaliser dans le délai</span>
                                                                </span>
                                                            </td>
                                                        @endif
                                                        @if ( $action->delai < $action->date_action )
                                                            <td>
                                                                <span class="badge badge-dim bg-danger">
                                                                    <em class="icon ni ni-info"></em>
                                                                    <span class="fs-12px" >Réaliser hors délai</span>
                                                                </span>
                                                            </td>
                                                        @endif
                                                        <td>
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#modalDetail{{ $action->id }}"
                                                                href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-warning">
                                                                <em class="icon ni ni-eye"></em>
                                                            </a>
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

    @foreach ($actions as $action)
        <div class="modal fade zoom" tabindex="-1" id="modalDetail{{ $action->id }}">
            <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Suivi</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em
                                class="icon ni ni-cross"></em></a>
                    </div>
                    <div class="modal-body">
                        <div class="nk-block">
                            <form class="row g-gs" method="post" action="/Suivi_action/{{ $action->id }}">
                                @csrf
                                <div class="col-lg-12 col-xxl-12" >
                                    <div class="card">
                                        <div class="card-inner">
                                                <div class="row g-4">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Cause">
                                                                Processus
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $action->processus }}" type="text" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="controle">
                                                                Reclamation
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $action->reclamation }}" type="text" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="controle">
                                                                Cause
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $action->cause }}" type="text" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="controle">
                                                                Action
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $action->action }}" type="text" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-label" for="corectif">
                                                                Délai
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ \Carbon\Carbon::parse($action->delai)->format('d/m/Y') }}" type="text" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-label" for="corectif">
                                                                Date de traitement
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ \Carbon\Carbon::parse($action->date_action)->format('d/m/Y') }}" type="text" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-label" for="corectif">
                                                                Date de Suivi
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ \Carbon\Carbon::parse($action->date_suivi)->format('d/m/Y') }}" type="text" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                                @if ( $action->delai >= $action->date_action )
                                                                    <input value="Réaliser dans le délai" type="text" class="form-control bg-success text-white text-center" disabled>
                                                                @endif
                                                                @if ( $action->delai < $action->date_action )
                                                                    <input value="Réaliser hors délai" type="text" class="form-control bg-danger text-white text-center" disabled>
                                                                @endif
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Coût">
                                                                Responsable
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $action->poste }}" type="text" class="form-control" disabled>
                                                            </div>
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
        Pusher.logToConsole = true;

        var pusher = new Pusher('9f9514edd43b1637ff61', {
          cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel-suivi-action-recla');
        channel.bind('my-event-suivi-action-recla', function(data) {
            Swal.fire({
                        title: "Alert!",
                        text: "Action(s) Réalisée(s)",
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
