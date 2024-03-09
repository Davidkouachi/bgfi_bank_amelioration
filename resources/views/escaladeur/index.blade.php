<!DOCTYPE html>
<html class="js" lang="fr">
<meta content="text/html;charset=utf-8" http-equiv="content-type">

<head>
    <meta charset="utf-8">
    <meta content="Softnio" name="author">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers." name="description">
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
                        <div class="nk-header-tools">
                            <ul class="nk-quick-nav">
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
                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1 is-light">
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
            <div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content" style="margin:0px auto;">
                                            <h3 class="text-center">
                                                <span>Liste des Reclamations</span>
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
                                                            <th>Type</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="text-center">
                                                            <td>1</td>
                                                            <td>qsdfghjh</td>
                                                            <td>
                                                                <a data-bs-toggle="modal" data-bs-target="#modalDetail" href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-warning">
                                                                    <em class="icon ni ni-eye"></em>
                                                                </a>
                                                            </td>
                                                        </tr>
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
    <!--<script>
        // Vérifier si la connexion Internet est disponible avant d'utiliser Pusher
        function checkInternetAndPusher() {
            const online = navigator.onLine;

            if (online) {
                // Utiliser Pusher seulement si la connexion est disponible
                // Votre code pour utiliser Pusher ici
                // ...
            } else {
                // Si la connexion est perdue, rediriger vers une page spécifique
                window.location.href = "/Internet indisponible"; // Remplacez par votre URL de page d'erreur
            }
        }

        // Vérifier régulièrement l'état de la connexion (toutes les 5 secondes ici)
        setInterval(checkInternetAndPusher, 2000);
    </script>-->
    <div class="modal fade" tabindex="-1" id="modalAlert2" aria-modal="true" style="position: fixed;" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body modal-body-lg text-center">
                    <div class="nk-modal">
                        <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                        <h4 class="nk-modal-title">Session Expiré!</h4>
                        <div class="nk-modal-action mt-5">
                            <a class="btn btn-lg btn-mw btn-light">
                                ok
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Sélectionnez le bouton "ok" dans la modalité
            const okButton = document.querySelector('#modalAlert2 .btn-light');

            // Ajoutez un gestionnaire d'événements au clic sur le bouton "ok"
            okButton.addEventListener('click', function() {
                // Rechargez la page
                location.reload();
            });

        </script>
    <!--<script>

            let inactivityTimeout;

            function resetTimer() {
                clearTimeout(inactivityTimeout);

                inactivityTimeout = setTimeout(function() {
                    // Code à exécuter lorsque l'utilisateur est inactif
                    $('#modalAlert2').modal('show');
                }, 300000); // Durée d'inactivité en millisecondes (par exemple, 5 minute ici)
            }

            // Lancer le minuteur au chargement de la page
            window.onload = resetTimer;

        </script>-->
    <!--<script>
            Pusher.logToConsole = true;

            var pusher = new Pusher('9f9514edd43b1637ff61', {
              cluster: 'eu'
            });

            var channel = pusher.subscribe('my-channel-user');
            channel.bind('my-event-user', function(data) {
                Swal.fire({
                            title: "Alert!",
                            text: "Session Expiré",
                            icon: "error",
                            confirmButtonColor: "#00d819",
                            confirmButtonText: "OK",
                            allowOutsideClick: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
            });
        </script>-->
    <!--<script>
            // JavaScript pour écouter les événements
            const channel = pusher.subscribe('my-channel-user');

            channel.bind('my-event-user', function(data) {
                // Code pour afficher l'alerte ou réaliser une action visuelle
                Swal.fire({
                    title: "Alert!",
                    text: "Session Expirée",
                    icon: "error",
                    confirmButtonColor: "#00d819",
                    confirmButtonText: "OK",
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            });
        </script>-->
    <!--<script>

            let idleTimer;
            const idleTime = 300000; //5 min

            function resetIdleTimer() {
                clearTimeout(idleTimer);
                idleTimer = setTimeout(showLogoutModal, idleTime);
            }

            function showLogoutModal() {
                $('#modalAlert2').modal('show');
            }
        </script>-->

    <script src="{{asset('assets/js/bundle0226.js')}}"></script>
    <script src="{{asset('assets/js/scripts0226.js')}}"></script>
    <script src="{{asset('assets/js/demo-settings0226.js')}}"></script>
    <script src="{{asset('assets/js/libs/datatable-btns0226.js')}}"></script>
    <link href="{{asset('notification/toastr.min.css')}}" rel="stylesheet">
    <script src="{{asset('notification/toastr.min.js')}}"></script>

    <!--<script>
        let idleTimer;
        const idleTime = 1200000;

        function resetIdleTimer() {
            clearTimeout(idleTimer);
            idleTimer = setTimeout(showLogoutModal, idleTime);
        }

        function showLogoutModal() {
            $('#modalAlert2').modal('show');
        }

        document.addEventListener('mousemove', resetIdleTimer);
        document.addEventListener('keypress', resetIdleTimer);
    </script>
    <script>
        document.getElementById('logoutBtn').addEventListener('click', function(event) {
            event.preventDefault(); // Pour éviter le comportement par défaut du lien
            window.location.reload();
        });
    </script>-->
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
    @if (session('success'))
    <script>
    toastr.success("{{ session('success') }}", " ", {
        positionClass: "toast-top-left",
        timeOut: 5e3,
        debug: !1,
        newestOnTop: !0,
        preventDuplicates: !0,
        showDuration: "300",
        hideDuration: "1000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
    })

    </script>
    {{ session()->forget('success') }}
    @endif
    @if (session('error'))
    <script>
    toastr.error("{{ session('error') }}", " ", {
        positionClass: "toast-top-left",
        timeOut: 5e3,
        debug: !1,
        newestOnTop: !0,
        preventDuplicates: !0,
        showDuration: "300",
        hideDuration: "1000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
    })

    </script>
    {{ session()->forget('error') }}
    @endif
    @if (session('info'))
    <script>
    toastr.info("{{ session('info') }}", " ", {
        positionClass: "toast-top-left",
        timeOut: 5e3,
        debug: !1,
        newestOnTop: !0,
        preventDuplicates: !0,
        showDuration: "300",
        hideDuration: "1000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
    })

    </script>
    {{ session()->forget('info') }}
    @endif
    @if (session('warning'))
    <script>
    toastr.warning("{{ session('warning') }}", " ", {
        positionClass: "toast-top-left",
        timeOut: 5e3,
        debug: !1,
        newestOnTop: !0,
        preventDuplicates: !0,
        showDuration: "300",
        hideDuration: "1000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
    })

    </script>
    {{ session()->forget('warning') }}
    @endif
</body>

</html>

