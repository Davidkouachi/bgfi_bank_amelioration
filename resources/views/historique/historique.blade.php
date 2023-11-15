@extends('app')

@section('titre', 'Nouveau Processus')

@section('content')

    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="text-center">
                                    Historique
                                </h3>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a class="btn btn-white btn-dim btn-outline-primary" href="{{ route('index_accueil') }}">
                                        <em class="icon ni ni-home"></em>
                                        <span>Accueil</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-md-12 col-xxl-4">
                                <div class="card card-bordered card-preview">
                                    <div class="card-inner">
                                        <table class="datatable-init table" data-export-title="Export">
                                            <thead>
                                                <tr class="text-center">
                                                    <th></th>
                                                    <th>Date et heure</th>
                                                    <th>Action éffecttuée</th>
                                                    <th>Page</th>
                                                    <th>Nom et prénom</th>
                                                    <th>Poste</th>
                                                    <th>matricule</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($historiques as $key => $historique)
                                                    <tr class="text-center">
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{ $historique->created_at }}</td>
                                                        <td>{{ $historique->nom_action }}</td>
                                                        <td>{{ $historique->nom_formulaire }}</td>
                                                        <td>{{ $historique->nom }}</td>
                                                        <td>{{ $historique->poste }}</td>
                                                        <td>{{ $historique->matricule }}</td>
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


@endsection
