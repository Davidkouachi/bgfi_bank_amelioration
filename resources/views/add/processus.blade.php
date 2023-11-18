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
                                            <span>Nouveau Processus</span>
                                            <em class="icon ni ni-share-alt"></em>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-block ">
                                <div class="row g-gs align-items-center justify-content-center" >
                                    <div class="col-md-10 col-xxl-10 "  >
                                        <div class="card card-bordered ">
                                            <div class="card-inner">
                                                <form id="processus-form" method="post" action="{{ route('add_processus') }}" enctype="multipart/form-data" >
                                                    @csrf
                                                    <div class="row g-4 mb-4" id="objectifs-container">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="cf-full-name">
                                                                    Fichier ( .pdf )
                                                                </label>
                                                                <input autocomplete="off" id="fileInput" name="pdfFile" accept=".pdf" type="file" class="form-control" id="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group text-center">
                                                                <label class="form-label" for="Cause">
                                                                    Nom du processus
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input placeholder="Saisie obligatoire" autocomplete="off" required name="nprocessus" type="text" class="form-control text-center" id="Cause" oninput="this.value = this.value.toUpperCase()">
                                                                </div>
                                                            </div>
                                                            <div class="form-group text-center">
                                                                <label class="form-label" for="description">
                                                                    Finalité
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input placeholder="Saisie obligatoire" autocomplete="off" required type="text" class="form-control text-center description" name="finalite">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group text-center">
                                                                <label class="form-label" for="description">
                                                                    Description
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <textarea name="description" class="form-control no-resize" id="default-textarea"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group text-center">
                                                                <label class="form-label" for="objectif">
                                                                    Objectif(s)
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input placeholder="Saisie obligatoire" autocomplete="off" required type="text" class="form-control text-center objectif" name="objectifs[]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row g-gs">
                                                        <div class="col-lg-4">
                                                            <div class="form-group text-center">
                                                                <button type="button" class="btn btn-lg btn-primary btn-dim" id="ajouter-objectif">
                                                                    <em class="ni ni-plus me-2"></em>
                                                                    <em>Objectif</em>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group text-center">
                                                                <a data-bs-toggle="modal" data-bs-target="#modalDetail" class="btn btn-lg btn-warning btn-dim">
                                                                    <em class="ni ni-eye me-2"></em>
                                                                    <em>Voir le fichier</em>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <script>
        document.getElementById('ajouter-objectif').addEventListener('click', function(event) {
            event.preventDefault();
            const container = document.getElementById('objectifs-container');
            const div = document.createElement('div');
            div.classList.add('col-lg-12');
            div.innerHTML = `
            <div class="row g-g2" >
                <div class=" col-md-12 form-group">
                    <div class="form-control-wrap">
                        <input placeholder="Saisie obligatoire" autocomplete="off" required type="text" class="form-control text-center objectif me-2" name="objectifs[]">
                    </div>
                </div>
                <div class=" col-md-12 form-group">
                    <div class="form-control-wrap ">
                        <button type="button" class="btn btn-danger btn-dim text-center btn-remove-objectif">
                            <em class="ni ni-trash me-2"></em>
                            <em>Supprimer</em>
                        </button>
                    </div>
                </div>
            </div>
            `;
            container.appendChild(div);

            // Ajouter un écouteur d'événement pour supprimer l'objectif
            div.querySelector('.btn-remove-objectif').addEventListener('click', function() {
                container.removeChild(div);
            });
        });
    </script>

    <div class="modal fade zoom" tabindex="-1" id="modalDetail">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="pdfPreviewmodal" data-simplebar>
            </div>
        </div>
    </div>

    <script>
    const fileInput = document.getElementById('fileInput');

    const pdfPreviewmodal = document.getElementById('pdfPreviewmodal');
    const fileSizeElementmodal = document.getElementById('fileSizemodal');

    fileInput.addEventListener('change', function() {
        // Obtenez le fichier PDF sélectionné
        const fichier = fileInput.files[0];

        // Vérifiez si un fichier a été sélectionné
        if (fichier) {
            // Créez un élément d'incorporation pour le fichier PDF
            const embedElementmodal = document.createElement('embed');
            embedElementmodal.src = URL.createObjectURL(fichier);
            embedElementmodal.type = 'application/pdf';
            embedElementmodal.style.width = '100%';
            embedElementmodal.style.height = '100%';
            // Affichez l'élément d'incorporation dans la div de prévisualisation
            pdfPreviewmodal.innerHTML = '';
            pdfPreviewmodal.appendChild(embedElementmodal);
            pdfPreviewmodal.style.height = '1000px';
            // Affichez la taille du fichier
            const fileSizemodal = fichier.size; // Taille du fichier en octets
            const fileSizemodalInKB = fileSizemodal / 1024; // Taille du fichier en kilo-octets
            fileSizeElementmodal.textContent = `Taille du fichier : ${fileSizemodalInKB.toFixed(2)} Ko`;
        } else {
            // Si aucun fichier n'est sélectionné, videz la div de prévisualisation et l'élément de la taille du fichier
            pdfPreviewmodal.innerHTML = '';
            fileSizeElementmodal.textContent = '';
        }
    });


    //si l'on veut selectionner et afficher plusieurs fichiers
    /*const fileInput = document.getElementById('fileInput');
    const pdfPreviews = document.getElementById('pdfPreviews');

    fileInput.addEventListener('change', function () {
        // Réinitialisez la div des prévisualisations
        pdfPreviews.innerHTML = '';

        // Parcourez tous les fichiers sélectionnés
        for (const fichier of fileInput.files) {
            // Créez un élément d'incorporation pour chaque fichier PDF
            const embedElement = document.createElement('embed');
            embedElement.src = URL.createObjectURL(fichier);
            embedElement.type = 'application/pdf';
            embedElement.style.width = '100%';
            embedElement.style.height = '100%';

            // Créez un conteneur div pour chaque prévisualisation
            const previewContainer = document.createElement('div');
            previewContainer.style.width = '500px'; // Spécifiez la largeur de chaque prévisualisation
            previewContainer.style.height = '500px'; // Spécifiez la hauteur de chaque prévisualisation
            previewContainer.appendChild(embedElement);

            // Ajoutez l'élément d'incorporation dans le conteneur des prévisualisations
            pdfPreviews.appendChild(previewContainer);
        }
    });*/
</script>


@endsection
