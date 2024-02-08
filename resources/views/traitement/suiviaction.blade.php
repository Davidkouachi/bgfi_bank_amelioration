@extends('app')

@section('titre', 'Liste de contrôle des actions')

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
                                    <div class="nk-block-head-content" style="margin:0px auto;">
                                        <h3 class="text-center">
                                            <span>Liste de contrôle des actions</span>
                                            <em class="icon ni ni-list-index"></em>
                                        </h3>
                                    </div>
                                </div>
                    </div>
                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-md-12 col-xxl-12">
                                <div class="card card-bordered card-preview">
                                    <div class="card-inner">
                                        <table class="datatable-init table">
                                            <thead>
                                                <tr class="text-center">
                                                    <th></th>
                                                    <th>Lieu</th>
                                                    <th>Détecteur</th>
                                                    <th>Date d'enregistrement</th>
                                                    <th>Date Limite de traitement</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($ams as $key => $am)
                                                    <tr class="text-center">
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{ $am->lieu }}</td>
                                                        <td>{{ $am->detecteur }}</td>
                                                        <td>
                                                            {{ 
                                                                \Carbon\Carbon::parse($am->date_fiche)->format('d/m/Y')
                                                            }}
                                                        </td>

                                                        <td>
                                                            {{ \Carbon\Carbon::parse($am->date_fiche)->addDays($am->nbre_traitement)->format('d/m/Y') }}
                                                        </td>

                                                        <td>
                                                            <ul class="nk-tb-actions gx-1">
                                                                <li>
                                                                    <div class="drodown">
                                                                        <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown" aria-expanded="true">
                                                                            <em class="icon ni ni-more-h"></em>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-end"data-popper-placement="bottom-end">
                                                                            @foreach($actionsData[$am->id] as $key => $actions)
                                                                            <ul class="link-list-opt no-bdr">
                                                                                <li>
                                                                                    <a data-bs-toggle="modal" data-bs-target="#modalDetail{{ $actions['id'] }}">
                                                                                        <em class="icon ni ni-eye"></em>
                                                                                        <span>Action {{ $key+1 }} </span>
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
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

    @foreach($ams as $am)
        @foreach($actionsData[$am->id] as $key => $actions)
            <div class="modal fade zoom" tabindex="-1" id="modalDetail{{ $actions['id'] }}">
                <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Suivi</h5>
                            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <em class="icon ni ni-cross"></em>
                            </a>
                        </div>
                        <div class="modal-body">
                            <div class="nk-block">
                                <form class="row g-gs" method="post" action="/Suivi_action/{{ $actions['id'] }}">
                                    @csrf
                                    <div class="col-lg-12 col-xxl-12" >
                                        <div class="card">
                                            <div class="card-inner">
                                                    <div class="row g-4">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Cause">
                                                                    Processus
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value=" {{ $actions['processus'] }} " type="text" class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="controle">
                                                                    Reclamation
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value=" {{ $actions['reclamation'] }} " type="text" class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="controle">
                                                                    Cause
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value=" {{ $actions['cause'] }} " type="text" class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="controle">
                                                                    Action
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value=" {{ $actions['action'] }}  " type="text" class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="corectif">
                                                                    Délai
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ \Carbon\Carbon::parse($actions['delai'])->format('d/m/Y') }}" type="text" class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Coût">
                                                                    Responsable
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input value="{{ $actions['responsable'] }}" type="text" class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="email-address-1">
                                                                    Efficacitée
                                                                </label>
                                                                <select required name="efficacite" class="form-select ">
                                                                    <option value="">
                                                                        Choisir
                                                                    </option>
                                                                    <option value="oui">
                                                                        Oui
                                                                    </option>
                                                                    <option value="non">
                                                                        Non
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="Coût">
                                                                    Date d'action éffectuée
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input name="date_action" type="date" class="form-control"  max="{{ \Carbon\Carbon::now()->toDateString() }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <div class="form-group text-center">
                                                                <label class="form-label" for="description">
                                                                    Commentaire
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <textarea name="commentaire" class="form-control no-resize" id="default-textarea"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group text-center">
                                                                <button type="submit" class="btn btn-lg btn-success btn-dim">
                                                                    <em class="ni ni-check me-2 "></em>
                                                                    <em >Enregistrer</em>
                                                                </button>
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
            </div>
        @endforeach
    @endforeach

    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('9f9514edd43b1637ff61', {
          cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel-valide-recla');
        channel.bind('my-event-valide-recla', function(data) {
            Swal.fire({
                        title: "Alert!",
                        text: "Nouvelle(s) Action(s)",
                        icon: "info",
                        confirmButtonColor: "#00d819",
                        confirmButtonText: "OK",
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
        });
    </script>


@endsection
