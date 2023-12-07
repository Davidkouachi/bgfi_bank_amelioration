@extends('app')

@section('titre', 'Accueil')

@section('content')

            <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block justify-items-center">
                        <form class="row g-gs" >
                            <div class="col-lg-12 col-xxl-12" style="margin-bottom: -15px;" >
                                <div class="card card-bordered card-preview" style="margin-top: -15px; background-color: red;">
                                    <div class="" style="height: 30px; display: flex; " >
                                        <label class="form-label" style="font-size: 20px; color: white;margin-left:5px;">
                                            Alert: 
                                        </label>
                                        <marquee>
                                            <label style="font-size: 20px; color: white;">
                                                Nouveau
                                            </label>
                                        </marquee>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-xxl-12" >
                                <div class="card card-bordered card-preview">
                                    <div class="card-inner row g-gs">
                                        <div class="col-lg-12 col-xxl-12">
                                            <div class="form-group text-center">
                                                <label class="form-label" for="Cause">
                                                    Menu
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 ">
                                            <div class="form-group text-center">
                                                <a style="width:230px;" class="btn btn-lg btn-outline-primary" href="{{ route('index_add_poste') }}" >
                                                    <em class="ni ni-reports-alt me-2"></em>
                                                    <em>Nouveau poste</em>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 ">
                                            <div class="form-group text-center">
                                                <a style="width:230px;" class="btn btn-lg btn-outline-primary" href="{{ route('index_add_resva') }}" >
                                                    <em class="ni ni-user-add me-2 text-center"></em>
                                                    <em>Nouveau utilisateur</em>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 ">
                                            <div class="form-group text-center">
                                                <a style="width:230px;" class="btn btn-lg btn-outline-primary" href="{{ route('index_add_processus') }}" >
                                                    <em class="ni ni-share-alt me-2"></em>
                                                    <em>Nouveau processus</em>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 ">
                                            <div class="form-group text-center">
                                                <a style="width:230px;" class="btn btn-lg btn-outline-primary" href="{{ route('index_amelioration') }}" >
                                                    <em class="ni ni-reports me-2"></em>
                                                    <em>Fiche d'amélioration</em>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 ">
                                            <div class="form-group text-center">
                                                <a style="width:230px;" class="btn btn-lg btn-outline-primary" href="{{ route('index_listeprocessus') }}" >
                                                    <em class="ni ni-list-index me-2"></em>
                                                    <em>Liste des processus </em>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 ">
                                            <div class="form-group text-center">
                                                <a style="width:230px;" class="btn btn-lg btn-outline-primary" href="{{ route('index_suiviaction') }}" >
                                                    <em class="ni ni-list-index me-2"></em>
                                                    <em>Tableau suivi </em>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 ">
                                            <div class="form-group text-center">
                                                <a style="width:230px;" class="btn btn-lg btn-outline-primary" href="{{ route('index_stat') }}" >
                                                    <em class="ni ni-bar-chart-alt me-2"></em>
                                                    <em>Statistique</em>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 ">
                                            <div class="form-group text-center">
                                                <a style="width:230px;" class="btn btn-lg btn-outline-primary" href="{{ route('index_historique') }}" >
                                                    <em class="ni ni-property me-2"></em>
                                                    <em>Historique</em>
                                                </a>
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

@endsection
