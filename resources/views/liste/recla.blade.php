@extends('app')

@section('titre', 'Liste des causes')

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
                                            <span>Liste du résumé des réclamations</span>
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
                                                    <th>Reclamation</th>
                                                    <th>Processus</th>
                                                    <th>Nombre de cause</th>
                                                    <th>Pourcentage</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($reclas->toArray() as $key => $recla)
                                                    @php
                                                        $progressValues = $reclas->pluck('progess')->toArray();
                                                        $isMax = !empty($progressValues) && $recla['progess'] == max($progressValues);
                                                    @endphp
                                                    <tr class="text-center">
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{ $recla['nom'] }}</td>
                                                        <td>{{ $recla['processus'] }}</td>
                                                        <td>{{ $recla['nbre_cause'] }}</td>
                                                        <td>
                                                            <div class="project-list-progress">
                                                                <div class="progress progress-pill progress-md bg-light">
                                                                    <div class="progress-bar {{ $isMax ? 'bg-danger' : '' }}" data-progress="{{$recla['progess']}}" style="width: 100%;"></div>
                                                                </div>
                                                                <div class="project-progress-percent {{ $isMax ? 'text-danger' : '' }}">
                                                                    {{$recla['progess']}}%
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#modalDetail{{ $recla['id'] }}"
                                                                href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-warning">
                                                                <em class="icon ni ni-eye"></em>
                                                            </a>
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#modalModif{{ $recla['id'] }}"
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

    @foreach($reclas->toArray() as $key => $recla)
        <div class="modal fade zoom" tabindex="-1" id="modalDetail{{ $recla['id'] }}">
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
                                                            Réclamation
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $recla['nom'] }}" readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Processus
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $recla['processus'] }}" readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                @foreach($causeData[$recla['id']] as $key => $cause)
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Cause {{ $key+1 }}
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input value="{{ $cause['cause'] }}" readonly type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
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
    @endforeach

    @foreach($reclas->toArray() as $key => $recla)
        <div class="modal fade zoom" tabindex="-1" id="modalModif{{ $recla['id'] }}">
            <div class="modal-dialog modal-md" role="document" style="width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modification </h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('index_modif_recla') }}">
                            @csrf
                            <div class="row g-4 mb-4" id="poste-container">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-label" for="poste">
                                            Réclamation
                                        </label>
                                        <div class="form-control-wrap">
                                            <input placeholder="Saisie obligatoire" required type="text" class="form-control" value="{{ $recla['nom'] }}" name="reclamation">
                                            <input type="text" name="reclamation_id" value="{{ $recla['id'] }}" style="display: none;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label class="form-label" for="poste">
                                        Processus
                                    </label>
                                    <div class="form-control-wrap">
                                        <select name="processus_id" class="form-select js-select2">
                                            @foreach($processus as $proces)
                                                <option value="{{ $proces->id }}" {{ $recla['processus_id'] == $proces->id ? 'selected' : '' }}>{{ $proces->nom }}</option>
                                            @endforeach
                                        </select>
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
