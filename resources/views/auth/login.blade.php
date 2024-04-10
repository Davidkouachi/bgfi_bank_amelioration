<!DOCTYPE html>
<html lang="zxx" class="js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <link href="{{asset('BGFI_logo.png')}}" rel="shortcut icon">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('assets/css/dashlite0226.css')}}">
    <link id="skin-default" rel="stylesheet" href="{{asset('assets/css/theme0226.css')}}">
</head>

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content bg-white">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs card-bordered bg-white">
                        <div class="brand-logo pb-0 text-center">
                            <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-user bg-primary"></em>
                        </div>
                        <div class="card">
                            <div class="card-inner card-inner-lg pt-2">
                                <div class="nk-block-head text-center">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Utilisateur</h4>
                                    </div>
                                </div>
                                <form id="login" action="/auth_user" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Email</label>
                                        </div>
                                        <div class="form-control-wrap"><input required type="text" class="form-control form-control-lg" id="email" name="email" value="{{ old('email') }}" placeholder="Entrer votre email"></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Mot de passe</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" required name="password" class="form-control form-control-lg" id="password" placeholder="Entrer votre Mot de passe">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-success btn-block">Connexion</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("login").addEventListener("submit", function(event) {
            event.preventDefault(); // Empêche la soumission par défaut du formulaire

            // Récupération des valeurs des champs
            var email = document.getElementById("email").value;
            var password1 = document.getElementById("password").value;

            // Validation des champs
            if (!email || !password1 ) {
                toastr.warning("Veuillez remplir tous les champs.");
                return false;
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Expression régulière pour valider l'e-mail
            if (!emailRegex.test(email)) {
                toastr.info("Veuillez saisir une adresse e-mail valide.");
                return false;
            }

            var password = document.getElementById("password").value;
            // Vérification si le mot de passe satisfait les critères
            if (!verifierMotDePasse(password)) {
                // Empêcher la soumission du formulaire si le mot de passe est invalide
                event.preventDefault();
                // Afficher un message d'erreur
                toastr.info("Le mot de passe doit comporter au moins 8 caractères, une lettre majuscule, une lettre minuscule et un chiffre.");
                return false;
            }

            // Si toutes les validations passent, soumettre le formulaire
            this.submit();

            function verifierMotDePasse(motDePasse) {
                // Vérification de la longueur
                if (motDePasse.length < 8) {
                    return false;
                }
                // Vérification s'il contient au moins une lettre majuscule
                if (!/[A-Z]/.test(motDePasse)) {
                    return false;
                }
                // Vérification s'il contient au moins une lettre minuscule
                if (!/[a-z]/.test(motDePasse)) {
                    return false;
                }
                // Vérification s'il contient au moins un chiffre
                if (!/\d/.test(motDePasse)) {
                    return false;
                }
                // Si toutes les conditions sont satisfaites, le mot de passe est valide
                return true;
            }
        });
    </script>

    <script src="{{asset('assets/js/bundle0226.js')}}"></script>
    <script src="{{asset('assets/js/scripts0226.js')}}"></script>
    <script src="{{asset('assets/js/demo-settings0226.js')}}"></script>
    <link href="{{asset('notification/toastr.min.css')}}" rel="stylesheet">
    <script src="{{asset('notification/toastr.min.js')}}"></script>

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
</body>

</html>
