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
                                            <span>Nouveau Poste</span>
                                            <em class="icon ni ni-reports-alt"></em>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-block ">
                                <div class="row g-gs align-items-center justify-content-center" >
                                    <div class="col-md-6 col-xxl-4 "  >
                                        <div class="card card-bordered ">
                                            <div class="card-inner">
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
                            </div>
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


@endsection
