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
                    <div class="nk-block-head nk-block-head-sm" >
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content" style="margin: 0px auto;">
                                        <h3 class="text-center">
                                            <span>Modification des autorisation</span>
                                            <em class="icon ni ni-edit"></em>
                                        </h3>
                                    </div>
                                    <div class="nk-block-head-content">
                                        <a href="{{ route('index_liste_resva') }}" class="btn btn-danger btn-outline-white d-none d-sm-inline-flex">
                                            <em class="icon ni ni-arrow-left"></em>
                                            <span>Retour</span>
                                        </a>
                                        <a href="{{ route('index_liste_resva') }}" class="btn btn-danger btn-outline-white d-inline-flex d-sm-none">
                                            <em class="icon ni ni-arrow-left"></em>
                                        </a>
                                    </div>
                                </div>
                            </div>
                    <div class="nk-block">
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
                                                        <div class="col-lg-3">
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
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Liste des Utilisateurs</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio1ll" name="liste_user"
                                                                                @php  
                                                                                    if ($user->list_user === 'oui') {
                                                                                        echo 'checked';
                                                                                    }
                                                                                @endphp 
                                                                                 class="custom-control-input" value="oui">
                                                                                <label class="custom-control-label" for="customRadio1ll">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio2ll" name="liste_user" 
                                                                                @php  
                                                                                    if ($user->list_user === 'non') {
                                                                                        echo 'checked';
                                                                                    }
                                                                                @endphp 
                                                                                class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio2ll">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
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
                                                        <div class="col-lg-3">
                                                            <div class="form-group align-items-center justify-content-center">
                                                                <span class="preview-title overline-title">Liste des Postes</span>
                                                                <div class="row gy-4">
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio3ll" name="liste_poste"
                                                                                @php  
                                                                                    if ($user->list_poste === 'oui') {
                                                                                        echo 'checked';
                                                                                    }
                                                                                @endphp
                                                                                 class="custom-control-input" value="oui">
                                                                                <label class="custom-control-label" for="customRadio3ll">Oui</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6">
                                                                        <div class="preview-block">
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" id="customRadio4ll" name="liste_poste"
                                                                                @php  
                                                                                    if ($user->list_poste === 'non') {
                                                                                        echo 'checked';
                                                                                    }
                                                                                @endphp
                                                                                 class="custom-control-input" value="non">
                                                                                <label class="custom-control-label" for="customRadio4ll">Non</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
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
                                                        <div class="col-lg-3">
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
                                                        <div class="col-lg-3">
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
                                                        <div class="col-lg-3">
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
                                                        <div class="col-lg-3">
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
                                                        <div class="col-lg-3">
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
                                                        <div class="col-lg-3">
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
                                                        <div class="col-lg-3">
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
                                                        <div class="col-lg-3">
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
                                                        <div class="col-lg-3">
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
    </div>



@endsection
