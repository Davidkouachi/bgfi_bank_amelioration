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
                        <a class="btn btn-md btn-info text-white action-new" data-type="nouvelle-action" >
                            <em class="icon ni ni-plus"></em>
                            <span>
                                Réclamation
                            </span>
                        </a>
                    </li>
                    <li class="mt-2" >
                        <a class="btn btn-md btn-warning text-white action-new-cause" data-type="nouvelle-action-cause">
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
                                            <span>Nouvelle réclamation</span>
                                            <em class="icon ni ni-reports"></em>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                    <form class="nk-block" id="form" method="post" action="{{ route('index_add') }}">
                        @csrf
                        <div class="row g-gs">
                            <div class="col-lg-6 col-xxl-6" >
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                            <div class="row g-4">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Date 
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input id="date" name="date_fiche" type="date" class="form-control text-center" value="{{ \Carbon\Carbon::now()->toDateString() }}" onchange="checkDate()" max="{{ \Carbon\Carbon::now()->toDateString() }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Nombre de jours
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
                                                            Date limite
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
                            <div class="col-lg-6 col-xxl-6" >
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
                            <div class="col-md-12 col-xxl-12" >
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
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-xxl-12" >
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                            <div class="row g-4">
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
                                                            <input type="text" id="slect_cause_id" name="select_cause">
                                                        </div>
                                                    </div>
                                                </div>
                                                    <div class="col-lg-12" id="div_choix">
                                                        <div class="row g-2">
                                                            <div class="col-md-4">
                                                                <div class="form-group text-center">
                                                                    <div class="custom-control custom-radio">
                                                                        <input required type="radio" class="custom-control-input choix_select" name="choix_select" id="choixrecla" value="reclamation">
                                                                        <label class="custom-control-label" for="choixrecla">
                                                                            Réclamation trouvé
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group text-center">
                                                                    <div class="custom-control custom-radio">
                                                                        <input required type="radio" class="custom-control-input choix_select" name="choix_select" id="choixcause" value="cause">
                                                                        <label class="custom-control-label" for="choixcause">
                                                                            Cause trouvé
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group text-center">
                                                                    <div class="custom-control custom-radio">
                                                                        <input required type="radio" class="custom-control-input choix_select" name="choix_select" id="choixneant" value="neant">
                                                                        <label class="custom-control-label" for="choixneant">
                                                                            Néant
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
                            <div id="dynamic-fields">

                            </div>

                            <div class="row g-gs" id="btn_enrg" >
                                <div class="col-lg-12 col-xxl-12">
                                    <div class="card card-bordered card-preview">
                                        <div class="card-inner">
                                            <div class="card-head">
                                                <h5 class="card-title">
                                                    Notification
                                                </h5>
                                            </div>
                                            <div class="row g-gs">
                                                <div class="col-lg-4 text-left">
                                                    <div class="custom-control custom-checkbox">
                                                        <input readonly name="choix_alert_alert" value="alert" required type="checkbox" checked class="custom-control-input" id="customCheck1">
                                                        <label class="custom-control-label" for="customCheck1">Alert à l'écran</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 text-left">
                                                    <div class="custom-control custom-checkbox">
                                                        <input name="choix_alert_email" value="email" type="checkbox" class="custom-control-input" id="customCheck2">
                                                        <label class="custom-control-label" for="customCheck2">Par Email</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 text-left">
                                                    <div class="custom-control custom-checkbox">
                                                        <input name="choix_alert_sms" value="sms" disabled type="checkbox" class="custom-control-input" id="customCheck3">
                                                        <label class="custom-control-label" for="customCheck3">Par Sms</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-LG-12 col-xxl-12" >
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
                                                            <span class="badge badge-dot bg-success">
                                                                Nouvelle Réclamation
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
                                                                            Résumé des réclamations
                                                                        </label>
                                                                        <div class="form-control-wrap">
                                                                            <input required placeholder="Saisie obligatoire" name="reclamation[]" type="text" class="form-control" >
                                                                            <input style="display:none;" name="reclamation_id[]" type="text" value="0" >
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
                                                                            <input style="display:none;" name="cause_id[]" type="text" value="0" >
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
                                                                            <input style="display:none;" name="action_id[]" type="text" value="0" >
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

                checkAndHideSubmitButton()
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
                                                            <span class="badge badge-dot bg-success">
                                                                Nouvelle Cause
                                                            </span>
                                                        </div>
                                                            <div class="row g-4">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="Cause">
                                                                            Processus
                                                                        </label>
                                                                        <input required style="display:none;" name="nature[]" value="new_cause" type="text" >
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
                                                                            Résumé des réclamations
                                                                        </label>
                                                                        <div class="form-control-wrap">
                                                                        <input style="display:none;" placeholder="Saisie obligatoire" name="reclamation_id[]" value="${data.reclamations.id}" type="text" class="form-control" >
                                                                        <input readonly name="reclamation[]" value="${data.reclamations.nom}" type="text" class="form-control" >
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
                                                                            <input style="display:none;" name="cause_id[]" type="text" value="0" >
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
                                                                            <input style="display:none;" name="action_id[]" type="text" value="0" >
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

                checkAndHideSubmitButton()
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

            document.querySelectorAll(".").forEach(function(radio) {
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
                                                                        <input style="display:none;" name="nature[]" value="trouve" type="text" >
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="Cause">
                                                                                    Processus
                                                                                </label>
                                                                                <select disabled id="processus_id" required name="processus_id[]" class="form-select js-select2" placeholder="Choisir un processus" >
                                                                                    ${processuss.map(processus => `<option value="${processus.id}" ${action.processus_id == processus.id ? 'selected' : ''}>${processus.nom}</option>`).join('')}
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
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
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="controle">
                                                                                    Résumé des réclamations
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

                                                checkAndHideSubmitButton()
                                            });

                                            document.getElementById("dynamic-fields").appendChild(groupe);
                                        });
                                    }

    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Écoute des changements sur le champ de date et le champ du nombre de jours
            document.getElementById('date').addEventListener('change', updateDateLimite);
            document.getElementById('nbre_jour').addEventListener('change', updateDateLimite);

            function updateDateLimite() {
                var dateDebut = document.getElementById('date').value;
                var nbreJours = parseInt(document.getElementById('nbre_jour').value);

                // Vérification si la date de début est sélectionnée et le nombre de jours est valide
                if (dateDebut && !isNaN(nbreJours)) {
                    var dateLimite = new Date(dateDebut);
                    dateLimite.setDate(dateLimite.getDate() + nbreJours);

                    // Extraction des éléments de date individuels
                    var jour = ('0' + dateLimite.getDate()).slice(-2); // Jour
                    var mois = ('0' + (dateLimite.getMonth() + 1)).slice(-2); // Mois (ajouter +1 car les mois commencent à 0)
                    var annee = dateLimite.getFullYear(); // Année

                    // Formatage de la date au format dd/mm/aaaa
                    var formattedDate = jour + '/' + mois + '/' + annee;

                    // Mettre à jour la valeur du champ "Date limite de traitement"
                    document.getElementById('date_limite').value = formattedDate;
                }
            }

            // Appel initial pour mettre à jour la date limite lors du chargement de la page
            updateDateLimite();
        });
    </script>

    <script>
        function checkAndHideSubmitButton() {
        var dynamicFields = document.getElementById("dynamic-fields");
        var btnEnrg = document.getElementById("btn_enrg");

        if (dynamicFields.innerHTML.trim() === "") {
            // Si vide, cacher le bouton "Soumettre"
            btnEnrg.style.display = "none";
        } else {
            // Sinon, afficher le bouton "Soumettre"
            btnEnrg.style.display = "block";
        }
    }
    </script>




@endsection
