@extends('app')

@section('titre', 'Liste des Processus')

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
                        <div class="nk-block-head nk-block-head-sm" >
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content" style="margin:0px auto;">
                                        <h3 class="text-center">
                                            <span>Liste des Processus</span>
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
                                                    <th>Approvisionnement</th>
                                                    <th>Finalié</th>
                                                    <th>Nombre d'objectif</th>
                                                    <th>Date de création</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($processus as $key => $processu)
                                                    <tr class="text-center">
                                                        <td>{{ $key+1}}</td>
                                                        <td>{{ $processu->nom}}</td>
                                                        <td>{{ $processu->finalite}}</td>
                                                        <td>{{ $processu->nbre}}</td>
                                                        <td>{{ \Carbon\Carbon::parse($processu->created_at)->translatedFormat('j F Y '.' à '.' H:i:s') }}</td>
                                                        <td>
                                                            <div class="d-flex" >
                                                                <form method="post" action="{{ route('index_etat_processus') }}">
                                                                    @csrf
                                                                    <input type="text" name="id" value="{{$processu->id}}" style="display: none;">
                                                                    <a data-bs-toggle="modal"
                                                                        data-bs-target="#modalDetail{{$processu->id}}"
                                                                        href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-warning border border-1 border-white rounded">
                                                                        <em class="icon ni ni-eye"></em>
                                                                    </a>
                                                                    <!--<a data-bs-toggle="modal"
                                                                        data-bs-target="#modalModif{{$processu->id}}"
                                                                        href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-info border border-1 border-white rounded">
                                                                        <em class="icon ni ni-edit"></em>
                                                                    </a>-->
                                                                    @if($processu->pdf_nom != null)
                                                                    <a href="{{ asset('storage/pdf/'.$processu->pdf_nom) }}" 
                                                                        href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-info border border-1 border-white rounded">
                                                                        <em class="icon ni ni-download"></em>
                                                                    </a>
                                                                    @endif
                                                                    <button class="btn btn-icon btn-white btn-dim btn-sm btn-primary">
                                                                        <em class="icon ni ni-printer-fill"></em>
                                                                    </button>
                                                                </form>
                                                                <form method="post" action="{{ route('index_processus_modif') }}">
                                                                    @csrf
                                                                    <input type="text" name="id" value="{{$processu->id}}" style="display: none;">
                                                                    <button class="btn btn-icon btn-white btn-dim btn-sm btn-primary">
                                                                        <em class="icon ni ni-edit"></em>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
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

    @foreach ($processus as $processu)
        <div class="modal fade zoom" tabindex="-1" id="modalDetail{{ $processu->id }}">
            <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Détails</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em
                                class="icon ni ni-cross"></em></a>
                    </div>
                    <div class="modal-body">
                        <form class="nk-block" >
                            <div class="row g-gs">
                                <div class="col-md-12 col-xxl-12" id="groupesContainer">
                                    <div class="card">
                                        <div class="card-inner">
                                                <div class="row g-4">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Cause">
                                                                Processus
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $processu->nom }}" disabled type="text" class="form-control" id="Cause">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Cause">
                                                                Finalité
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $processu->finalite }}" disabled type="text" class="form-control" id="Cause">
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
                                                                <input value="{{ $objectifDat['objectif'] }}" disabled type="text" class="form-control" id="Cause">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" >
                                                                Description
                                                            </label>
                                                            <div class="form-control-wrap" >
                                                                <textarea required name="causes" class="form-control no-resize" id="default-textarea">{{ $processu->description }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    @foreach ($processus as $processu)
        <div class="modal fade zoom" tabindex="-1" id="modalFile{{ $processu->id }}">
            <div class="modal-dialog modal-lg" role="document" >
                <div class="modal-content" data-simplebar>
                    @if ($processu->pdf_nom != '')
                        <embed src="{{ asset('storage/pdf/' . $processu->pdf_nom) }}" type="application/pdf" width="100%" height="1100px">
                    @endif

                    @if ($processu->pdf_nom == '')
                        <p class="text-center mt-2"  >Aucun fichier </p>
                    @endif
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($processus as $processu)
        <div class="modal fade" tabindex="-1" id="modalConfirme{{ $processu->id }}" aria-modal="true" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-bs-dismiss="modal">
                        <em class="icon ni ni-cross"></em>
                    </a>
                    <div class="modal-body modal-body-lg text-center">
                        <div class="nk-modal">
                            <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-trash bg-danger"></em>
                            <h4 class="nk-modal-title">Confirmation</h4>
                            <div class="nk-modal-text">
                                <div class="caption-text">
                                    <span>Voulez-vous vraiment confirmer la validation ?</span>
                                </div>
                            </div>
                            <div class="nk-modal-action">
                                <a href="/suppr_processus/{{ $processu->id }}" class="btn btn-lg btn-mw btn-success me-2">
                                    oui
                                </a>
                                <a href="#" class="btn btn-lg btn-mw btn-danger"data-bs-dismiss="modal">
                                    non
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($processus as $processu)
        <div class="modal fade zoom" tabindex="-1" id="modalModif{{ $processu->id }}">
            <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Mise à jour</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em
                                class="icon ni ni-cross"></em></a>
                    </div>
                    <div class="modal-body">
                        <div class="nk-block" >
                            <div class="row g-gs align-items-center justify-content-center" >
                                    <div class="col-lg-12 col-xxl-12 "  >
                                        <div class="card">
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
                                                        <div class="col-lg-12">
                                                            <div class="form-group text-center">
                                                                <label class="form-label" for="Cause">
                                                                    Nom du processus
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input placeholder="Saisie obligatoire" autocomplete="off" required name="nprocessus" type="text" class="form-control text-center" id="Cause" oninput="this.value = this.value.toUpperCase()" value="{{ $processu->nom}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group text-center">
                                                                <label class="form-label" for="description">
                                                                    Finalité
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input placeholder="Saisie obligatoire" autocomplete="off" required type="text" class="form-control text-center description" name="finalite" value="{{ $processu->finalite}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
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

                                                                <div class="custom-control mt-4">
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
    @endforeach

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
