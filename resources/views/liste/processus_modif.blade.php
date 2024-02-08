@extends('app')

@section('titre', 'Nouveau Utilisateur')

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
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content" style="margin: 0px auto;">
                                <h3 class="text-center">
                                    <span>Modification</span>
                                    <em class="icon ni ni-edit"></em>
                                </h3>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('index_listeprocessus') }}" class="btn btn-danger btn-outline-white d-none d-sm-inline-flex">
                                    <em class="icon ni ni-arrow-left"></em>
                                    <span>Retour</span>
                                </a>
                                <a href="{{ route('index_listeprocessus') }}" class="btn btn-danger btn-outline-white d-inline-flex d-sm-none">
                                    <em class="icon ni ni-arrow-left"></em>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block ">
                                <div class="row g-gs align-items-center justify-content-center" >
                                    <div class="col-md-10 col-xxl-10 "  >
                                        <div class="card card-bordered ">
                                            <div class="card-inner">
                                                <form id="processus-form" method="post" action="{{ route('processus_modif') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <input name="id" value="{{ $processu->id }}" type="text" class="form-control" style="display: none;">
                                                    <div class="row g-4 mb-4" id="objectifs-container" >
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
                                                                    <input placeholder="Saisie obligatoire" autocomplete="off" required name="nprocessus" type="text" class="form-control text-center" id="Cause" oninput="this.value = this.value.toUpperCase()" value="{{ $processu->nom}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group text-center">
                                                                <label class="form-label" for="description">
                                                                    Finalité
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input placeholder="Saisie obligatoire" autocomplete="off" required type="text" class="form-control text-center description" name="finalite" value="{{ $processu->finalite}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group text-center">
                                                                <label class="form-label" for="description">
                                                                    Description
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <textarea name="description" class="form-control no-resize" id="default-textarea">{{ $processu->description}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @foreach ($objectifData[$processu->id] as $key => $objectifDat)
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Cause">
                                                                    Objectif {{ $key+1 }}
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input name="objectifs[]" value="{{ $objectifDat['objectif'] }}" type="text" class="form-control" id="Cause">
                                                                    <input name="id_objectifs[]" value="{{ $objectifDat['id'] }}" type="text" style="display: none;">
                                                                </div>

                                                                <div class="custom-control custom-checkbox mt-4">
                                                                    <input value="{{ $objectifDat['id'] }}" name="id_suppr[{{$key+1}}]" type="text" style="display: none;">
                                                                    <input name="suppr[{{$key+1}}]" value="oui" type="checkbox" class="custom-control-input" id="customCheck1_{{$key+1}}">
                                                                    <label class="custom-control-label" for="customCheck1_{{$key+1}}">
                                                                        Supprimé
                                                                    </label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="row g-gs">
                                                        <div class="col-lg-6">
                                                            <div class="form-group text-center">
                                                                <a class="btn btn-lg btn-warning" id="ajouter-objectif">
                                                                    <em class="ni ni-plus me-2"></em>
                                                                    <em>Objectif</em>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group text-center">
                                                                <button type="submit" class="btn btn-lg btn-primary">
                                                                    <em class="ni ni-check me-2"></em>
                                                                    <em>Mise àjour</em>
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
                    <label class="form-label" for="Cause">
                        Objectif
                    </label>
                    <div class="form-control-wrap">
                        <input placeholder="Saisie obligatoire" autocomplete="off" required type="text" class="form-control text-center objectif me-2" name="objectifs[]">
                        <input name="id_objectifs[]" value="0" type="text" style="display: none;">
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkboxesCause = document.querySelectorAll('input[name^="suppr["]');

            checkboxesCause.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const checkedCount = document.querySelectorAll('input[name^="suppr["]:checked').length;

                    if (checkedCount === checkboxesCause.length) {
                        // Si toutes les cases sont cochées, décocher la dernière case cochée
                        checkbox.checked = false;

                        toastr.info(`Impossible de supprimer cet objectif`);
                    }
                });
            });
        });
    </script>




@endsection
