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
    
    <!--<script>
        import Echo from 'laravel-echo'

        window.Echo = new Echo({
          broadcaster: 'pusher',
          key: '9f9514edd43b1637ff61',
          cluster: 'eu',
          forceTLS: true
        });

        var channel = Echo.channel('my-channel');
        channel.listen('.my-event', function(data) {
                    Swal.fire({
                        title: "Information!",
                        text: "Nouvelle(s) action(s) corrective à valider",
                        icon: "info",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK",
                        allowOutsideClick: false,
                        showCloseButton: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Insérer ici le code pour effectuer une action après confirmation
                        }
                    });
        });
    </script>-->
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
                        <!--<div class="nk-menu-trigger me-sm-2 d-lg-none">
                            <a class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav" href="#">
                                <em class="icon ni ni-menu"></em>
                            </a>
                        </div>-->
                        <div class="nk-header-brand">
                            <a class="logo-link" href="{{ route('index_accueil') }}">
                                <img alt="logo-dark" class="logo-dark logo-img" src="{{asset('BGFI_logo.png')}}">
                                </img>
                            </a>
                        </div>
                        <div class="nk-header-menu ms-auto" data-content="headerNav">
                            <!--<div class="nk-header-mobile">
                                <div class="nk-header-brand">
                                    <a class="logo-link" href="index-2.html">
                                        <img alt="logo-dark" class="logo-dark logo-img" src="images/logo.png"
                                            srcset="/images/logo.png 2x">
                                        </img>
                                        <span><B>COHÉRENCE</B></span>
                                    </a>
                                </div>
                                <div class="nk-menu-trigger me-n2">
                                    <a class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav" href="#">
                                        <em class="icon ni ni-arrow-left"></em>
                                    </a>
                                </div>
                            </div>-->
                            <ul class="nk-menu nk-menu-main ui-s2">
                                <!--<li >
                                    <a class="nk-menu-link" href="{{ route('index_accueil') }}">
                                        <span class="nk-menu-text">
                                            Accueil
                                        </span>
                                    </a>
                                </li>
                                <li class="nk-menu-item has-sub">
                                    <a class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-text">
                                            Nouvelle Enregistrement
                                        </span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li >
                                            <a class="nk-menu-link" href="{{ route('index_add_processus') }}">
                                                <span class="nk-menu-text">
                                                    Fiche Processus
                                                </span>
                                            </a>
                                        </li>
                                        <li >
                                            <a class="nk-menu-link" href="{{ route('index_add_processuseva') }}">
                                                <span class="nk-menu-text">
                                                    Fiche Risque
                                                </span>
                                            </a>
                                        </li>
                                        <li >
                                            <a class="nk-menu-link" href="{{ route('index_amelioration') }}">
                                                <span class="nk-menu-text">
                                                    Fiche d'amélioration
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nk-menu-item has-sub">
                                    <a class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-text">
                                            Tableau
                                        </span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li >
                                            <a class="nk-menu-link" href="{{ route('index_validation_processus') }}">
                                                <span class="nk-menu-text">
                                                    Validation
                                                </span>
                                            </a>
                                        </li>
                                        <li >
                                            <a class="nk-menu-link" href="{{ route('index_suiviaction') }}">
                                                <span class="nk-menu-text">
                                                    Suivi des actions
                                                </span>
                                            </a>
                                        </li>
                                        <li >
                                            <a class="nk-menu-link" href="{{ route('index_evaluation') }}">
                                                <span class="nk-menu-text">
                                                    Evaluation Processus
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>-->
                                @yield('menu')
                            </ul>
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
                                                    {{ Auth::user()->name }}
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
                                                <div class="user-action">
                                                    <a class="btn btn-icon me-n2" href="user-profile-setting.html">
                                                        <em class="icon ni ni-setting"></em>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li>
                                                    <a href="{{ route('index_accueil') }}">
                                                        <em class="icon ni ni-home"></em>
                                                        <span>
                                                            Accueil
                                                        </span>
                                                    </a>
                                                </li>
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
                            <img height="30" width="100" src="{{asset('BGFI_logo.jpg')}}" alt="">
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

</body>
<!-- Mirrored from dashlite.net/demo8/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 14 Mar 2023 15:17:24 GMT -->

</html>
