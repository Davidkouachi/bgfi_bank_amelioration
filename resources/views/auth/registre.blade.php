<!DOCTYPE html>
<html lang="zxx" class="js">
<!-- Mirrored from dashlite.net/demo2/pages/auths/auth-login-v2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 24 Jun 2023 21:51:46 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <link rel="shortcut icon" href="../../images/favicon.png">
    <title>Register</title>
    <link rel="stylesheet" href="../../assets/css/dashlite55a0.css?ver=3.2.0">
    <link id="skin-default" rel="stylesheet" href="../../assets/css/theme55a0.css?ver=3.2.0">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-91615293-4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-91615293-4');
    </script>
</head>

<body class="nk-body bg-white npc-default pg-auth">
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="card">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title ">Creer un nouveau compte</h4>
                                        <div class="nk-block-des">
                                            <marquee>
                                                <p class="text-warning">Veuillez bien remplir les champs S.V.P</p>
                                            </marquee>
                                        </div>
                                    </div>
                                </div>
                                <form action="/add_user" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Nom</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input name="name" type="text" class="form-control form-control-lg">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Email</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input name="email" type="email" class="form-control form-control-lg">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">mot de passe</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input name="password" type="password" class="form-control form-control-lg">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-success btn-dim btn-block">
                                            Valider
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="nk-footer nk-auth-footer-full">
                        <div class="container wide-lg">
                            <div class="row g-3">
                                <div class="col-lg-6 order-lg-last">
                                    <ul class="nav nav-sm justify-content-center justify-content-lg-end">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Terms & Condition</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Privacy Policy</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Help</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <div class="nk-block-content text-center text-lg-left">
                                        <p class="text-soft">&copy; 2023 Dashlite. All Rights Reserved.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/bundle55a0.js?ver=3.2.0"></script>
    <script src="../../assets/js/scripts55a0.js?ver=3.2.0"></script>
    <script src="../../assets/js/demo-settings55a0.js?ver=3.2.0"></script>
    <!-- Mirrored from dashlite.net/demo2/pages/auths/auth-login-v2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 24 Jun 2023 21:51:55 GMT -->

</html>
