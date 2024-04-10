@extends('app')

@section('titre', 'Statistique')

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
                                            <span>Statistique</span>
                                            <em class="icon ni ni-bar-chart-alt"></em>
                                        </h3>
                                    </div>
                                </div>
                </div>
                <div class="nk-block">
                    <div class="row g-gs">
                            <div class="col-lg-12">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner">
                                        <div class="invest-data">
                                            <div class="invest-data-amount g-2">
                                                <div class="invest-data-history">
                                                    <div class="title text-center">
                                                        Utilisateur(s)
                                                    </div>
                                                    <div class="amount text-center">
                                                        {{ $users_nbre }}
                                                    </div>
                                                </div>
                                                <div class="invest-data-history">
                                                    <div class="title text-center">
                                                        Processus(s)
                                                    </div>
                                                    <div class="amount text-center">
                                                        {{ $proces_nbre }}
                                                    </div>
                                                </div>
                                                <div class="invest-data-history">
                                                    <div class="title text-center">
                                                        Réclamation(s)
                                                    </div>
                                                    <div class="amount text-center">
                                                        {{ $ams_nbre }}
                                                    </div>
                                                </div>
                                                <div class="invest-data-history">
                                                    <div class="title text-center">
                                                        Résumés des réclamation(s)
                                                    </div>
                                                    <div class="amount text-center">
                                                        {{ $reclas_nbre }}
                                                    </div>
                                                </div>
                                                <div class="invest-data-history">
                                                    <div class="title text-center">
                                                        Cause(s)
                                                    </div>
                                                    <div class="amount text-center">
                                                        {{ $causes_nbre }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-xxl-4">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner-group">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Utlisateurs</h6>
                                                </div>
                                            </div>
                                        </div>
                                        @foreach($users_tri as $key => $users_tr)
                                        <div class="card-inner card-inner-md">
                                            <div class="user-card">
                                                <div class="user-avatar bg-primary-dim">
                                                    <em class="ni ni-user" ></em>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text">
                                                        {{ $users_tr->name }} ( {{ $users_tr->poste }} )
                                                    </span>
                                                    <span class="sub-text">
                                                        Email :{{ $users_tr->email }} / Tel : {{ $users_tr->tel }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-xxl-4">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner border-bottom">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title">Résumés des réclamations</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="nk-activity">
                                        @foreach($reclas_tri as $key => $reclas_tr)
                                        <li class="nk-activity-item">
                                            <div class="nk-activity-media user-avatar bg-primary">
                                                <em class="ni ni-cards" ></em>
                                            </div>
                                            <div class="nk-activity-data">
                                                <div class="label">
                                                    {{ $reclas_tr->nom }}
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-xxl-4">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner border-bottom">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title">Causes</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="nk-activity">
                                        @foreach($causes_tri as $key => $causes_tr)
                                        <li class="nk-activity-item">
                                            <div class="nk-activity-media user-avatar bg-primary">
                                                <em class="ni ni-clipboard" ></em>
                                            </div>
                                            <div class="nk-activity-data">
                                                <div class="label">
                                                    {{ $causes_tr->nom }}
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner" >
                                        <div class="form-group text-center">
                                            <label class="form-label" for="cf-full-name">
                                                Suivis des réclamations
                                            </label>
                                        </div>

                                        <div>
                                            <div>
                                                <canvas id="myCharts"></canvas>
                                            </div>
                                        </div>

                                        <script>
                                            var ctx = document.getElementById('myCharts').getContext('2d');
                                            var myCharts = new Chart(ctx, {
                                            type: 'doughnut',
                                            data: {
                                                labels: ['Non traité ({{ $rech_nt }})', 'En cours ({{ $rech_en }})', 'Terminé ({{ $rech_t }})'],
                                                datasets: [{
                                                    data: [{{ $rech_nt }},{{ $rech_en }},{{ $rech_t }}],
                                                    backgroundColor: ['red', 'orange', 'green'],
                                                    borderColor: 'white',
                                                    borderWidth: 1
                                                }],
                                                hoverOffset: 4
                                            },
                                            options: {
                                                responsive: true,
                                                maintainAspectRatio: false,
                                                plugins: {
                                                    legend: {
                                                        position: 'right',
                                                    },
                                                }
                                            }
                                        });
                                        </script>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner" >
                                        <div class="form-group text-center">
                                            <label class="form-label" for="cf-full-name">
                                                Résultat des recherches
                                            </label>
                                        </div>

                                        <div>
                                            <div>
                                                <canvas id="myChartss"></canvas>
                                            </div>
                                        </div>

                                        <script>
                                            var ctx = document.getElementById('myChartss').getContext('2d');
                                            var myChartss = new Chart(ctx, {
                                            type: 'doughnut',
                                            data: {
                                                labels: ['Réclamations ({{ $rech_tr_recla }})', 'Causes ({{ $rech_tr_cause }})', 'Néant ({{ $rech_tr_n }})'],
                                                datasets: [{
                                                    data: [{{ $rech_tr_recla }},{{ $rech_tr_cause }},{{ $rech_tr_n }}],
                                                    backgroundColor: ['blue', 'yellow', 'gray'],
                                                    borderColor: 'white',
                                                    borderWidth: 1
                                                }],
                                                hoverOffset: 4
                                            },
                                            options: {
                                                responsive: true,
                                                maintainAspectRatio: false,
                                                plugins: {
                                                    legend: {
                                                        position: 'right',
                                                    },
                                                }
                                            }
                                        });
                                        </script>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner" >
                                        <div class="form-group text-center">
                                            <label class="form-label" for="cf-full-name">
                                                Escaladeur
                                            </label>
                                        </div>

                                        <div>
                                            <div>
                                                <canvas id="myChartsss"></canvas>
                                            </div>
                                        </div>

                                        <script>
                                            var ctx = document.getElementById('myChartsss').getContext('2d');
                                            var myChartsss = new Chart(ctx, {
                                            type: 'doughnut',
                                            data: {
                                                labels: ['Oui ({{ $esc_oui }})', 'Non ({{ $esc_non }})'],
                                                datasets: [{
                                                    data: [{{ $esc_oui }},{{ $esc_non }}],
                                                    backgroundColor: ['Red', 'green'],
                                                    borderColor: 'white',
                                                    borderWidth: 1
                                                }],
                                                hoverOffset: 4
                                            },
                                            options: {
                                                responsive: true,
                                                maintainAspectRatio: false,
                                                plugins: {
                                                    legend: {
                                                        position: 'right',
                                                    },
                                                }
                                            }
                                        });
                                        </script>

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

@endsection

