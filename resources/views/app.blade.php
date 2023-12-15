<!DOCTYPE html>
<html class="js" lang="fr">
<meta content="text/html;charset=utf-8" http-equiv="content-type">

<head>
    <meta charset="utf-8">
    <meta content="Softnio" name="author">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" >
    <meta
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers."
        name="description">
    <link href="{{asset('BGFI_logo.png')}}" rel="shortcut icon">
    <title>@yield('titre')</title>
    <link href="assets/css/dashlite0226.css?" rel="stylesheet">
    <link href="assets/css/theme0226.css" rel="stylesheet">
    <script src="{{asset('chart.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('pusher.min.js') }}"></script>
    </link>
    </link>
    </link>
    </meta>
    </meta>
    </meta>
    </meta>
</head>

<body class="nk-body bg-lighter ">
    <div class="nk-app-root">
        <div class="nk-wrap ">
            <div class="nk-header is-light nk-header-fixed">
                <div class="container-fluid">
                    <div class="nk-header-wrap">
                        <div class="nk-menu-trigger me-sm-2 d-lg-none">
                            <a class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav" href="#">
                                <em class="icon ni ni-menu"></em>
                            </a>
                        </div>
                        <div class="nk-header-brand">
                            <a class="logo-link" href="{{ route('index_accueil') }}">
                                <img alt="logo-dark" class="logo-dark logo-img" src="{{asset('BGFI_logo.png')}}">
                                </img>
                            </a>
                        </div>
                        <div class="nk-header-menu ms-auto" data-content="headerNav">
                            <div class="nk-header-mobile">
                                <div class="nk-header-brand">
                                    <a class="logo-link" href="index-2.html">
                                        <img alt="logo-dark" class="logo-dark logo-img" src="{{asset('BGFI_logo.png')}}">
                                        </img>
                                    </a>
                                </div>
                                <div class="nk-menu-trigger me-n2">
                                    <a class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav" href="#">
                                        <em class="icon ni ni-arrow-left"></em>
                                    </a>
                                </div>
                            </div>
                            @if (Auth::check())
                            <ul class="nk-menu nk-menu-main ui-s2">
                                @if (session('user_auto')->new_user === 'oui' || session('user_auto')->new_poste === 'oui' || session('user_auto')->historiq === 'oui' || session('user_auto')->stat === 'oui')
                                <li class="nk-menu-item has-sub">
                                    <a class="nk-menu-toggle btn " >
                                        <em class="ni ni-building me-2"></em>
                                        <span class="nk-menu-text text-dark">
                                            Administration
                                        </span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        @if (session('user_auto')->new_user === 'oui')
                                        <li >
                                            <a class="nk-menu-link" href="{{ route('index_add_resva') }}">
                                                <em class="icon ni ni-user-add me-1"></em>
                                                <span class="nk-menu-text ">
                                                    Nouveau utilisateur
                                                </span>
                                            </a>
                                        </li>
                                        @endif
                                        @if (session('user_auto')->list_user === 'oui')
                                        <li >
                                            <a class="nk-menu-link" href="{{ route('index_liste_resva') }}">
                                                <em class="icon ni ni-list me-1"></em>
                                                <span class="nk-menu-text ">
                                                    Liste des utilisateurs
                                                </span>
                                            </a>
                                        </li>
                                        @endif
                                        @if (session('user_auto')->new_poste === 'oui')
                                        <li >
                                            <a data-bs-toggle="modal" data-bs-target="#modalPoste" class="nk-menu-link">
                                                <em class="ni ni-reports-alt me-1"></em>
                                                <span class="nk-menu-text ">
                                                    Nouveau poste
                                                </span>
                                            </a>
                                        </li>
                                        @endif
                                        @if (session('user_auto')->list_poste === 'oui')
                                        <li >
                                            <a href="{{ route('index_liste_poste') }}" class="nk-menu-link">
                                                <em class="ni ni-list me-1"></em>
                                                <span class="nk-menu-text ">
                                                    Liste des postes
                                                </span>
                                            </a>
                                        </li>
                                        @endif
                                        @if (session('user_auto')->historiq === 'oui')
                                        <li>
                                            <a class="nk-menu-link" href="{{ route('index_historique') }}">
                                                <em class="icon ni ni-property me-1"></em>
                                                <span class="nk-menu-text " >
                                                    historique
                                                </span>
                                            </a>
                                        </li>
                                        @endif
                                        @if (session('user_auto')->stat === 'oui')
                                        <li>
                                            <a class="nk-menu-link" href="{{ route('index_stat') }}" >
                                                <em class="ni ni-bar-chart-alt me-1"></em>
                                                <span class="nk-menu-text ">
                                                    statistique
                                                </span>
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                                </li>
                                @endif
                                @if (session('user_auto')->new_proces === 'oui' || session('user_auto')->list_proces === 'oui')
                                <li class="nk-menu-item has-sub">
                                    <a class="nk-menu-toggle btn " >
                                        <em class="ni ni-share-alt me-2"></em>
                                        <span class="nk-menu-text text-dark">
                                            Processus
                                        </span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        @if (session('user_auto')->new_proces === 'oui')
                                        <li >
                                            <a class="nk-menu-link" href="{{ route('index_add_processus') }}">
                                                <em class="icon ni ni-property-add me-1"></em>
                                                <span class="nk-menu-text ">
                                                    Nouveau processus
                                                </span>
                                            </a>
                                        </li>
                                        @endif
                                        @if (session('user_auto')->list_proces === 'oui')
                                        <li >
                                            <a class="nk-menu-link" href="{{ route('index_listeprocessus') }}">
                                                <em class="ni ni-list-index me-1"></em>
                                                <span class="nk-menu-text ">
                                                    Liste des processus
                                                </span>
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                                </li>
                                @endif
                                @if (session('user_auto')->new_recla === 'oui' || session('user_auto')->list_recla === 'oui')
                                <li class="nk-menu-item has-sub">
                                    <a class=" nk-menu-toggle btn " >
                                        <em class="icon ni ni-reports me-2"></em>
                                        <span class="nk-menu-text text-dark">
                                            Réclamation
                                        </span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        @if (session('user_auto')->new_recla === 'oui')
                                        <li class="nk-menu-item">
                                            <a class="nk-menu-link" href="{{ route('index_amelioration') }}">
                                                <em class="icon ni ni-view-list-sq me-1"></em>
                                                <span class="nk-menu-text">
                                                    Nouvelle Réclamation
                                                </span>
                                            </a>
                                        </li>
                                        @endif
                                        @if (session('user_auto')->list_recla === 'oui')
                                        <li class="nk-menu-item">
                                            <a class="nk-menu-link" href="{{ route('index_listereclamation') }}">
                                                <em class="ni ni-list-index me-1"></em>
                                                <span class="nk-menu-text">
                                                    Liste des réclamations
                                                </span>
                                            </a>
                                        </li>
                                        @endif
                                        <li class="nk-menu-item">
                                            <a class="nk-menu-link" href="{{ route('index_validation_recla') }}">
                                                <em class="ni ni-file-docs me-1"></em>
                                                <span class="nk-menu-text">
                                                    Verification des Réclamations
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a class="nk-menu-link" href="{{ route('index_non_accepte') }}">
                                                <em class="ni ni-row-view me-1"></em>
                                                <span class="nk-menu-text">
                                                    Réclamations non accéptées
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endif
                                @if (session('user_auto')->list_cause === 'oui')
                                <li class="nk-menu-item has-sub">
                                    <a class="nk-menu-toggle btn " >
                                        <em class="ni ni-focus me-2"></em>
                                        <span class="nk-menu-text text-dark">
                                            Causes
                                        </span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        @if (session('user_auto')->list_cause === 'oui')
                                        <li class="nk-menu-item">
                                            <a class="nk-menu-link" href="{{ route('index_listecause') }}">
                                                <em class="ni ni-list-index me-1"></em>
                                                <span class="nk-menu-text">
                                                    Liste des causes
                                                </span>
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                                </li>
                                @endif
                                @if (session('user_auto')->suivi_act === 'oui' || session('user_auto')->act_eff === 'oui' || session('user_auto')->list_act === 'oui')
                                <li class="nk-menu-item has-sub">
                                    <a class="nk-menu-toggle btn " >
                                        <em class="ni ni-box-view-fill me-2"></em>
                                        <span class="nk-menu-text text-dark">
                                            Actions
                                        </span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        @if (session('user_auto')->suivi_act === 'oui')
                                        <li class="nk-menu-item">
                                            <a class="nk-menu-link" href="{{ route('index_suiviaction') }}">
                                                <em class="icon ni ni-view-list-sq me-1"></em>
                                                <span class="nk-menu-text">
                                                    Contrôle des actions
                                                </span>
                                            </a>
                                        </li>
                                        @endif
                                        @if (session('user_auto')->act_eff === 'oui')
                                        <li class="nk-menu-item">
                                            <a class="nk-menu-link" href="{{ route('index_listeactioneffectuer') }}">
                                                <em class="icon ni ni-view-list-sq me-1"></em>
                                                <span class="nk-menu-text">
                                                    Actions éffectuées
                                                </span>
                                            </a>
                                        </li>
                                        @endif
                                        @if (session('user_auto')->list_act === 'oui')
                                        <li class="nk-menu-item">
                                            <a class="nk-menu-link" href="{{ route('index_listeaction') }}">
                                                <em class="ni ni-list-index me-1"></em>
                                                <span class="nk-menu-text">
                                                    Liste des actions
                                                </span>
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                                </li>
                                @endif
                                @yield('menu')
                            </ul>
                            @endif
                        </div>
                        <div class="nk-header-tools">
                            <ul class="nk-quick-nav">
                                @yield('option_btn')
                                @if (Auth::check())
                                <li class="dropdown user-dropdown">
                                    <a class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <div class="user-toggle">
                                            <div class="user-avatar">
                                                <em class="icon ni ni-user-alt"></em>
                                            </div>
                                            <div class="user-info">
                                                <div class="user-status text-primary"> </div>
                                                <div class="user-name dropdown-indicator">
                                                    {{ session('user_poste')->nom }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div
                                        class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1 is-light">
                                        <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                            <div class="user-card">
                                                <div class="user-avatar">
                                                    <span>
                                                        <em class="icon ni ni-user-alt"></em>
                                                    </span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text">
                                                        {{ Auth::user()->name }}
                                                    </span>
                                                    <span class="sub-text">
                                                        {{ Auth::user()->email }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li>
                                                    <a href="{{ route('index_profil') }}">
                                                        <em class="icon ni ni-user-alt"></em>
                                                        <span>
                                                            Voir Profil
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('index_historique_profil')}}">
                                                        <em class="icon ni ni-activity-alt"></em>
                                                        <span>
                                                            Activité
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li>
                                                    <a href="{{ route('logout') }}">
                                                        <em class="icon ni ni-signout"></em>
                                                        <span>
                                                            Se déconnecter
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            @yield('content')

            <div class="nk-footer bg-white">
                <div class="container-fluid">
                    <div class="nk-footer-wrap">
                        <div class="nk-footer-copyright">
                            © 2023 BGFIBank.
                            <img height="30" width="130" src="{{asset('BGFI_logo.jpg')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="modal fade" tabindex="-1" id="modalAlert2" aria-modal="true" style="position: fixed;" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body modal-body-lg text-center">
                        <div class="nk-modal">
                            <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                            <h4 class="nk-modal-title">Session Expiré!</h4>
                            <div class="nk-modal-action mt-5">
                                <a href="{{ route('logout') }}" class="btn btn-lg btn-mw btn-light">
                                    ok
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--<script>
            let idleTimer;
            const idleTime = 60000; 

            function resetIdleTimer() {
                clearTimeout(idleTimer);
                idleTimer = setTimeout(showLogoutModal, idleTime);
            }

            function showLogoutModal() {
                $('#modalAlert2').modal('show');
            }

            document.addEventListener('mousemove', resetIdleTimer);
            document.addEventListener('keypress', resetIdleTimer);
        </script>-->

    <script src="{{asset('assets/js/bundle0226.js')}}"></script>
    <script src="{{asset('assets/js/scripts0226.js')}}"></script>
    <script src="{{asset('assets/js/demo-settings0226.js')}}"></script>
    <script src="{{asset('assets/js/libs/datatable-btns0226.js')}}"></script>

    <link href="{{asset('notification/toastr.min.css')}}" rel="stylesheet">
    <script src="{{asset('notification/toastr.min.js')}}"></script>

    <div class="modal fade zoom" tabindex="-1" id="modalPoste">
        <div class="modal-dialog modal-md" role="document" style="width: 100%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nouveau Poste</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
                </div>
                <div class="modal-body">
                    <form id="processus-form" method="post" action="{{ route('index_add_poste_traitement') }}">
                        @csrf
                        <div class="row g-4 mb-4" id="poste-container">
                            <div class="col-lg-12">
                                <div class="form-group text-center">
                                    <label class="form-label" for="poste">
                                        Poste(s)
                                    </label>
                                    <div class="form-control-wrap">
                                        <input placeholder="Saisie obligatoire" required type="text" class="form-control text-center poste" name="nom[]" oninput="this.value = this.value.toUpperCase()">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-gs">
                            <div class="col-lg-6">
                                <div class="form-group text-center">
                                    <button type="button" class="btn btn-lg btn-primary btn-dim" id="ajouter-poste">
                                        <em class="ni ni-plus me-2"></em>
                                        <em>Ajouter</em>
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-lg btn-success btn-dim">
                                        <em class="ni ni-check me-2"></em>
                                        <em>Enregistrer</em>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('ajouter-poste').addEventListener('click', function(event) {
            event.preventDefault();
            const container = document.getElementById('poste-container');
            const div = document.createElement('div');
            div.classList.add('col-lg-12');
            div.innerHTML = `
            <div class="row g-g2" >
                <div class=" col-md-12 form-group">
                    <div class="form-control-wrap">
                        <input placeholder="Saisie obligatoire" required type="text" class="form-control text-center objectif me-2" name="nom[]" oninput="this.value = this.value.toUpperCase()">
                    </div>
                </div>
                <div class=" col-md-12 form-group text-center">
                    <div class="form-control-wrap">
                        <button type="button" class="btn btn-danger btn-dim text-center btn-remove-poste">
                            <em class="ni ni-trash me-2"></em>
                            <em>Supprimer</em>
                        </button>
                    </div>
                </div>
            </div>
            `;
            container.appendChild(div);

            // Ajouter un écouteur d'événement pour supprimer l'objectif
            div.querySelector('.btn-remove-poste').addEventListener('click', function() {
                container.removeChild(div);
            });
        });
    </script>


    <!--<script>
        // Check if the browser supports the Notification API
        if ("Notification" in window) {
            // Request permission to show notifications
            Notification.requestPermission().then(function (permission) {
                if (permission === "granted") {
                    // Check if the notification has already been shown
                    if (!localStorage.getItem('notificationShown')) {
                        // Permission has been granted, create a notification
                        var notification = new Notification("Notification!", {
                            icon: "BGFI_logo.png", // Replace with the path to your icon
                            body: "Nouvelle action corrective.",
                        });

                        // Set a flag in local storage to indicate that the notification has been shown
                        //localStorage.setItem('notificationShown', 'true');
                    }
                } else {
                    console.warn("Notification permission denied");
                }
            });
        } else {
            console.warn("Notifications not supported in this browser");
        }
    </script>-->

    <!--<script>
        // Fonction pour interroger le contrôleur Laravel
        function checkForCorrectiveAction() {
            $.ajax({
                url: '/check_actions',
                method: 'GET',
                success: function (data) {
                    data.preventDefault();
                    if (data.msg === 'oui') {
                        // Afficher la notification uniquement s'il y a une action corrective et pas déjà affichée
                        //if (!sessionStorage.getItem('correctiveActionShown')) {
                            Swal.fire({
                                title: "Information!",
                                text: "Nouvelle(s) action(s) corrective a valider",
                                icon: "info",
                                showCancelButton: false,
                                confirmButtonColor: "#3085d6",
                                confirmButtonText: "OK",
                                allowOutsideClick: false // Empêche la fermeture en cliquant à l'extérieur
                            }).then((result) => {
                                // Si l'utilisateur clique sur le bouton "OK"
                                if (result.isConfirmed) {
                                    // Requête AJAX pour effectuer la modification dans le contrôleur Laravel
                                    $.ajax({
                                        url: '/update_action_type',
                                        method: 'GET',
                                        success: function () {
                                            // Recharger la page après la mise à jour
                                            location.reload();
                                        }
                                    });
                                }
                            });


                            // Enregistrer dans sessionStorage pour ne pas répéter le message
                            //sessionStorage.setItem('correctiveActionShown', 'true');
                        //}
                    } //else {
                        // S'il n'y a pas d'action corrective, effacer le sessionStorage
                        //sessionStorage.removeItem('correctiveActionShown');
                    //}
                }
            });
        }

        // Appeler la fonction toutes les 5 secondes
        setInterval(checkForCorrectiveAction, 5000);
    </script>-->

    <!--<script>
        window.Echo.channel('notif')
            .listen('.App\\Events\\ActionUpdated', (e) => {
                Swal.fire({
                    title: "Information!",
                    text: "Nouvelle(s) action(s) corrective a valider",
                    icon: "info",
                    showCancelButton: false,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK",
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            });
    </script>-->

    @if (session('ajouter'))
        <script>
            toastr.success("{{ session('ajouter') }}"," ",
            {positionClass:"toast-top-left",timeOut:5e3,debug:!1,newestOnTop:!0,
            preventDuplicates:!0,showDuration:"300",hideDuration:"1000",extendedTimeOut:"1000",
            showEasing:"swing",showMethod:"fadeIn",hideMethod:"fadeOut"})
        </script>
        {{ session()->forget('ajouter') }}
    @endif
    @if (session('valider'))
        <script>
            toastr.success("{{ session('valider') }}"," ",
            {positionClass:"toast-top-left",timeOut:5e3,debug:!1,newestOnTop:!0,
            preventDuplicates:!0,showDuration:"300",hideDuration:"1000",extendedTimeOut:"1000",
            showEasing:"swing",showMethod:"fadeIn",hideMethod:"fadeOut"})
        </script>
        {{ session()->forget('valider') }}
    @endif
    @if (session('rejet'))
        <script>
            toastr.success("{{ session('rejet') }}"," ",
            {positionClass:"toast-top-left",timeOut:5e3,debug:!1,newestOnTop:!0,
            preventDuplicates:!0,showDuration:"300",hideDuration:"1000",extendedTimeOut:"1000",
            showEasing:"swing",showMethod:"fadeIn",hideMethod:"fadeOut"})
        </script>
        {{ session()->forget('rejet') }}
    @endif
    @if (session('am_choisir'))
        <script>
            toastr.warning("{{ session('am_choisir') }}"," ",
            {positionClass:"toast-top-left",timeOut:5e3,debug:!1,newestOnTop:!0,
            preventDuplicates:!0,showDuration:"300",hideDuration:"1000",extendedTimeOut:"1000",
            showEasing:"swing",showMethod:"fadeIn",hideMethod:"fadeOut"})
        </script>
        {{ session()->forget('am_choisir') }}
    @endif
    @if (session('echec'))
        <script>
            toastr.warning("{{ session('echec') }}"," ",
            {positionClass:"toast-top-left",timeOut:5e3,debug:!1,newestOnTop:!0,
            preventDuplicates:!0,showDuration:"300",hideDuration:"1000",extendedTimeOut:"1000",
            showEasing:"swing",showMethod:"fadeIn",hideMethod:"fadeOut"})
        </script>
        {{ session()->forget('echec') }}
    @endif

</body>
<!-- Mirrored from dashlite.net/demo8/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 14 Mar 2023 15:17:24 GMT -->

</html>
