<!DOCTYPE html>
<html lang="fr" >

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <link href="{{asset('BGFI_logo.png')}}" rel="shortcut icon">
    <title>Internet indisponible</title>
    <link rel="stylesheet" href="{{asset('assets/css/dashlite0226.css')}}">
    <link id="skin-default" rel="stylesheet" href="{{asset('assets/css/theme0226.css')}}">
</head>


<body class="nk-body bg-white npc-general pg-error">

    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle wide-xs mx-auto">
                        <div class="nk-block-content nk-error-ld text-center " id="indispo">
                            <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                            <h1 class="text-danger">Erreur</h1>
                            <h3 >
                                Connexion internet indisponible
                            </h3>
                        </div>
                        <div class="nk-block-content nk-error-ld text-center" style="display: none;" id="dispo">
                            <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-check bg-success"></em>
                            <h1 class="text-success">Succes</h1>
                            <h3 >
                                Connexion internet disponible
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/js/bundle0226.js')}}"></script>
    <script src="{{asset('assets/js/scripts0226.js')}}"></script>
    <script src="{{asset('assets/js/demo-settings0226.js')}}"></script>

    <script>
        document.getElementById("indispo").style.display = "block";
        document.getElementById("dispo").style.display = "none";

        function checkInternetAndPusher() {
            const online = navigator.onLine;

            if (online) {
                document.getElementById("indispo").style.display = "none";
                document.getElementById("dispo").style.display = "block";
                window.history.back(); // Remplacez avec votre URL de page d'erreur
            } else {
                document.getElementById("indispo").style.display = "block";
                document.getElementById("dispo").style.display = "none";
            }
        }

        // Vérifier régulièrement l'état de la connexion (toutes les 1 secondes ici)
        setInterval(checkInternetAndPusher, 1000);
    </script>

</body>

</html>