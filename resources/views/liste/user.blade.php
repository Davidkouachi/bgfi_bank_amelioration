@extends('app')

@section('titre', 'Liste des Utilisateurs')

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
                                            <span>Liste des Utilisateurs</span>
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
                                                    <th>Matricule</th>
                                                    <th>Nom et Prénoms</th>
                                                    <th>Email</th>
                                                    <th>Contact</th>
                                                    <th>Poste</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $key => $user)
                                                    <tr class="text-center">
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{ $user->matricule }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->tel }}</td>
                                                        <td>{{ $user->poste }}</td>
                                                        <td>
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#modalDetail{{ $user->id }}"
                                                                href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-warning">
                                                                <em class="icon ni ni-eye"></em>
                                                            </a>
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#modalModif{{ $user->id }}"
                                                                href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-info">
                                                                <em class="icon ni ni-edit"></em>
                                                            </a>
                                                            <!--<a data-bs-toggle="modal"
                                                                data-bs-target="#modalConfirmelock"
                                                                href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-danger">
                                                                <em class="icon ni ni-lock"></em>
                                                            </a>
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#modalConfirmeunlock"
                                                                href="#" class="btn btn-icon btn-white btn-dim btn-sm btn-success">
                                                                <em class="icon ni ni-unlock"></em>
                                                            </a>-->
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

    @foreach($users as $key => $user)
        <div class="modal fade zoom" tabindex="-1" id="modalDetail{{ $user->id }}">
		    <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h5 class="modal-title">Informations</h5>
		                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
		            </div>
		            <div class="modal-body">
		                <form class="nk-block">
		                    <div class="row g-gs">
		                        <div class="col-lg-12">
		                            <div class="row g-gs">
		                                <div class="col-lg-12 " id="groupesContainer">
		                                    <div class="card ">
		                                        <div class="card-inner">
		                                            <div class="row g-4">
		                                                <div class="col-lg-12">
		                                                    <div class="form-group">
		                                                        <label class="form-label" for="Cause">
		                                                            Matricule
		                                                        </label>
		                                                        <div class="form-control-wrap">
		                                                            <input value="{{ $user->matricule }}" type="text" class="form-control" readonly>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-12">
		                                                    <div class="form-group">
		                                                        <label class="form-label" for="Cause">
		                                                            Nom et Prénoms
		                                                        </label>
		                                                        <div class="form-control-wrap">
		                                                            <input value="{{ $user->name }}" type="text" class="form-control" readonly>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-12">
		                                                    <div class="form-group">
		                                                        <label class="form-label" for="corectif">
		                                                            Email
		                                                        </label>
		                                                        <div class="form-control-wrap">
		                                                            <input value="{{ $user->email }}" readonly type="text" class="form-control">
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-6">
		                                                    <div class="form-group">
		                                                        <label class="form-label" for="preventif">
		                                                            Contact
		                                                        </label>
		                                                        <div class="form-control-wrap">
		                                                            <input value="{{ $user->tel }}" readonly type="text" class="form-control">
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-6">
		                                                    <div class="form-group">
		                                                        <label class="form-label" for="preventif">
		                                                            Poste
		                                                        </label>
		                                                        <div class="form-control-wrap">
		                                                            <input value="{{ $user->poste }}" readonly type="text" class="form-control">
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="col-lg-12">
		                            <div class="row g-gs">
		                                <div class="col-lg-12 ">
		                                    <div class="card">
		                                        <div class="card-inner">
		                                            <div class="card-head">
		                                                <h5 class="card-title">
		                                                    Autorisation des différentes fenêtres
		                                                </h5>
		                                            </div>
		                                            <div class="row g-4">
		                                                <div class="col-lg-12">
		                                                    <div class="form-group">
		                                                        <label class="form-label" for="Cause">
		                                                            ADMINISTRATION
		                                                        </label>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">
		                                                        	Nouveau Utilisateur
		                                                        	@if ($user->new_user === 'oui')
		                                                        	<a class="btn btn-sm btn-success">
		                                                                <em class="icon ni ni-check"></em>
		                                                            </a>
		                                                            @endif
		                                                            @if ($user->new_user === 'non')
		                                                            <a class="btn btn-sm btn-danger">
		                                                                <em class="icon ni ni-cross"></em>
		                                                            </a>
		                                                            @endif
		                                                        </span>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">
		                                                        	Liste des Utilisateurs
		                                                        	@if ($user->new_user === 'oui')
		                                                        	<a class="btn btn-sm btn-success">
		                                                                <em class="icon ni ni-check"></em>
		                                                            </a>
		                                                            @endif
		                                                            @if ($user->new_user === 'non')
		                                                            <a class="btn btn-sm btn-danger">
		                                                                <em class="icon ni ni-cross"></em>
		                                                            </a>
		                                                            @endif
		                                                        </span>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">
		                                                        	Nouveau Poste
		                                                        	@if ($user->new_poste === 'oui')
		                                                        	<a class="btn btn-sm btn-success">
		                                                                <em class="icon ni ni-check"></em>
		                                                            </a>
		                                                            @endif
		                                                            @if ($user->new_poste === 'non')
		                                                            <a class="btn btn-sm btn-danger">
		                                                                <em class="icon ni ni-cross"></em>
		                                                            </a>
		                                                            @endif
		                                                        </span>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">
		                                                        	Historique
		                                                        	@if ($user->historiq === 'oui')
		                                                        	<a class="btn btn-sm btn-success">
		                                                                <em class="icon ni ni-check"></em>
		                                                            </a>
		                                                            @endif
		                                                            @if ($user->historiq === 'non')
		                                                            <a class="btn btn-sm btn-danger">
		                                                                <em class="icon ni ni-cross"></em>
		                                                            </a>
		                                                            @endif
		                                                        </span>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">
		                                                        	Statistique
		                                                        	@if ($user->stat === 'oui')
		                                                        	<a class="btn btn-sm btn-success">
		                                                                <em class="icon ni ni-check"></em>
		                                                            </a>
		                                                            @endif
		                                                            @if ($user->stat === 'non')
		                                                            <a class="btn btn-sm btn-danger">
		                                                                <em class="icon ni ni-cross"></em>
		                                                            </a>
		                                                            @endif
		                                                        </span>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-12">
		                                                    <div class="form-group">
		                                                        <label class="form-label" for="Cause">
		                                                            PROCESSUS
		                                                        </label>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">
			                                                        Nouveau Processus
			                                                        @if ($user->new_proces === 'oui')
		                                                        	<a class="btn btn-sm btn-success">
		                                                                <em class="icon ni ni-check"></em>
		                                                            </a>
		                                                            @endif
		                                                            @if ($user->new_proces === 'non')
		                                                            <a class="btn btn-sm btn-danger">
		                                                                <em class="icon ni ni-cross"></em>
		                                                            </a>
		                                                            @endif
			                                                    </span>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">
		                                                        	Liste des Processus
		                                                        	@if ($user->list_proces === 'oui')
		                                                        	<a class="btn btn-sm btn-success">
		                                                                <em class="icon ni ni-check"></em>
		                                                            </a>
		                                                            @endif
		                                                            @if ($user->list_proces === 'non')
		                                                            <a class="btn btn-sm btn-danger">
		                                                                <em class="icon ni ni-cross"></em>
		                                                            </a>
		                                                            @endif
		                                                        </span>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-12">
		                                                    <div class="form-group">
		                                                        <label class="form-label" for="Cause">
		                                                            RÉCLAMATION
		                                                        </label>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">
		                                                        	Nouvelle Réclamation
		                                                        	@if ($user->new_recla === 'oui')
		                                                        	<a class="btn btn-sm btn-success">
		                                                                <em class="icon ni ni-check"></em>
		                                                            </a>
		                                                            @endif
		                                                            @if ($user->new_recla === 'non')
		                                                            <a class="btn btn-sm btn-danger">
		                                                                <em class="icon ni ni-cross"></em>
		                                                            </a>
		                                                            @endif
		                                                        </span>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">
		                                                        	Liste des Réclamations
		                                                        	@if ($user->list_recla === 'oui')
		                                                        	<a class="btn btn-sm btn-success">
		                                                                <em class="icon ni ni-check"></em>
		                                                            </a>
		                                                            @endif
		                                                            @if ($user->list_recla === 'non')
		                                                            <a class="btn btn-sm btn-danger">
		                                                                <em class="icon ni ni-cross"></em>
		                                                            </a>
		                                                            @endif
		                                                        </span>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">
		                                                        	Liste des Causes
		                                                        	@if ($user->list_cause === 'oui')
		                                                        	<a class="btn btn-sm btn-success">
		                                                                <em class="icon ni ni-check"></em>
		                                                            </a>
		                                                            @endif
		                                                            @if ($user->list_cause === 'non')
		                                                            <a class="btn btn-sm btn-danger">
		                                                                <em class="icon ni ni-cross"></em>
		                                                            </a>
		                                                            @endif
		                                                        </span>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-12">
		                                                    <div class="form-group">
		                                                        <label class="form-label" for="Cause">
		                                                            ACTIONS
		                                                        </label>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">
		                                                        	Suivis des actions
		                                                        	@if ($user->suivi_act === 'oui')
		                                                        	<a class="btn btn-sm btn-success">
		                                                                <em class="icon ni ni-check"></em>
		                                                            </a>
		                                                            @endif
		                                                            @if ($user->suivi_act === 'non')
		                                                            <a class="btn btn-sm btn-danger">
		                                                                <em class="icon ni ni-cross"></em>
		                                                            </a>
		                                                            @endif
		                                                        </span>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">
		                                                        	Actions éffectuées
		                                                        	@if ($user->act_eff === 'oui')
		                                                        	<a class="btn btn-sm btn-success">
		                                                                <em class="icon ni ni-check"></em>
		                                                            </a>
		                                                            @endif
		                                                            @if ($user->act_eff === 'non')
		                                                            <a class="btn btn-sm btn-danger">
		                                                                <em class="icon ni ni-cross"></em>
		                                                            </a>
		                                                            @endif
		                                                        </span>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">
		                                                        	Liste des Actions
		                                                        	@if ($user->list_act === 'oui')
		                                                        	<a class="btn btn-sm btn-success">
		                                                                <em class="icon ni ni-check"></em>
		                                                            </a>
		                                                            @endif
		                                                            @if ($user->list_act === 'non')
		                                                            <a class="btn btn-sm btn-danger">
		                                                                <em class="icon ni ni-cross"></em>
		                                                            </a>
		                                                            @endif
		                                                        </span>
		                                                    </div>
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

	@foreach($users as $key => $user)
        <div class="modal fade zoom" tabindex="-1" id="modalModif{{ $user->id }}">
		    <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h5 class="modal-title">Modification des Autorisations</h5>
		                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
		            </div>
		            <div class="modal-body">
		                <form class="nk-block" method="post" action="{{ route('index_modif_auto') }}">
		                	@csrf
		                    <div class="row g-gs">
		                        <div class="col-lg-12">
		                            <div class="row g-gs">
		                                <div class="col-lg-12 ">
		                                    <div class="card">
		                                        <div class="card-inner">
		                                            <!--<div class="card-head">
		                                                <h5 class="card-title">
		                                                    Autorisation des différentes fenêtres
		                                                </h5>
		                                            </div>-->
		                                            <input style="display: none" name="user_id" type="text" value="{{ $user->id }}">
		                                            <div class="row g-4">
		                                                <div class="col-lg-12">
		                                                    <div class="form-group">
		                                                        <label class="form-label" for="Cause">
		                                                            ADMINISTRATION
		                                                        </label>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">Nouveau Utilisateur</span>
		                                                        <div class="row gy-4">
		                                                            <div class="col-md-3 col-sm-6">
		                                                                <div class="preview-block">
		                                                                    <div class="custom-control custom-radio">
		                                                                        <input type="radio" id="customRadio1" name="nouveau_user"
		                                                                        @php  
		                                                                        	if ($user->new_user === 'oui') {
		                                                                        		echo 'checked';
		                                                                        	}
		                                                                        @endphp 
		                                                                         class="custom-control-input" value="oui">
		                                                                        <label class="custom-control-label" for="customRadio1">Oui</label>
		                                                                    </div>
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-md-3 col-sm-6">
		                                                                <div class="preview-block">
		                                                                    <div class="custom-control custom-radio">
		                                                                        <input type="radio" id="customRadio2" name="nouveau_user" 
		                                                                        @php  
		                                                                        	if ($user->new_user === 'non') {
		                                                                        		echo 'checked';
		                                                                        	}
		                                                                        @endphp 
		                                                                        class="custom-control-input" value="non">
		                                                                        <label class="custom-control-label" for="customRadio2">Non</label>
		                                                                    </div>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">Nouveau Poste</span>
		                                                        <div class="row gy-4">
		                                                            <div class="col-md-3 col-sm-6">
		                                                                <div class="preview-block">
		                                                                    <div class="custom-control custom-radio">
		                                                                        <input type="radio" id="customRadio3" name="nouveau_poste"
		                                                                        @php  
		                                                                        	if ($user->new_poste === 'oui') {
		                                                                        		echo 'checked';
		                                                                        	}
		                                                                        @endphp
		                                                                         class="custom-control-input" value="oui">
		                                                                        <label class="custom-control-label" for="customRadio3">Oui</label>
		                                                                    </div>
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-md-3 col-sm-6">
		                                                                <div class="preview-block">
		                                                                    <div class="custom-control custom-radio">
		                                                                        <input type="radio" id="customRadio4" name="nouveau_poste"
		                                                                        @php  
		                                                                        	if ($user->new_poste === 'non') {
		                                                                        		echo 'checked';
		                                                                        	}
		                                                                        @endphp
		                                                                         class="custom-control-input" value="non">
		                                                                        <label class="custom-control-label" for="customRadio4">Non</label>
		                                                                    </div>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">Historique</span>
		                                                        <div class="row gy-4">
		                                                            <div class="col-md-3 col-sm-6">
		                                                                <div class="preview-block">
		                                                                    <div class="custom-control custom-radio">
		                                                                        <input type="radio" id="customRadio5" name="historique"
		                                                                        @php  
		                                                                        	if ($user->historiq === 'oui') {
		                                                                        		echo 'checked';
		                                                                        	}
		                                                                        @endphp
		                                                                         class="custom-control-input" value="oui">
		                                                                        <label class="custom-control-label" for="customRadio5">Oui</label>
		                                                                    </div>
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-md-3 col-sm-6">
		                                                                <div class="preview-block">
		                                                                    <div class="custom-control custom-radio">
		                                                                        <input type="radio" id="customRadio6" name="historique"
		                                                                        @php  
		                                                                        	if ($user->historiq === 'non') {
		                                                                        		echo 'checked';
		                                                                        	}
		                                                                        @endphp
		                                                                         class="custom-control-input" value="non">
		                                                                        <label class="custom-control-label" for="customRadio6">Non</label>
		                                                                    </div>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">Statistique</span>
		                                                        <div class="row gy-4">
		                                                            <div class="col-md-3 col-sm-6">
		                                                                <div class="preview-block">
		                                                                    <div class="custom-control custom-radio">
		                                                                        <input type="radio" id="customRadio7" name="statistique"
		                                                                        @php  
		                                                                        	if ($user->stat === 'oui') {
		                                                                        		echo 'checked';
		                                                                        	}
		                                                                        @endphp
		                                                                         class="custom-control-input" value="oui">
		                                                                        <label class="custom-control-label" for="customRadio7">Oui</label>
		                                                                    </div>
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-md-3 col-sm-6">
		                                                                <div class="preview-block">
		                                                                    <div class="custom-control custom-radio">
		                                                                        <input type="radio" id="customRadio8" name="statistique"
		                                                                        @php  
		                                                                        	if ($user->stat === 'non') {
		                                                                        		echo 'checked';
		                                                                        	}
		                                                                        @endphp
		                                                                         class="custom-control-input" value="non">
		                                                                        <label class="custom-control-label" for="customRadio8">Non</label>
		                                                                    </div>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-12">
		                                                    <div class="form-group">
		                                                        <label class="form-label" for="Cause">
		                                                            PROCESSUS
		                                                        </label>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">Nouveau Processus</span>
		                                                        <div class="row gy-4">
		                                                            <div class="col-md-3 col-sm-6">
		                                                                <div class="preview-block">
		                                                                    <div class="custom-control custom-radio">
		                                                                        <input type="radio" id="customRadio9" name="nouveau_proces"
		                                                                        @php  
		                                                                        	if ($user->new_proces === 'oui') {
		                                                                        		echo 'checked';
		                                                                        	}
		                                                                        @endphp
		                                                                         class="custom-control-input" value="oui">
		                                                                        <label class="custom-control-label" for="customRadio9">Oui</label>
		                                                                    </div>
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-md-3 col-sm-6">
		                                                                <div class="preview-block">
		                                                                    <div class="custom-control custom-radio">
		                                                                        <input type="radio" id="customRadio10" name="nouveau_proces"
		                                                                        @php  
		                                                                        	if ($user->new_proces === 'non') {
		                                                                        		echo 'checked';
		                                                                        	}
		                                                                        @endphp
		                                                                         class="custom-control-input" value="non">
		                                                                        <label class="custom-control-label" for="customRadio10">Non</label>
		                                                                    </div>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">Liste des Processus</span>
		                                                        <div class="row gy-4">
		                                                            <div class="col-md-3 col-sm-6">
		                                                                <div class="preview-block">
		                                                                    <div class="custom-control custom-radio">
		                                                                        <input type="radio" id="customRadio11" name="liste_proces"
		                                                                        @php  
		                                                                        	if ($user->list_proces === 'oui') {
		                                                                        		echo 'checked';
		                                                                        	}
		                                                                        @endphp
		                                                                         class="custom-control-input" value="oui">
		                                                                        <label class="custom-control-label" for="customRadio11">Oui</label>
		                                                                    </div>
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-md-3 col-sm-6">
		                                                                <div class="preview-block">
		                                                                    <div class="custom-control custom-radio">
		                                                                        <input type="radio" id="customRadio12" name="liste_proces"
		                                                                        @php  
		                                                                        	if ($user->list_proces === 'non') {
		                                                                        		echo 'checked';
		                                                                        	}
		                                                                        @endphp
		                                                                         class="custom-control-input" value="non">
		                                                                        <label class="custom-control-label" for="customRadio12">Non</label>
		                                                                    </div>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-12">
		                                                    <div class="form-group">
		                                                        <label class="form-label" for="Cause">
		                                                            RÉCLAMATION
		                                                        </label>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">Nouvelle Réclamation</span>
		                                                        <div class="row gy-4">
		                                                            <div class="col-md-3 col-sm-6">
		                                                                <div class="preview-block">
		                                                                    <div class="custom-control custom-radio">
		                                                                        <input type="radio" id="customRadio13" name="nouvelle_recla"
		                                                                        @php  
		                                                                        	if ($user->new_recla === 'oui') {
		                                                                        		echo 'checked';
		                                                                        	}
		                                                                        @endphp
		                                                                         class="custom-control-input" value="oui">
		                                                                        <label class="custom-control-label" for="customRadio13">Oui</label>
		                                                                    </div>
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-md-3 col-sm-6">
		                                                                <div class="preview-block">
		                                                                    <div class="custom-control custom-radio">
		                                                                        <input type="radio" id="customRadio14" name="nouvelle_recla"
		                                                                        @php  
		                                                                        	if ($user->new_recla === 'non') {
		                                                                        		echo 'checked';
		                                                                        	}
		                                                                        @endphp
		                                                                         class="custom-control-input" value="non">
		                                                                        <label class="custom-control-label" for="customRadio14">Non</label>
		                                                                    </div>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">Liste des Réclamations</span>
		                                                        <div class="row gy-4">
		                                                            <div class="col-md-3 col-sm-6">
		                                                                <div class="preview-block">
		                                                                    <div class="custom-control custom-radio">
		                                                                        <input type="radio" id="customRadio15" name="liste_recla"
		                                                                        @php  
		                                                                        	if ($user->list_recla === 'oui') {
		                                                                        		echo 'checked';
		                                                                        	}
		                                                                        @endphp
		                                                                        class="custom-control-input" value="oui">
		                                                                        <label class="custom-control-label" for="customRadio15">Oui</label>
		                                                                    </div>
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-md-3 col-sm-6">
		                                                                <div class="preview-block">
		                                                                    <div class="custom-control custom-radio">
		                                                                        <input type="radio" id="customRadio16" name="liste_recla"
		                                                                        @php  
		                                                                        	if ($user->list_recla === 'non') {
		                                                                        		echo 'checked';
		                                                                        	}
		                                                                        @endphp
		                                                                         class="custom-control-input" value="non">
		                                                                        <label class="custom-control-label" for="customRadio16">Non</label>
		                                                                    </div>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">Liste des Causes</span>
		                                                        <div class="row gy-4">
		                                                            <div class="col-md-3 col-sm-6">
		                                                                <div class="preview-block">
		                                                                    <div class="custom-control custom-radio">
		                                                                        <input type="radio" id="customRadio0" name="liste_cause"
		                                                                        @php  
		                                                                        	if ($user->list_cause === 'oui') {
		                                                                        		echo 'checked';
		                                                                        	}
		                                                                        @endphp
		                                                                        class="custom-control-input" value="oui">
		                                                                        <label class="custom-control-label" for="customRadio0">Oui</label>
		                                                                    </div>
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-md-3 col-sm-6">
		                                                                <div class="preview-block">
		                                                                    <div class="custom-control custom-radio">
		                                                                        <input type="radio" id="customRadio00" name="liste_cause"
		                                                                        @php  
		                                                                        	if ($user->list_cause === 'non') {
		                                                                        		echo 'checked';
		                                                                        	}
		                                                                        @endphp
		                                                                         class="custom-control-input" value="non">
		                                                                        <label class="custom-control-label" for="customRadio00">Non</label>
		                                                                    </div>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-12">
		                                                    <div class="form-group">
		                                                        <label class="form-label" for="Cause">
		                                                            ACTIONS
		                                                        </label>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">Suivis des actions</span>
		                                                        <div class="row gy-4">
		                                                            <div class="col-md-3 col-sm-6">
		                                                                <div class="preview-block">
		                                                                    <div class="custom-control custom-radio">
		                                                                        <input type="radio" id="customRadio17" name="suivi"
		                                                                        @php  
		                                                                        	if ($user->suivi_act === 'oui') {
		                                                                        		echo 'checked';
		                                                                        	}
		                                                                        @endphp
		                                                                         class="custom-control-input" value="oui">
		                                                                        <label class="custom-control-label" for="customRadio17">Oui</label>
		                                                                    </div>
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-md-3 col-sm-6">
		                                                                <div class="preview-block">
		                                                                    <div class="custom-control custom-radio">
		                                                                        <input type="radio" id="customRadio18" name="suivi"
		                                                                        @php  
		                                                                        	if ($user->suivi_act === 'non') {
		                                                                        		echo 'checked';
		                                                                        	}
		                                                                        @endphp
		                                                                         class="custom-control-input" value="non">
		                                                                        <label class="custom-control-label" for="customRadio18">Non</label>
		                                                                    </div>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">Actions éffectuées</span>
		                                                        <div class="row gy-4">
		                                                            <div class="col-md-3 col-sm-6">
		                                                                <div class="preview-block">
		                                                                    <div class="custom-control custom-radio">
		                                                                        <input type="radio" id="customRadio19" name="action_e"
		                                                                        @php  
		                                                                        	if ($user->act_eff === 'oui') {
		                                                                        		echo 'checked';
		                                                                        	}
		                                                                        @endphp
		                                                                         class="custom-control-input" value="oui">
		                                                                        <label class="custom-control-label" for="customRadio19">Oui</label>
		                                                                    </div>
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-md-3 col-sm-6">
		                                                                <div class="preview-block">
		                                                                    <div class="custom-control custom-radio">
		                                                                        <input type="radio" id="customRadio20" name="action_e"
		                                                                        @php  
		                                                                        	if ($user->act_eff === 'non') {
		                                                                        		echo 'checked';
		                                                                        	}
		                                                                        @endphp
		                                                                         class="custom-control-input" value="non">
		                                                                        <label class="custom-control-label" for="customRadio20">Non</label>
		                                                                    </div>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                                <div class="col-lg-5">
		                                                    <div class="form-group align-items-center justify-content-center">
		                                                        <span class="preview-title overline-title">Liste des Actions</span>
		                                                        <div class="row gy-4">
		                                                            <div class="col-md-3 col-sm-6">
		                                                                <div class="preview-block">
		                                                                    <div class="custom-control custom-radio">
		                                                                        <input type="radio" id="customRadio21" name="liste_action"
		                                                                        @php  
		                                                                        	if ($user->list_act === 'oui') {
		                                                                        		echo 'checked';
		                                                                        	}
		                                                                        @endphp
		                                                                         class="custom-control-input" value="oui">
		                                                                        <label class="custom-control-label" for="customRadio21">Oui</label>
		                                                                    </div>
		                                                                </div>
		                                                            </div>
		                                                            <div class="col-md-3 col-sm-6">
		                                                                <div class="preview-block">
		                                                                    <div class="custom-control custom-radio">
		                                                                        <input type="radio" id="customRadio22" name="liste_action"
		                                                                        @php  
		                                                                        	if ($user->list_act === 'non') {
		                                                                        		echo 'checked';
		                                                                        	}
		                                                                        @endphp
		                                                                         class="custom-control-input" value="non">
		                                                                        <label class="custom-control-label" for="customRadio22">Non</label>
		                                                                    </div>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="col-lg-12">
		                            <div class="row g-gs">
		                                <div class="col-md-12">
		                                    <div class="card card-preview">
		                                        <div class="card-inner row g-gs">
		                                            <div class="col-md-12">
		                                                <div class="form-group text-center">
		                                                    <button type="submit" class="btn btn-lg btn-primary btn-dim">
		                                                        <em class="ni ni-edit me-2 "></em>
		                                                        <em>Mise à jour</em>
		                                                    </button>
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


        <div class="modal fade" tabindex="-1" id="modalConfirmelock" aria-modal="true" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-bs-dismiss="modal">
                        <em class="icon ni ni-cross"></em>
                    </a>
                    <div class="modal-body modal-body-lg text-center">
                        <div class="nk-modal">
                            <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-lock bg-danger"></em>
                            <h4 class="nk-modal-title">Confirmation</h4>
                            <div class="nk-modal-text">
                                <div class="caption-text">
                                    <span>Voulez-vous vraiment bloquer ce compte ?</span>
                                </div>
                            </div>
                            <div class="nk-modal-action">
                                <a href="/suppr_processus/" class="btn btn-lg btn-mw btn-success me-2">
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

        <div class="modal fade" tabindex="-1" id="modalConfirmeunlock" aria-modal="true" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-bs-dismiss="modal">
                        <em class="icon ni ni-cross"></em>
                    </a>
                    <div class="modal-body modal-body-lg text-center">
                        <div class="nk-modal">
                            <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-unlock bg-success"></em>
                            <h4 class="nk-modal-title">Confirmation</h4>
                            <div class="nk-modal-text">
                                <div class="caption-text">
                                    <span>Voulez-vous vraiment débloquer ce compte ?</span>
                                </div>
                            </div>
                            <div class="nk-modal-action">
                                <a href="/suppr_processus/" class="btn btn-lg btn-mw btn-success me-2">
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



@endsection
