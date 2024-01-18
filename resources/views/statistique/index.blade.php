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
                                                    {{ $causes_tr->nom }} -> {{ $causes_tr->nbre_suivi }}
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner" >
                                        <div>
                                            <canvas id="myChart"></canvas>
                                        </div>

                                        <script>
                                            var ctx = document.getElementById('myChart').getContext('2d');
                                            var myChart = new Chart(ctx, {
                                                type: 'bar',
                                                data: {
                                                    labels: <?php echo json_encode($dataLabels); ?>,
                                                    datasets: [{
                                                        label: 'Nombre de Suivis par Cause',
                                                        data: <?php echo json_encode($dataCounts); ?>,
                                                        backgroundColor: 'blue',
                                                        borderColor: 'white',
                                                        borderWidth: 1
                                                    }]
                                                },
                                                options: {
                                                    scales: {
                                                        y: {
                                                            beginAtZero: true,
                                                            ticks: {
                                                                stepSize: 1
                                                            }
                                                        }
                                                    }
                                                }
                                            });
                                        </script>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner">
                                        <div class="form-group text-center">
                                            <label class="form-label">Choisir un interval de date</label>
                                            <div class="form-control-wrap">
                                                <div class="input-daterange date-picker-range input-group">
                                                    <input data-date-format="yyyy-mm-dd" name="date1" id="date1" type="text" class="form-control" />
                                                    <div class="input-group-addon">TO</div>
                                                    <input data-date-format="yyyy-mm-dd" name="date2" id="date2" type="text" class="form-control me-2" />
                                                    <button id="btn_rech" class="btn btn-outline-success" >
                                                        <em class="ni ni-search" ></em>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="camenber2">

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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Écouteur pour le changement de sélection
        document.getElementById('btn_rech').addEventListener('click', function() {
            var date1 = document.getElementById('date1').value;
            var date2 = document.getElementById('date2').value;

            $.ajax({
                url: '/get_date',
                method: 'GET',
                data: { date1: date1, date2: date2 }, // Pass date1 and date2 to the server
                success: function (data) {
                    addGroups(data);
                },
                error: function () {
                    toastr.error("Une erreur s'est produite lors de la récupération des informations.");
                }
            });
        });

        function addGroups(data) {
            var dynamicFields = document.getElementById("camenber2");

            // Supprimer le contenu existant
            while (dynamicFields.firstChild) {
                dynamicFields.removeChild(dynamicFields.firstChild);
            }

            var groupe = document.createElement("div");
            groupe.className = "";
            groupe.innerHTML = `
                <canvas id="myChart2"></canvas>
            `;

            document.getElementById("camenber2").appendChild(groupe);

            var ctx = document.getElementById('camenber2').getContext('2d');
            var camenber2 = new camenber2(ctx, {
                type: 'bar',
                data: {
                    labels: data.dataLs,
                    datasets: [{
                        label: 'Nombre de Suivis par Cause',
                        data: data.dataCs,
                        backgroundColor: 'blue',
                        borderColor: 'white',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        }
    });
</script>

@endsection

