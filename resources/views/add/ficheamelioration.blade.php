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
                    <div class="nk-block-head nk-block-head-sm" >
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content" style="margin:0px auto;">
                                        <h3 class="text-center">
                                            <span>Fiche de réclamation</span>
                                            <em class="icon ni ni-reports"></em>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                    <form class="nk-block" method="post" action="{{ route('index_add') }}">
                        @csrf
                        <div class="row g-gs">
                            <!--<div class="col-md-12 col-xxl-12" id="groupesContainer">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                            <div class="row g-4 ">
                                                <div class="col-lg-4">
                                                    <div class="form-group text-center">
                                                        <div class="custom-control custom-radio">
                                                            <input required type="radio" class="custom-control-input" name="type" id="customRadio7" value="non_conformite_interne">
                                                            <label class="custom-control-label" for="customRadio7">
                                                                Non conformité interne
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group text-center">
                                                        <div class="custom-control custom-radio">
                                                            <input required type="radio" class="custom-control-input" name="type" id="customRadio6" value="reclamation">
                                                            <label class="custom-control-label" for="customRadio6">
                                                                Reclamation
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group text-center">
                                                        <div class="custom-control custom-radio">
                                                            <input required type="radio" class="custom-control-input" name="type" id="customRadio5" value="contentieux">
                                                            <label class="custom-control-label" for="customRadio5">
                                                                Contentieux
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>-->
                            <div class="col-md-12 col-xxl-12" id="groupesContainer">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                            <div class="row g-4">
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Date
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input readonly value="{{ date('Y-m-d') }}" name="date_fiche" type="date" class="form-control text-center">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Date limite de traitement 
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input readonly value="{{ date('Y-m-d', strtotime('+5 days')) }}" name="date_limite" type="date" class="form-control text-center">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="controle">
                                                            Lieu
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input required placeholder="Saisie obligatoire" name="lieu" type="text" class="form-control" id="controle">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="controle">
                                                            Détecteur (Agent / Client)
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input required placeholder="Saisie obligatoire" name="detecteur" type="text" class="form-control" id="controle">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-xxl-12" id="groupesContainer">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                            <div class="row g-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Cause">
                                                            Réclamation
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input required placeholder="Saisie obligatoire" name="non_conformite" id="inputMots" type="text" class="form-control" id="Cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row g-2" >
                                                        <div class="col-lg-6" >
                                                            <div class="form-group">
                                                                <label class="form-label" >
                                                                    Cause(s)
                                                                </label>
                                                                <div class="form-control-wrap" >
                                                                    <textarea required name="consequence" class="form-control no-resize" id="default-textarea"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6" >
                                                            <div class="form-group">
                                                                <label class="form-label" >
                                                                    Conséquence(s)
                                                                </label>
                                                                <div class="form-control-wrap" >
                                                                    <textarea required name="consequence" class="form-control no-resize" id="default-textarea"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-xxl-12" id="groupesContainer">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                            <div class="row g-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <select class="form-select js-select2 select_rech" id="causeSelect" data-search="on" data-placeholder="Recherche Cause">
                                                                <option value="" >

                                                                </option>
                                                                @foreach($causes_selects as $causes_select)
                                                                <option value="{{$causes_select->id}}" >
                                                                    {{$causes_select->nom}}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--<div class="col-lg-6">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <select class="form-select js-select2 select_rech" id="risqueSelect" data-search="on" data-placeholder="Recherche Risque">
                                                                <option value="">

                                                                </option>
                                                                @foreach($risques as $risque)
                                                                <option value="{{$risque->id}}">
                                                                    {{$risque->nom}}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>-->
                                                <div class="col-lg-12" id="div_choix" >
                                                    <div class="row g-2" >
                                                        <div class="col-md-6" >
                                                            <div class="form-group text-center">
                                                                <div class="custom-control custom-radio">
                                                                    <input required type="radio" class="custom-control-input choix_select" name="choix_select" id="choixcause" value="cause">
                                                                    <label class="custom-control-label" for="choixcause">
                                                                        Cause trouvé
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6" >
                                                            <div class="form-group text-center">
                                                                <div class="custom-control custom-radio">
                                                                    <input required type="radio" class="custom-control-input choix_select" name="choix_select" id="choixnt" value="cause_risque_nt">
                                                                    <label class="custom-control-label" for="choixnt">
                                                                        Cause non-trouvé
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--<div class="col-md-4" >
                                                            <div class="form-group text-center">
                                                                <div class="custom-control custom-radio">
                                                                    <input required type="radio" class="custom-control-input choix_select" name="choix_select" id="choixrisque" value="risque">
                                                                    <label class="custom-control-label" for="choixrisque">
                                                                        Risque trouvé
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>-->
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-xxl-12" id="groupesContainer_btn_trouve">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <div class="row g-4">
                                            <div class="col-lg-6" id="btn-cause-trouve">
                                                <div class="form-group text-center">
                                                    <a class="btn btn-outline-primary btn-dim action-accepte" data-type="acceptee">
                                                        Action corrective acceptée
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-lg-6" id="btn-risque-trouve">
                                                <div class="form-group text-center">
                                                    <a class="btn btn-outline-primary btn-dim action-non-accepte" data-type="nouvelle-action">
                                                        Action corrective non-acceptée
                                                    </a>
                                                </div>
                                            </div>
                                            <!--<div class="col-lg-4" id="btn-risque-trouve">
                                                <div class="form-group text-center">
                                                    <a class="btn btn-outline-primary btn-dim action-accepte-new" data-type="nouvelle-action">
                                                        Ajouter un action corrective
                                                    </a>
                                                </div>
                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-xxl-12" id="groupesContainer_btn_new">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <div class="row g-4">
                                            <div class="col-lg-12"id="btn-non-trouve">
                                                <div class="form-group text-center">
                                                    <a class="btn btn-outline-primary btn-dim action-new" data-type="nouvelle-action">
                                                        Nouvelle action corrective
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="dynamic-fields-parent" style="display: none;" >
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <div class="row g-4">
                                            <div class="col-lg-12 col-xxl-12" >
                                                <div class="card">
                                                    <div class="card-inner">
                                                            <div class="row g-4">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="Cause">
                                                                            Processus
                                                                        </label>
                                                                        <input  name="nature[]" value="0" type="text" >
                                                                        <div class="form-control-wrap">
                                                                            <select id="responsable_idc" required name="processus_id[]" class="form-select js-select2" >
                                                                                    <option value="" >
                                                                                        Choisir un processus
                                                                                    </option>
                                                                                    @foreach($processuss as $processus)
                                                                                    <option value="{{$processus->id}}" >
                                                                                        {{$processus->nom}}
                                                                                    </option>
                                                                                    @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="controle">
                                                                            Risque
                                                                        </label>
                                                                        <div class="form-control-wrap">
                                                                            <input name="risque[]" value="0" type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input name="resume[]" value="0" type="text" >
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="controle">
                                                                            Action Corrective
                                                                        </label>
                                                                        <div class="form-control-wrap">
                                                                            <input placeholder="Saisie obligatoire" name="action[]" value="0" type="text" class="form-control" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="Coût">
                                                                                    Responsable
                                                                                </label>
                                                                                <select id="responsable_idc" required name="poste_id[]" class="form-select" >
                                                                                    <option selected value="1">
                                                                                        1
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="Coût">
                                                                                    Date prévisionnelle de réalisation
                                                                                </label>
                                                                                <div class="form-control-wrap">
                                                                                    <input name="date_action[]" value="2023-11-11" type="date" class="form-control" >
                                                                                </div>
                                                                            </div>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <div class="form-group text-center">
                                                                        <label class="form-label" for="description">
                                                                            Commentaire
                                                                        </label>
                                                                        <div class="form-control-wrap">
                                                                            <textarea name="commentaire[]" class="form-control no-resize" id="default-textarea">0</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="dynamic-fields">
                                
                            </div>
                            <div class="col-md-12 col-xxl-12" id="btn_enrg">
                                <div class="card card-bordered card-preview">
                                    <div class="card-inner row g-gs">
                                        <div class="col-12">
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-lg btn-success btn-dim ">
                                                    <em class="ni ni-check me-2"></em>
                                                    <em>Soumettre</em>
                                                </button >
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

    @foreach($causes_selects as $causes_select)
    <div class="modal fade" id="modalVucause{{$causes_select->id}}" tabindex="-1" aria-labelledby="modalVuLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Détails</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em
                                class="icon ni ni-cross"></em></a>
                    </div>
                    <div class="modal-body modal-body-lg">
                        <form class="nk-block" >
                            <div class="row g-gs">
                                <div class="col-md-12 col-xxl-4" id="groupesContainer">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                                <div class="row g-4">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Cause">
                                                                Processus
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $causes_select->nom_processus }}" readonly type="text" class="form-control" id="Cause">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="controle">
                                                                Risque
                                                                @if ($causes_select->statut === 'soumis')
                                                                    <span class="text-danger"> ( Non validé )</span>
                                                                @endif
                                                                @if ($causes_select->statut === 'valider')
                                                                    <span class="text-success"> ( Validé )</span>
                                                                @endif
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $causes_select->nom_risque }}" readonly type="text" class="form-control" id="controle">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 row g-2" style="margin-left:1px;">
                                    <div class="col-md-12">
                                        @if ($causes_select->evaluation >= 1 && $causes_select->evaluation <= 2 )
                                            <div class="card card-bordered h-100 border-white" style="background-color:#5eccbf;" >
                                        @endif
                                        @if ($causes_select->evaluation >= 3 && $causes_select->evaluation <= 9)
                                            <div class="card card-bordered h-100 border-white" style="background-color:#f7f880;">
                                        @endif
                                        @if ($causes_select->evaluation >= 10 && $causes_select->evaluation <= 16)
                                            <div class="card card-bordered h-100 border-white" style="background-color:#f2b171;">
                                        @endif
                                        @if ($causes_select->evaluation > 16)
                                            <div class="card card-bordered h-100 border-white" style="background-color:#ea6072;">
                                        @endif
                                            <div class="card-inner">
                                                <div class="card-head">
                                                    <h5 class="card-title">Evaluation risque sans dispositif de contrôle interne ou dispositif antérieur</h5>
                                                </div>
                                                <form action="#">
                                                    <div class="row g-4">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Cause">
                                                                    Vraisemblence
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $causes_select->vraisemblence }}" readonly type="text" class="form-control" id="Cause">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="controle">
                                                                    gravite
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $causes_select->gravite }}" readonly type="text" class="form-control" id="controle">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class="form-label" for="controle">
                                                                    Evaluation
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $causes_select->evaluation }}" readonly type="text" class="form-control" id="controle">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="controle">
                                                                    Coût
                                                                </label>
                                                                @php
                                                                    $cout2 = $causes_select->cout;
                                                                    $formatcommande2 = number_format($cout2, 0, '.', '.');
                                                                @endphp
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $formatcommande2 }} Fcfa" readonly type="text" class="form-control" id="controle">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($causesData2[$causes_select->risque_id] as $causeData2)
                                        <div class="col-md-12 col-xxl-4" id="groupesContainer">
                                            <div class="card card-bordered">
                                                <div class="card-inner">
                                                    <div class="row g-4">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Cause">
                                                                    Cause
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $causeData2['cause'] }}" readonly type="text" class="form-control" id="Cause">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="controle">
                                                                    Dispositif de Contrôle
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $causeData2['dispositif'] }}" readonly type="text" class="form-control" id="controle">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                @endforeach
                                <div class="col-md-12 row g-2" style="margin-left:1px;">
                                    <div class="col-md-12">
                                        @if ($causes_select->evaluation_residuel >= 1 && $causes_select->evaluation_residuel <= 2 )
                                            <div class="card card-bordered h-100 border-white" style="background-color:#5eccbf;" >
                                        @endif
                                        @if ($causes_select->evaluation_residuel >= 3 && $causes_select->evaluation_residuel <= 9)
                                            <div class="card card-bordered h-100 border-white" style="background-color:#f7f880;">
                                        @endif
                                        @if ($causes_select->evaluation_residuel >= 10 && $causes_select->evaluation_residuel <= 16)
                                            <div class="card card-bordered h-100 border-white" style="background-color:#f2b171;">
                                        @endif
                                        @if ($causes_select->evaluation_residuel > 16)
                                            <div class="card card-bordered h-100 border-white" style="background-color:#ea6072;">
                                        @endif
                                            <div class="card-inner">
                                                <div class="card-head">
                                                    <h5 class="card-title">Evaluation risque avec dispositif de contrôle interne actuel</h5>
                                                </div>
                                                <form action="#">
                                                    <div class="row g-4">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Cause">
                                                                    Vraisemblence
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $causes_select->vraisemblence_residuel }}" readonly type="text" class="form-control" id="Cause">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="controle">
                                                                    gravite
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $causes_select->gravite_residuel }}" readonly type="text" class="form-control" id="controle">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class="form-label" for="controle">
                                                                    Evaluation
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $causes_select->evaluation_residuel }}" readonly type="text" class="form-control" id="controle">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="controle">
                                                                    Coût
                                                                </label>
                                                                @php
                                                                    $cout2 = $causes_select->cout_residuel;
                                                                    $formatcommande2 = number_format($cout2, 0, '.', '.');
                                                                @endphp
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $formatcommande2 }} Fcfa" readonly type="text" class="form-control" id="controle">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="controle">
                                                                    Traitement
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $causes_select->traitement }}" readonly type="text" class="form-control" id="controle">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($actionsData2[$causes_select->risque_id] as $actionData2)

                                @if ($actionData2['type'] === 'preventive')
                                <div class="col-md-12 col-xxl-4" id="groupesAction">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                                <div class="row g-4">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="preventif">
                                                                Action préventive
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $actionData2['action'] }}" readonly type="text" class="form-control" id="preventif">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="email-address-1">
                                                                Délai
                                                            </label>
                                                            <div class="form-group">
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $actionData2['delai'] }}" readonly type="date" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="email-address-1">
                                                                Responsabilité
                                                            </label>
                                                            <div class="form-group">
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $actionData2['responsable'] }}" readonly type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="email-address-1">
                                                                Statut
                                                            </label>
                                                            <div class="form-group">
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $actionData2['statut'] }}" readonly type="text" class="form-control text-white text-center 
                                                                    @php
                                                                        if ($actionData2['statut'] ==='non-realiser') {
                                                                            echo 'bg-danger';
                                                                        } elseif ($actionData2['statut'] ==='realiser') {
                                                                            echo 'bg-success';
                                                                        }
                                                                    @endphp
                                                                    ">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @if ($actionData2['statut'] ==='realiser')

                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="email-address-1">
                                                                        Réaliser le 
                                                                    </label>
                                                                    <div class="form-group">
                                                                        <div class="form-control-wrap">
                                                                            <input value="{{ $actionData2['date_action'] }}" readonly type="date" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="email-address-1">
                                                                        Suivi éffectué le 
                                                                    </label>
                                                                    <div class="form-group">
                                                                        <div class="form-control-wrap">
                                                                            <input value="{{ $actionData2['date_suivi'] }}" readonly type="datetime" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="email-address-1">
                                                                        Efficacité 
                                                                    </label>
                                                                    <div class="form-group">
                                                                        <div class="form-control-wrap">
                                                                            <input value="{{ $actionData2['efficacite'] }}" readonly type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    @endif
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if ($actionData2['type'] === 'corrective')
                                <div class="col-md-12 col-xxl-4" id="groupesAction">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                                <div class="row g-4">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="corectif">
                                                                Action corrective
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $actionData2['action'] }}" readonly type="text" class="form-control" id="corectif">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="email-address-1">
                                                                Responsabilité
                                                            </label>
                                                            <div class="form-group">
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $actionData2['responsable'] }}" readonly type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @endforeach
                                <div class="col-md-12 col-xxl-4">
                                    <div class="card card-bordered card-preview">
                                        <div class="card-inner row g-gs">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="email-address-1">
                                                        Validateur
                                                    </label>
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <input value="{{$causes_select->validateur}}" readonly type="text" class="form-control">
                                                        </div>
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
    @endforeach

    <script>
        $(document).ready(function() {
            // Écoutez l'événement de changement de l'élément select
            $('#causeSelect').on('change', function() {
                // Récupérez la valeur sélectionnée
                var selectedValu = $(this).val();

                // Fermez tous les modals existants
                $('.modal').modal('hide');

                // Ouvrez le modal correspondant à la valeur sélectionnée
                $(`#modalVucause${selectedValu}`).modal('show');
            });
        });
    </script>

    <script>
        var postes = @json($postes);
        var processuss = @json($processuss);
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".action-new").forEach(function (button) {
                button.addEventListener("click", function () {
                    var type_new = this.getAttribute("data-type");
                    addGroup(type_new);
                });
            });
        });

        function addGroup(type_new) {

            var groupe = document.createElement("div");
            groupe.className = "card card-bordered";
            groupe.innerHTML = `
                                    <div class="card-inner">
                                        <div class="row g-4">
                                            <div class="col-lg-12 col-xxl-12" >
                                                <div class="card">
                                                    <div class="card-inner">
                                                        <div class="card-head">
                                                            <span class="badge badge-dot bg-primary">
                                                                Nouveau
                                                            </span>
                                                        </div>
                                                            <div class="row g-4">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="Cause">
                                                                            Processus
                                                                        </label>
                                                                        <input required style="display:none;" name="nature[]" value="new" type="text" >
                                                                        <select id="processus_id" required name="processus_id[]" class="form-select js-select2" placeholder="Choisir un processus" >
                                                                            <option selected value="" >
                                                                                
                                                                            </option>
                                                                            @foreach($processuss as $processus)
                                                                            <option value="{{$processus->id}}" >
                                                                                {{$processus->nom}}
                                                                            </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="controle">
                                                                            Risque
                                                                        </label>
                                                                        <div class="form-control-wrap">
                                                                            <input required placeholder="Saisie obligatoire" name="risque[]" type="text" class="form-control" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="controle">
                                                                            Résumé des causes
                                                                        </label>
                                                                        <div class="form-control-wrap">
                                                                            <input required placeholder="Saisie obligatoire" name="resume[]" type="text" class="form-control" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="controle">
                                                                            Action Corrective
                                                                        </label>
                                                                        <div class="form-control-wrap">
                                                                            <input required placeholder="Saisie obligatoire" name="action[]" type="text" class="form-control" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="Coût">
                                                                                    Responsable
                                                                                </label>
                                                                                <select required id="responsable_idc" required name="poste_id[]" class="form-select js-select2">
                                                                                    <option value="" >
                                                                                        Choisir le responsable
                                                                                    </option>
                                                                                    @foreach($postes as $poste)
                                                                                    <option value="{{$poste->id}}" >
                                                                                        {{$poste->nom}}
                                                                                    </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="Coût">
                                                                                    Date prévisionnelle de réalisation
                                                                                </label>
                                                                                <div class="form-control-wrap">
                                                                                    <input required name="date_action[]" type="date" class="form-control" >
                                                                                </div>
                                                                            </div>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <div class="form-group text-center">
                                                                        <label class="form-label" for="description">
                                                                            Commentaire
                                                                        </label>
                                                                        <div class="form-control-wrap">
                                                                            <textarea required name="commentaire[]" class="form-control no-resize" id="default-textarea"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="form-group text-center">
                                                                        <a class="btn btn-outline-danger btn-dim " id="suppr_nouvelle_action" >
                                                                            Supprimer
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            `;

            groupe.querySelector("#suppr_nouvelle_action").addEventListener("click", function(event) {
                event.preventDefault();
                groupe.remove();
            });

            document.getElementById("dynamic-fields").appendChild(groupe);

        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".action-accepte").forEach(function (button) {
                button.addEventListener("click", function () {
                    var type = this.getAttribute("data-type");
                    var selectedCause = $("#causeSelect").val();
                    var selectedRisque = $("#risqueSelect").val();
                    var choixSelect = $("input[name='choix_select']:checked").val();

                    if (choixSelect !== undefined) {
                        // Faites quelque chose avec la valeur sélectionnée
                        if (choixSelect === "cause") {
                            if (selectedCause !== '') {
                                $.ajax({
                                    url: '/get-cause-info/' + selectedCause,
                                    method: 'GET',
                                    success: function (data) {
                                        addGroups_accepte(type, data);
                                    },
                                    error: function () {
                                        toastr.error("Une erreur s'est produite lors de la récupération des informations.");
                                    }
                                });
                            }else{
                                toastr.warning("Veuillez sélectionner une cause.");
                            }
                        } else if (choixSelect === "risque") {
                            if (selectedRisque !== '') {
                                $.ajax({
                                    url: '/get-risque-info/' + selectedRisque,
                                    method: 'GET',
                                    success: function (data) {
                                        addGroups_accepte(type, data);
                                    },
                                    error: function () {
                                        toastr.error("Une erreur s'est produite lors de la récupération des informations.");
                                    }
                                });
                            }else{
                                toastr.warning("Veuillez sélectionner un risque.");
                            }
                        }
                    } else {
                        toastr.error("Veuillez préciser le choix de sélection.");
                    }
                });
            });
        });

        function addGroups_accepte(type, data) {
            // Récupérer l'élément qui contient les groupes
            var dynamicFields = document.getElementById("dynamic-fields");

            // Supprimer le contenu existant
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

            data.actions.forEach(function(action) {
                var groupe = document.createElement("div");
                groupe.className = "card card-bordered";
                groupe.innerHTML = `
                    <div class="card-inner">
                                        <div class="row g-4">
                                            <div class="col-lg-12 col-xxl-12" >
                                                <div class="card">
                                                    <div class="card-inner">
                                                        <div class="card-head">
                                                            <span class="badge badge-dot bg-success">
                                                                Accepté
                                                            </span>
                                                        </div>
                                                            <div class="row g-4">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="Cause">
                                                                            Processus
                                                                        </label>
                                                                        <input required style="display:none;" name="nature[]" value="accepte" type="text" >
                                                                        <div class="form-control-wrap">
                                                                            <input style="display:none;" name="processus_id[]" value="${action.processus_id}" type="text" class="form-control">
                                                                            <input value="${action.processus}" type="text" class="form-control" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="controle">
                                                                            Risque
                                                                        </label>
                                                                        <div class="form-control-wrap">
                                                                            <input required name="risque[]" value="${action.risque}" type="text" class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input required style="display:none;" name="resume[]" value="0" type="text" >
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="controle">
                                                                            Action Corrective
                                                                        </label>
                                                                        <div class="form-control-wrap">
                                                                            <input required name="action[]" value="${action.action}" type="text" class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="Coût">
                                                                                    Responsable
                                                                                </label>
                                                                                <input style="display:none;" name="poste_id[]" value="${action.poste_id}" type="text" class="form-control">
                                                                                <input value="${action.responsable}" type="text" class="form-control" disabled>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="Coût">
                                                                                    Date prévisionnelle de réalisation
                                                                                </label>
                                                                                <div class="form-control-wrap">
                                                                                    <input required name="date_action[]" type="date" class="form-control" >
                                                                                </div>
                                                                            </div>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <div class="form-group text-center">
                                                                        <label class="form-label" for="description">
                                                                            Commentaire
                                                                        </label>
                                                                        <div class="form-control-wrap">
                                                                            <textarea required name="commentaire[]" class="form-control no-resize" id="default-textarea"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="form-group text-center">
                                                                        <a class="btn btn-outline-danger btn-dim " id="suppr_action" >
                                                                            Supprimer
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                `;

                groupe.querySelector("#suppr_action").addEventListener("click", function(event) {
                    event.preventDefault();
                    groupe.remove();
                });

                document.getElementById("dynamic-fields").appendChild(groupe);
            });
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".action-non-accepte").forEach(function (button) {
                button.addEventListener("click", function () {
                    var type = this.getAttribute("data-type");
                    var selectedCause = $("#causeSelect").val();
                    var selectedRisque = $("#risqueSelect").val();
                    var choixSelect = $("input[name='choix_select']:checked").val();

                    if (choixSelect !== undefined) {
                        // Faites quelque chose avec la valeur sélectionnée
                        if (choixSelect === "cause") {
                            if (selectedCause !== '') {
                                $.ajax({
                                    url: '/get-cause-info/' + selectedCause,
                                    method: 'GET',
                                    success: function (data) {
                                        addGroups_non_accepte(type, data);
                                    },
                                    error: function () {
                                        toastr.error("Une erreur s'est produite lors de la récupération des informations.");
                                    }
                                });
                            }else{
                                toastr.warning("Veuillez sélectionner une cause.");
                            }
                        } else if (choixSelect === "risque") {
                            if (selectedRisque !== '') {
                                $.ajax({
                                    url: '/get-risque-info/' + selectedRisque,
                                    method: 'GET',
                                    success: function (data) {
                                        addGroups_non_accepte(type, data);
                                    },
                                    error: function () {
                                        toastr.error("Une erreur s'est produite lors de la récupération des informations.");
                                    }
                                });
                            }else{
                                toastr.warning("Veuillez sélectionner un risque.");
                            }
                        }
                    } else {
                        toastr.error("Veuillez préciser le choix de sélection.");
                    }
                });
            });
        });

        function addGroups_non_accepte(type, data) {
            // Récupérer l'élément qui contient les groupes
            var dynamicFields = document.getElementById("dynamic-fields");

            // Supprimer le contenu existant
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

            data.actions.forEach(function(action) {
                var groupe = document.createElement("div");
                groupe.className = "card card-bordered";
                groupe.innerHTML = `
                                    <div class="card-inner">
                                        <div class="row g-4">
                                            <div class="col-lg-12 col-xxl-12" >
                                                <div class="card">
                                                    <div class="card-inner">
                                                        <div class="card-head">
                                                            <span class="badge badge-dot bg-danger">
                                                                Non-accepté
                                                            </span>
                                                        </div>
                                                            <div class="row g-4">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="Cause">
                                                                            Processus
                                                                        </label>
                                                                        <input required style="display:none;" name="nature[]" value="non-accepte" type="text" >
                                                                        <div class="form-control-wrap">
                                                                            <input style="display:none;" name="processus_id[]" value="${action.processus_id}" type="text" class="form-control">
                                                                            <input value="${action.processus}" type="text" class="form-control" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="controle">
                                                                            Risque
                                                                        </label>
                                                                        <div class="form-control-wrap">
                                                                            <input required name="risque[]" value="${action.risque}" type="text" class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input required style="display:none;" name="resume[]" value="0" type="text" >
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="controle">
                                                                            Action Corrective
                                                                        </label>
                                                                        <div class="form-control-wrap">
                                                                            <input required placeholder="Saisie obligatoire" name="action[]" value="${action.action}" type="text" class="form-control" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="Coût">
                                                                                    Responsable
                                                                                </label>
                                                                                <select required id="responsable_idc" required name="poste_id[]" class="form-select" >
                                                                                    <option selected value="">
                                                                                        Choisir un responsable
                                                                                    </option>
                                                                                    ${postes.map(poste => `<option value="${poste.id}" ${action.poste_id == poste.id ? 'selected' : ''}>${poste.nom}</option>`).join('')}
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="Coût">
                                                                                    Date prévisionnelle de réalisation
                                                                                </label>
                                                                                <div class="form-control-wrap">
                                                                                    <input required name="date_action[]" type="date" class="form-control" >
                                                                                </div>
                                                                            </div>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <div class="form-group text-center">
                                                                        <label class="form-label" for="description">
                                                                            Commentaire
                                                                        </label>
                                                                        <div class="form-control-wrap">
                                                                            <textarea required name="commentaire[]" class="form-control no-resize" id="default-textarea"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="form-group text-center">
                                                                        <a class="btn btn-outline-danger btn-dim " id="suppr_action" >
                                                                            Supprimer
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                `;

                groupe.querySelector("#suppr_action").addEventListener("click", function(event) {
                    event.preventDefault();
                    groupe.remove();
                });

                document.getElementById("dynamic-fields").appendChild(groupe);
            });
        }
    </script>

    <!--<script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".action-accepte-new").forEach(function (button) {
                button.addEventListener("click", function () {
                    var type = this.getAttribute("data-type");
                    var selectedCause = $("#causeSelect").val();
                    var selectedRisque = $("#risqueSelect").val();
                    var choixSelect = $("input[name='choix_select']:checked").val();

                    if (choixSelect !== undefined) {
                        // Faites quelque chose avec la valeur sélectionnée
                        if (choixSelect === "cause") {
                            if (selectedCause !== '') {
                                addGroup(type_new);
                            }else{
                                toastr.warning("Veuillez sélectionner une cause.");
                            }
                        } else if (choixSelect === "risque") {
                            if (selectedRisque !== '') {
                                addGroup(type_new);
                            }else{
                                toastr.warning("Veuillez sélectionner un risque.");
                            }
                        }
                    } else {
                        toastr.error("Veuillez préciser le choix de sélection.");
                    }
                });
            });
        });

        function addGroup(type_new) {

            var groupe = document.createElement("div");
            groupe.className = "card card-bordered";
            groupe.innerHTML = `
                                    <div class="card-inner">
                                        <div class="row g-4">
                                            <div class="col-lg-12 col-xxl-12" >
                                                <div class="card">
                                                    <div class="card-inner">
                                                        <div class="card-head">
                                                            <span class="badge badge-dot bg-primary">
                                                                Nouveau
                                                            </span>
                                                        </div>
                                                            <div class="row g-4">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="Cause">
                                                                            Processus
                                                                        </label>
                                                                        <input style="display:none;" name="nature[]" value="action-new" type="text" >
                                                                        <input style="display:none;" name="resume[]" value="" type="text" >
                                                                        <select id="responsable_idc" required name="processus[]" class="form-select">
                                                                            <option selected value="">
                                                                                Choisir un responsable
                                                                            </option>
                                                                            ${processuss.map(processus => `<option value="${processus.id}">${processus.nom}</option>`).join('')}
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="controle">
                                                                            Risque
                                                                        </label>
                                                                        <div class="form-control-wrap">
                                                                            <input placeholder="Saisie obligatoire" name="risque[]" value="" type="text" class="form-control" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="controle">
                                                                            Action Corrective
                                                                        </label>
                                                                        <div class="form-control-wrap">
                                                                            <input placeholder="Saisie obligatoire" name="action[]" value="" type="text" class="form-control" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="Coût">
                                                                                    Responsable
                                                                                </label>
                                                                                <select id="responsable_idc" required name="poste_id[]" class="form-select">
                                                                                    <option selected value="">
                                                                                        Choisir un responsable
                                                                                    </option>
                                                                                    ${postes.map(poste => `<option value="${poste.id}">${poste.nom}</option>`).join('')}
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="Coût">
                                                                                    Date prévisionnelle de réalisation
                                                                                </label>
                                                                                <div class="form-control-wrap">
                                                                                    <input name="date_action[]" type="date" class="form-control" >
                                                                                </div>
                                                                            </div>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <div class="form-group text-center">
                                                                        <label class="form-label" for="description">
                                                                            Commentaire
                                                                        </label>
                                                                        <div class="form-control-wrap">
                                                                            <textarea name="commentaire[]" class="form-control no-resize" id="default-textarea"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="form-group text-center">
                                                                        <a class="btn btn-outline-danger btn-dim " id="suppr_nouvelle_action" >
                                                                            Supprimer
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            `;

            groupe.querySelector("#suppr_nouvelle_action").addEventListener("click", function(event) {
                event.preventDefault();
                groupe.remove();
            });

            document.getElementById("dynamic-fields").appendChild(groupe);
        }
    </script>-->

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Initial setup
            document.getElementById("groupesContainer_btn_trouve").style.display = "none";
            document.getElementById("groupesContainer_btn_new").style.display = "none";

            var selectedCause = $("#causeSelect").val();
            var selectedRisque = $("#risqueSelect").val();

            document.querySelectorAll(".choix_select").forEach(function (radio) {
                radio.addEventListener("change", function () {
                    var selectedValue = this.value;
                    if (selectedValue === "cause") {
                        document.getElementById("groupesContainer_btn_trouve").style.display = "block";
                        document.getElementById("groupesContainer_btn_new").style.display = "none";

                        var dynamicFields = document.getElementById("dynamic-fields");
                        // Supprimer le contenu existant
                        while (dynamicFields.firstChild) {
                            dynamicFields.removeChild(dynamicFields.firstChild);
                        }

                    } else if (selectedValue === "risque") {
                        document.getElementById("groupesContainer_btn_trouve").style.display = "block";
                        document.getElementById("groupesContainer_btn_new").style.display = "none";

                        var dynamicFields = document.getElementById("dynamic-fields");
                        // Supprimer le contenu existant
                        while (dynamicFields.firstChild) {
                            dynamicFields.removeChild(dynamicFields.firstChild);
                        }

                    } else if (selectedValue === "cause_risque_nt") {
                        document.getElementById("groupesContainer_btn_trouve").style.display = "none";
                        document.getElementById("groupesContainer_btn_new").style.display = "block";

                        var dynamicFields = document.getElementById("dynamic-fields");
                        // Supprimer le contenu existant
                        while (dynamicFields.firstChild) {
                            dynamicFields.removeChild(dynamicFields.firstChild);
                        }
                    }
                });
            });
        });
    </script>



@endsection
