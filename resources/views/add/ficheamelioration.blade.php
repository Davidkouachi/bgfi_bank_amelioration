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
                            <div class="col-md-12 col-xxl-12" id="groupesContainer">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                            <div class="row g-4">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Date 
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input readonly id="date" name="date_fiche" type="text" class="form-control text-center">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Nombre de jours de traitement
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <select id="nbre_jour" required name="nbre_jour" class="form-select " >
                                                                @for ($i = 1; $i <= 31; $i++)
                                                                    <option {{ $i === 5 ? 'selected' : '' }} value="{{ $i }}" >
                                                                        {{ $i }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Date limite de traitement
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input readonly id="date_limite" name="date_limite" type="text" class="form-control text-center">
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
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="controle">
                                                            Lieu
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input required placeholder="Saisie obligatoire" name="lieu" type="text" class="form-control" id="controle">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
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
                                                            <label class="form-label" >
                                                                Réclamation(s)
                                                            </label>
                                                            <div class="form-control-wrap" >
                                                            <textarea required name="reclamations" class="form-control no-resize" id="default-textarea"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row g-2" >
                                                        <div class="col-lg-6" >
                                                            <div class="form-group">
                                                                <label class="form-label" >
                                                                    Conséquence(s)
                                                                </label>
                                                                <div class="form-control-wrap" >
                                                                    <textarea required name="consequences" class="form-control no-resize" id="default-textarea"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6" >
                                                            <div class="form-group">
                                                                <label class="form-label" >
                                                                    Cause(s)
                                                                </label>
                                                                <div class="form-control-wrap" >
                                                                    <textarea required name="causes" class="form-control no-resize" id="default-textarea"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <select class="form-select js-select2 select_recla" id="causeRecla" data-search="on" data-placeholder="Recherche de Réclamation">
                                                                <option value="" >

                                                                </option>
                                                                @foreach($reclas as $recla)
                                                                <option value="{{$recla->id}}" >
                                                                    {{$recla->nom}}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12" id="div_choix_recla" >
                                                    <div class="row g-2" >
                                                        <div class="col-md-6" >
                                                            <div class="form-group text-center">
                                                                <div class="custom-control custom-radio">
                                                                    <input required type="radio" class="custom-control-input choix_recla" name="choix_recla" id="choixrecla" value="recla">
                                                                    <label class="custom-control-label" for="choixrecla">
                                                                        Réclamation trouvé
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6" >
                                                            <div class="form-group text-center">
                                                                <div class="custom-control custom-radio">
                                                                    <input required type="radio" class="custom-control-input choix_recla" name="choix_recla" id="choixreclant" value="recla_non_tr">
                                                                    <label class="custom-control-label" for="choixreclant">
                                                                        Réclamation non-trouvé
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-xxl-12" id="rechercheCause">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                            <div class="row g-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <select class="form-select js-select2 select_rech" id="causeSelect" data-search="on" data-placeholder="Recherche Cause">
                                                                <option value="" >

                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12" id="div_choix" >
                                                    <div class="row g-2" >
                                                        <div class="col-md-6" >
                                                            <div class="form-group text-center">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input choix_select" name="choix_select" id="choixcause" value="cause">
                                                                    <label class="custom-control-label" for="choixcause">
                                                                        Cause trouvé
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6" >
                                                            <div class="form-group text-center">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input choix_select" name="choix_select" id="choixnt" value="cause_nt">
                                                                    <label class="custom-control-label" for="choixnt">
                                                                        Cause non-trouvé
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-xxl-12" id="groupesContainer_btn_new_recla">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <div class="row g-4">
                                            <div class="col-lg-12"id="btn-non-trouve">
                                                <div class="form-group text-center">
                                                    <a class="btn btn-outline-primary btn-dim action-new" data-type="nouvelle-action">
                                                        Nouvelle Reclamation
                                                    </a>
                                                </div>
                                            </div>
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
                                                        Nouvelle action Cause
                                                    </a>
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

            document.getElementById("btn_enrg").style.display = "block";

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
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="Cause">
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
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="controle">
                                                                            Réclamation
                                                                        </label>
                                                                        <div class="form-control-wrap">
                                                                            <input required placeholder="Saisie obligatoire" name="reclamation[]" type="text" class="form-control" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="controle">
                                                                            Résumé des causes
                                                                        </label>
                                                                        <div class="form-control-wrap">
                                                                            <input required placeholder="Saisie obligatoire" name="cause[]" type="text" class="form-control" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group text-center">
                                                                        <label class="form-label" for="description">
                                                                            Action Corrective
                                                                        </label>
                                                                        <div class="form-control-wrap">
                                                                            <textarea required name="actions[]" class="form-control no-resize" id="default-textarea"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group text-center">
                                                                        <label class="form-label" for="description">
                                                                            Commentaire
                                                                        </label>
                                                                        <div class="form-control-wrap">
                                                                            <textarea required name="commentaires[]" class="form-control no-resize" id="default-textarea"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="controle">
                                                                            Résumé Action Corrective
                                                                        </label>
                                                                        <div class="form-control-wrap">
                                                                            <input required placeholder="Saisie obligatoire" name="action[]" type="text" class="form-control" >
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

                if (!groupe.hasChildNodes()) {
                    document.getElementById("btn_enrg").style.display = "none";
                }
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Initial setup
            document.getElementById("groupesContainer_btn_trouve").style.display = "none";
            document.getElementById("groupesContainer_btn_new").style.display = "none";
            document.getElementById("rechercheCause").style.display = "none";
            document.getElementById("groupesContainer_btn_new_recla").style.display = "none";
            document.getElementById("btn_enrg").style.display = "none";

            var selectedCause = $(".choix_select").val();
            var selectedRisque = $("#risqueSelect").val();

            var selectedCause = $("#causeSelect").val();
            var causeRecla = $("#causeRecla").val();

            var choixSelect = $("input[name='choix_select']:checked").val();

            document.querySelectorAll(".choix_recla").forEach(function (radio) {
                radio.addEventListener("change", function () {
                    var selectedValue = this.value;
                    if (selectedValue === "recla") {
                        if(causeRecla) {
                            document.getElementById("rechercheCause").style.display = "block";
                            document.getElementById("groupesContainer_btn_trouve").style.display = "none";
                            document.getElementById("groupesContainer_btn_new").style.display = "none";
                            document.getElementById("groupesContainer_btn_new_recla").style.display = "none";
                            document.getElementById("btn_enrg").style.display = "none";
                        } else {
                            toastr.warning("Veuillez sélectionner une réclamation.");
                            document.getElementById("groupesContainer_btn_trouve").style.display = "none";
                            document.getElementById("groupesContainer_btn_new").style.display = "none";
                            document.getElementById("groupesContainer_btn_new_recla").style.display = "none";
                            document.getElementById("btn_enrg").style.display = "none";

                            var dynamicFields = document.getElementById("dynamic-fields");
                            // Supprimer le contenu existant
                            while (dynamicFields.firstChild) {
                                dynamicFields.removeChild(dynamicFields.firstChild);
                            }
                        }
                        

                        var dynamicFields = document.getElementById("dynamic-fields");
                        // Supprimer le contenu existant
                        while (dynamicFields.firstChild) {
                            dynamicFields.removeChild(dynamicFields.firstChild);
                        }

                    } else if (selectedValue === "recla_non_tr") {
                        document.getElementById("rechercheCause").style.display = "none";
                        document.getElementById("groupesContainer_btn_trouve").style.display = "none";
                        document.getElementById("groupesContainer_btn_new_recla").style.display = "block";
                        document.getElementById("groupesContainer_btn_new").style.display = "none";
                        document.getElementById("btn_enrg").style.display = "none";

                        var dynamicFields = document.getElementById("dynamic-fields");
                        // Supprimer le contenu existant
                        while (dynamicFields.firstChild) {
                            dynamicFields.removeChild(dynamicFields.firstChild);
                        }

                    }
                });
            });

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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const selectedDays = parseInt(
                document.getElementById("nbre_jour").value,
            );
            const dateLimiteInput = document.getElementById("date_limite");
            const dateInput = document.getElementById("date");

            // Obtention de la date du jour en JavaScript
            function formatDate(dateString) {
                // Formatage de la date "aaaa-mm-jj" en "jj/mm/aaaa"
                const [year, month, day] = dateString.split("-");
                return `${year}-${month}-${day}`;
            }

            const currentDate = new Date();
            const formattedDate = formatDate(
                currentDate.toISOString().slice(0, 10),
            );
            dateInput.value = formattedDate;

            // Calcul de la date en fonction des jours sélectionnés
            const futureDate = new Date(currentDate);
            futureDate.setDate(currentDate.getDate() + selectedDays);
            const formattedFutureDate = formatDate(
                futureDate.toISOString().slice(0, 10),
            );

            // Mise à jour de la date limite de traitement initiale
            dateLimiteInput.value = formattedFutureDate;

            // Écoute des changements dans la sélection du nombre de jours
            document
                .getElementById("nbre_jour")
                .addEventListener("change", function () {
                    const selectedDays = parseInt(this.value);

                    // Calcul de la date en fonction des jours sélectionnés
                    const futureDate = new Date(currentDate);
                    futureDate.setDate(currentDate.getDate() + selectedDays);
                    const formattedFutureDate = formatDate(
                        futureDate.toISOString().slice(0, 10),
                    );

                    // Mise à jour des valeurs des champs de date en utilisant JavaScript
                    dateLimiteInput.value = formattedFutureDate;
                });
        });
    </script>



@endsection
