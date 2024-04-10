@extends('app')

@section('titre', 'Nouveau Processus')

@section('content')

    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="text-center">
                                    Evaluation
                                </h3>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a class="btn btn-white btn-dim btn-outline-primary" href="{{ route('index_accueil') }}">
                                        <em class="icon ni ni-home"></em>
                                        <span>Accueil</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-md-12 col-xxl-4">
                                <div class="card card-bordered card-preview">
                                    <div class="card-inner">
                                        <table class="datatable-init table">
                                            <thead>
                                                <tr class="text-center">
                                                    <th></th>
                                                    <th>Processus</th>
                                                    <th>nombre de risques</th>
                                                    <th>Evaluation Gbobale</th>
                                                    <th>Couleur</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($processus as $key => $processu)
                                                    <tr class="text-center">
                                                        <td>{{ $key+1}}</td>
                                                        <td>{{ $processu->nom}}</td>
                                                        <td>{{ $processu->nbre_risque}}</td>
                                                        <td>
                                                            {{ $processu->evag }}
                                                        </td>
                                                        @if ($processu->evag >= 1 && $processu->evag <= 2 )
                                                            <td class="border-white" style="background-color:#5eccbf;" ></td>
                                                        @endif
                                                        @if ($processu->evag >= 3 && $processu->evag <= 9)
                                                            <td class="border-white"style="background-color:#f7f880;"></td>
                                                        @endif
                                                        @if ($processu->evag >= 10 && $processu->evag <= 16)
                                                            <td class="border-white"style="background-color:#f2b171;"></td>
                                                        @endif
                                                        @if ($processu->evag > 16)
                                                            <td class="border-white" style="background-color:#ea6072;"></td>
                                                        @endif
                                                        <td>
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#modalDetail{{$processu->id}}"
                                                                href="#" class="btn btn-primary btn-sm">
                                                                <em class="icon ni ni-eye"></em>
                                                            </a>
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
        <div class="modal fade zoom" tabindex="-1" id="modalDetail{{$processu->id}}">
            <div class="modal-dialog modal-sm" role="document" style="width: 75%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Détails</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em
                                class="icon ni ni-cross"></em></a>
                    </div>
                    <div class="modal-body">
                        <form class="nk-block" >
                            <div class="row g-gs">
                                <div class="col-md-12 col-xxl-4" id="groupesContainer">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                                <div class="card-head">
                                                    <h5 class="card-title">Evaluation Globale</h5>
                                                </div>
                                                <div class="row g-4">
                                                    <div class="col-lg-12">
                                                        <div class="form-group text-center">
                                                            <label class="form-label " for="Cause">
                                                                Processus : {{$processu->nom}}
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                @if ($processu->evag >= 1 && $processu->evag <= 2 )
                                                                    <input value="{{ $processu->evag }}" disabled type="text" 
                                                                    class="form-control border-white text-center " id="Cause" style="background-color:#5eccbf;" >
                                                                @endif
                                                                @if ($processu->evag >= 3 && $processu->evag <= 9)
                                                                    <input value="{{ $processu->evag }}" disabled type="text" 
                                                                    class="form-control border-white text-center " id="Cause"style="background-color:#f7f880;">
                                                                @endif
                                                                @if ($processu->evag >= 10 && $processu->evag <= 16)
                                                                    <input value="{{ $processu->evag }}" disabled type="text" 
                                                                    class="form-control border-white text-center " id="Cause"style="background-color:#f2b171;">
                                                                @endif
                                                                @if ($processu->evag > 16)
                                                                    <input value="{{ $processu->evag }}" disabled type="text" 
                                                                    class="form-control border-white text-center " id="Cause"style="background-color:#ea6072;">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xxl-4" id="groupesContainer">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                                <div class="row g-4">
                                                    @foreach ($risquesData[$processu->id] as $risqueData)
                                                    <div class="col-lg-12">
                                                        <div class="form-group text-center">
                                                            <label class="form-label" for="Cause">
                                                                Risque : {{ $risqueData['nom'] }}
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                @if ($risqueData['evaluation_residuel'] >= 1 && $risqueData['evaluation_residuel'] <= 2 )
                                                                    <input value="{{ $risqueData['evaluation_residuel'] }}" disabled type="text" 
                                                                    class="form-control border-white text-center " id="Cause" style="background-color:#5eccbf;" >
                                                                @endif
                                                                @if ($risqueData['evaluation_residuel'] >= 3 && $risqueData['evaluation_residuel'] <= 9)
                                                                    <input value="{{ $risqueData['evaluation_residuel'] }}" disabled type="text" 
                                                                    class="form-control border-white text-center " id="Cause"style="background-color:#f7f880;">
                                                                @endif
                                                                @if ($risqueData['evaluation_residuel'] >= 10 && $risqueData['evaluation_residuel'] <= 16)
                                                                    <input value="{{ $risqueData['evaluation_residuel'] }}" disabled type="text" 
                                                                    class="form-control border-white text-center " id="Cause"style="background-color:#f2b171;">
                                                                @endif
                                                                @if ($risqueData['evaluation_residuel'] > 16)
                                                                    <input value="{{ $risqueData['evaluation_residuel'] }}" disabled type="text" 
                                                                    class="form-control border-white text-center " id="Cause"style="background-color:#ea6072;">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
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



@endsection
