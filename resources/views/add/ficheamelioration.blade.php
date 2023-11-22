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

    <li class="dropdown user-dropdown">
        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#">
            <div class="user-toggle">
                <div class="user-avatar">
                    <em class="icon ni ni-plus"></em>
                </div>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1 is-light">
            <div class="dropdown-inner">
                <ul class="link-list">
                    <li class="mt-2" >
                        <a class="btn btn-md btn-primary text-white action-new" data-type="nouvelle-action" >
                            <em class="icon ni ni-plus"></em>
                            <span>
                                Réclamation
                            </span>
                        </a>
                    </li>
                    <li class="mt-2" >
                        <a class="btn btn-md btn-primary text-white action-new-cause" data-type="nouvelle-action-cause">
                            <em class="icon ni ni-plus"></em>
                            <span>
                                Cause
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
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
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <select name="select_recla" class="form-select js-select2 select_recla" id="selectRecla" data-search="on" data-placeholder="Recherche de Réclamation">
                                                                <option value="" >

                                                                </option>
                                                                @foreach($reclas as $recla)
                                                                <option value="{{$recla->id}}" >
                                                                    {{$recla->nom}}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                            <input type="text" id="slect_recla_id">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <select class="form-select js-select2 select_cause" id="selectCause" data-search="on" data-placeholder="Recherche de la cause">
                                                                <option value="" >

                                                                </option>
                                                                
                                                            </select>
                                                            <input type="text" id="slect_cause_id">
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
            document.querySelectorAll(".action-new-cause").forEach(function (button) {
                button.addEventListener("click", function () {
                    const slect_recla_id = document.getElementById("slect_recla_id");
                    var selectrecla = slect_recla_id.value;
                    if (selectrecla !== '') {
                        $.ajax({
                            url: '/get_cause_new/' + selectrecla,
                            method: 'GET',// Pass date1 and date2 to the server
                            success: function (data) {
                                addGroupscause(data);
                            },
                            error: function () {
                                toastr.error("Une erreur s'est produite lors de la récupération des informations.");
                            }
                        });
                    } else {
                        toastr.warning("Veuillez selectionner une réclamation.");
                    }

                });
            });
        });

        function addGroupscause(data) {

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
                                                                        <select readonly id="processus_id" required name="processus_id[]" class="form-select js-select2" placeholder="Choisir un processus" >
                                                                            ${processuss.map(proces => `<option value="${proces.id}" ${data.processus.id == proces.id ? 'selected' : ''}>${proces.nom}</option>`).join('')}
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
                                                                            ${postes.map(postes => `<option value="${postes.id}">${postes.nom}</option>`).join('')}
                                                                        </select>

                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="controle">
                                                                            Réclamation
                                                                        </label>
                                                                        <div class="form-control-wrap">
                                                                        <input style="display:none;" placeholder="Saisie obligatoire" name="reclamation_id[]" value="${data.reclamations.id}" type="text" class="form-control" >
                                                                        <input readonly value="${data.reclamations.nom}" type="text" class="form-control" >
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
        document.addEventListener("DOMContentLoaded", function() {
            // Initial setup
            document.getElementById("btn_enrg").style.display = "none";

            document.getElementById("slect_recla_id").style.display = "none";
            document.getElementById("slect_cause_id").style.display = "none";

            const slect_recla_id = document.getElementById("slect_recla_id");
            const slect_cause_id = document.getElementById("slect_cause_id");

            $(document).ready(function() {
                // Écoutez l'événement de changement de l'élément select
                $('#selectRecla').on('change', function() {
                    // Récupérez la valeur sélectionnée
                    var reclaValue = $(this).val();

                    if (reclaValue !== '') {

                        $.ajax({
                            url: '/get_cause/' +reclaValue,
                            method: 'GET',
                            success: function(response) {
                                if(response.error) {
                                    // Gérer l'erreur si aucune cause trouvée
                                    toastr.info("Aucune cause trouvée pour cette réclamation.");
                                } else {
                                    var nbre = response.nbre_cause;
                                    toastr.info(nbre + " cause trouvée pour cette réclamation.");
                                    var causes = response.causes;
                                    var selectCause = $('#selectCause');
                                    selectCause.empty();
                                    // Mettre à jour le deuxième select avec les causes
                                    selectCause.append('<option value=""> </option>');
                                    $.each(causes, function(index, cause) {
                                        selectCause.append('<option value="' + cause.id + '">' + cause.nom + '</option>');
                                    });
                                    slect_recla_id.value = reclaValue;
                                }
                            },
                            error: function(xhr, status, error) {
                                // Gérer les erreurs de requête AJAX
                                console.error(error);
                            }
                        });

                    }

                });
            });

            $(document).ready(function() {
                // Écoutez l'événement de changement de l'élément select
                $('#selectCause').on('change', function() {

                    var dynamicFields = document.getElementById("dynamic-fields");
                    // Supprimer le contenu existant
                    while (dynamicFields.firstChild) {
                        dynamicFields.removeChild(dynamicFields.firstChild);
                    }

                    // Récupérez la valeur sélectionnée
                    var causeValue = $(this).val();

                    if (causeValue !== '') {

                        $.ajax({
                            url: '/get_action/' +causeValue,
                            method: 'GET',
                            success: function(response) {
                                if(response.error) {
                                    // Gérer l'erreur si aucune cause trouvée
                                    toastr.info("Aucune action trouvée pour cette cause.");
                                } else {
                                    var nbre = response.nbre_action;
                                    toastr.info(nbre + " action(s) trouvée(s) pour cette cause.");
                                    var actions = response.actions;

                                    addGroups_action(response);

                                    slect_cause_id.value = causeValue;

                                }
                            },
                            error: function(xhr, status, error) {
                                // Gérer les erreurs de requête AJAX
                                console.error(error);
                            }
                        });

                    }

                });
            });

            document.querySelectorAll(".choix_recla").forEach(function(radio) {
                radio.addEventListener("change", function() {
                    var selectedValue = this.value;

                    if (selectedValue === "recla_non_tr") {
                        document.getElementById("groupesContainer_btn_trouve").style.display = "none";
                        document.getElementById("btn_enrg").style.display = "none";

                        var dynamicFields = document.getElementById("dynamic-fields");
                        // Supprimer le contenu existant
                        while (dynamicFields.firstChild) {
                            dynamicFields.removeChild(dynamicFields.firstChild);
                        }
                    } else if (selectedValue === "cause_non_tr") {

                        document.getElementById("groupesContainer_btn_trouve").style.display = "none";
                        document.getElementById("btn_enrg").style.display = "none";

                        var dynamicFields = document.getElementById("dynamic-fields");
                        // Supprimer le contenu existant
                        while (dynamicFields.firstChild) {
                            dynamicFields.removeChild(dynamicFields.firstChild);
                        }
                    }
                });
            });
        });

                                    function addGroups_action(response) {
                                        // Récupérer l'élément qui contient les groupes
                                        var dynamicFields = document.getElementById("dynamic-fields");

                                        // Supprimer le contenu existant
                                        while (dynamicFields.firstChild) {
                                            dynamicFields.removeChild(dynamicFields.firstChild);
                                        }

                                        document.getElementById("btn_enrg").style.display = "block";

                                        response.actions.forEach(function(action) {
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
                                                                            Action
                                                                        </span>
                                                                    </div>
                                                                    <div class="row g-4">
                                                                        <input style="display:none;" name="nature[]" value="cause_trouver" type="text" >
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="Cause">
                                                                                    Processus
                                                                                </label>
                                                                                <select id="processus_id" required name="processus_id[]" class="form-select js-select2" placeholder="Choisir un processus" >
                                                                                    <option selected value="" >
                                                                                        Choisir un processus
                                                                                    </option>
                                                                                    ${processuss.map(processus => `<option value="${processus.id}" ${action.processus_id == processus.id ? 'selected' : ''}>${processus.nom}</option>`).join('')}
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="Coût">
                                                                                    Responsable
                                                                                </label>
                                                                                <select required id="responsable_idc" required name="poste_id[]" class="form-select" >
                                                                                    <option selected value="">
                                                                                        Choisir un responsable
                                                                                    </option>
                                                                                    ${postes.map(poste => `<option value="${poste.id}" ${action.responsable_id == poste.id ? 'selected' : ''}>${poste.nom}</option>`).join('')}
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="controle">
                                                                                    Réclamation
                                                                                </label>
                                                                                <div class="form-control-wrap">
                                                                                    <input style="display:none;" name="reclamation_id[]" value="${action.reclamation_id}" type="text" class="form-control" >
                                                                                    <input required placeholder="Saisie obligatoire" name="reclamation[]" value="${action.reclamation}" type="text" class="form-control" >
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="controle">
                                                                                    Cause
                                                                                </label>
                                                                                <div class="form-control-wrap">
                                                                                    <input style="display:none;" name="cause_id[]" value="${action.cause_id}" type="text" class="form-control" >
                                                                                    <input required placeholder="Saisie obligatoire" name="cause[]" value="${action.cause}" type="text" class="form-control" >
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="controle">
                                                                                    Action Corrective
                                                                                </label>
                                                                                <div class="form-control-wrap">
                                                                                    <input style="display:none;" name="action_id[]" value="${action.id}" type="text" class="form-control" >
                                                                                    <input required placeholder="Saisie obligatoire" name="action[]" value="${action.nom}" type="text" class="form-control" >
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group text-center">
                                                                                <label class="form-label" for="description">
                                                                                    Action Corrective
                                                                                </label>
                                                                                <div class="form-control-wrap">
                                                                                    <textarea required name="actions[]" class="form-control no-resize" id="default-textarea">${action.actions}</textarea>
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
                                                document.getElementById("btn_enrg").style.display = "none";
                                            });

                                            document.getElementById("dynamic-fields").appendChild(groupe);
                                        });
                                    }

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
