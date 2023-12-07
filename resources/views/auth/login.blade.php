<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets_login/css/style.css">
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="icon d-flex align-items-center justify-content-center ">
                            <span class="fa fa-user-o"></span>
                        </div>
                        <h3 class="text-center mb-4">Utilisateur</h3>
                        <form action="/auth_user" method="post" class="login-form">
                            @csrf
                            <div class="form-group">
                                <input autocomplete="off" type="text" class="form-control rounded-left" placeholder="Email" required name="email">
                            </div>
                            <div class="form-group d-flex">
                                <input autocomplete="off" type="password" class="form-control rounded-left" placeholder="Mot de passe" required name="password">
                            </div>
                            <!--<div class="form-group d-md-flex">
                                <div class="w-50">
                                    <label class="checkbox-wrap checkbox-primary">Se souvenir de moi
                                        <input type="checkbox" name="remember">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>-->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary rounded submit p-3 px-5">
                                    Se connecter
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="assets_login/js/jquery.min.js"></script>
    <script src="assets_login/js/popper.js"></script>
    <script src="assets_login/js/bootstrap.min.js"></script>
    <script src="assets_login/js/main.js"></script>

    <link href="{{asset('notification/toastr.min.css')}}" rel="stylesheet">
    <script src="{{asset('notification/toastr.min.js')}}"></script>

    @if (session('error_login'))
        <script>
            toastr.error("{{ session('error_login') }}"," ",
            {positionClass:"toast-top-left",timeOut:5e3,debug:!1,newestOnTop:!0,
            preventDuplicates:!0,showDuration:"300",hideDuration:"1000",extendedTimeOut:"1000",
            showEasing:"swing",showMethod:"fadeIn",hideMethod:"fadeOut"})
        </script>
        {{ session()->forget('error_login') }}
    @endif

    <script>
        window.onload = function() {
            if (window.history && window.history.pushState) {
                history.pushState(null, null, window.location.href);
                window.onpopstate = function() {
                    history.pushState(null, null, window.location.href);
                };
            }
        };
    </script>


</body>

</html>
