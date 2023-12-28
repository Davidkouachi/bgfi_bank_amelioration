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
                                                    <th>Cause</th>
                                                    <th>Action</th>
                                                    <th>Délai de traitement</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($actions as $key => $action)
                                                    <tr class="text-center">
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{ $action->cause }} </td>
                                                        <td>{{ $action->action }}</td>
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($action->delai)->format('d/m/Y') }}
                                                        </td>
                                                        <td>
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#modalDetail{{ $action->id }}"
                                                                href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-warning">
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

    @foreach ($actions as $action)
        <div class="modal fade zoom" tabindex="-1" id="modalDetail{{ $action->id }}">
            <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Suivi</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em
                                class="icon ni ni-cross"></em></a>
                    </div>
                    <div class="modal-body">
                        <div class="nk-block">
                            <form class="row g-gs" method="post" action="/Suivi_action/{{ $action->action_id }}">
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
                                                                <input value="{{ $action->processus }}" type="text" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="controle">
                                                                Reclamation
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $action->reclamation }}" type="text" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="controle">
                                                                Cause
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $action->cause }}" type="text" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="controle">
                                                                Action
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $action->action }}" type="text" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="corectif">
                                                                Délai
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ \Carbon\Carbon::parse($action->delai)->format('d/m/Y') }}" type="text" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Coût">
                                                                Responsable
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="{{ $action->poste }}" type="text" class="form-control" disabled>
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
                                                                <option value="efficace">
                                                                    efficace
                                                                </option>
                                                                <option value="non_efficace">
                                                                    non-efficace
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

    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('9f9514edd43b1637ff61', {
          cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel-action');
        channel.bind('my-event-actionr', function(data) {
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
