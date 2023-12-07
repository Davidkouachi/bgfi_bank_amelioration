@extends('app')

@section('titre', 'Nouveau Processus')

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
                                            <span>Liste des Causes</span>
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
                                                    <th>Cause</th>
                                                    <th>Reclamation</th>
                                                    <th>Processus</th>
                                                    <th>Nombre d'actions</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($causes as $key => $cause)
                                                    <tr class="text-center">
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{ $cause->nom }}</td>
                                                        <td>{{ $cause->reclamation }}</td>
                                                        <td>{{ $cause->processus }}</td>
                                                        <td>{{ $cause->nbre_action }}</td>
                                                        <td>
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#modalDetail{{ $cause->id }}"
                                                                href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-warning">
                                                                <em class="icon ni ni-eye"></em>
                                                            </a>
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#modalModif{{ $cause->id }}"
                                                                href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-info">
                                                                <em class="icon ni ni-edit"></em>
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

    @foreach($causes as $key => $cause)
        <div class="modal fade zoom" tabindex="-1" id="modalDetail{{ $cause->id }}">
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
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Cause
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $cause->nom }}" readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Réclamation
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $cause->reclamation }}" readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Processus
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $cause->processus }}" readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach($actionsData[$cause->id] as $key => $action)
                                <div class="col-md-12 col-xxl-122" id="groupesContainer">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="card-head">
                                                <h5 class="card-title">
                                                    Action {{ $key+1 }}
                                                </h5>
                                            </div>
                                            <div class="row g-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group text-center">
                                                        <label class="form-label" for="Cause">
                                                            Action
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $action['action'] }}" readonly type="text" class="form-control text-center" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row g-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group text-center">
                                                        <label class="form-label" for="Cause">
                                                            Responsable
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $action['poste'] }}" readonly type="text" class="form-control text-center" id="Cause">
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

    @foreach($causes as $key => $cause)
        <div class="modal fade zoom" tabindex="-1" id="modalModif{{ $cause->id }}">
            <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modification </h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('index_modif_cause') }}">
                            @csrf
                            <div class="row g-4 mb-4" id="poste-container">
                                <div class="col-lg-12">
                                    <div class="form-group text-center">
                                        <label class="form-label" for="poste">
                                            Cause
                                        </label>
                                        <div class="form-control-wrap">
                                            <input placeholder="Saisie obligatoire" required type="text" class="form-control text-center poste" value="{{ $cause->nom }}" name="cause" oninput="this.value = this.value.toUpperCase()">
                                            <input type="text" name="cause_id" value="{{ $cause->id }}" style="display: none;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-gs">
                                <div class="col-lg-12">
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-lg btn-primary btn-dim">
                                            <em class="ni ni-edit me-2"></em>
                                            <em>Mise à jour</em>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


@endsection
