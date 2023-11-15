@extends('app')

@section('titre', 'Nouveau Processus')

@section('content')

    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm" >
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h3 class="text-center">
                                            Nouveau utilisateur
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
                        <form class="row g-gs" method="post" action="{{ route('add_user') }}">
                            @csrf
                            <div class="col-md-6" style="margin: 20px auto;">
                                <div class="row g-gs" >
                                    <div class="col-lg-12 " id="groupesContainer">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                    <div class="row g-4">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Cause">
                                                                    Matricule
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input placeholder="le matricule est génerer automatiquement" id="matricule" autocomplete="off" required name="matricule" type="text" class="form-control" id="Cause" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Cause">
                                                                    Nom et Prénoms
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input placeholder="Saisie obligatoire" id="nom" autocomplete="off" required name="np" type="text" class="form-control" id="Cause">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="corectif">
                                                                    Email
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input placeholder="Saisie obligatoire" autocomplete="off" required name="email" type="email" class="form-control" id="corectif">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <div class="form-label-group">
                                                                    <label class="form-label" for="password">
                                                                        Mot de passe
                                                                    </label>
                                                                </div>
                                                                <div class="form-control-wrap">
                                                                    <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                                                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                                        <em class="passcode-icon icon-hide icon ni ni-eye-off">
                                                                        </em>
                                                                    </a>
                                                                    <input name="mdp" autocomplete="new-password" type="password" class="form-control form-control-lg" required="" id="password" value="12345">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="preventif">
                                                                    Contact
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input placeholder="Saisie obligatoire" autocomplete="off" required name="tel" type="tel" class="form-control" id="tel">
                                                                </div>
                                                                <script>
                                                                    var inputElement = document.getElementById('tel');
                                                                    inputElement.addEventListener('input', function() {
                                                                        // Supprimer tout sauf les chiffres
                                                                        this.value = this.value.replace(/[^0-9]/g, '');

                                                                        // Limiter la longueur à 10 caractères
                                                                        if (this.value.length > 10) {
                                                                            this.value = this.value.slice(0, 10);
                                                                        }
                                                                    });
                                                                </script>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="email-address-1">
                                                                    Poste
                                                                </label>
                                                                <select required name="poste_id" class="form-select ">
                                                                    <option value="">
                                                                        Choisir
                                                                    </option>
                                                                    @foreach ($postes as $poste)
                                                                    <option value="{{ $poste->id }}">
                                                                       {{ $poste->nom }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner row g-gs">
                                                <!--<div class="col-md-6">
                                                    <div class="form-group text-center">
                                                        <a class="btn btn-lg btn-primary btn-dim" id="ajouterGroupe">
                                                            <em class="ni ni-plus me-2"></em>
                                                            <em>Nouveau</em>
                                                        </a>
                                                    </div>
                                                </div>-->
                                                <div class="col-md-12">
                                                    <div class="form-group text-center">
                                                        <button type="submit" class="btn btn-lg btn-success btn-dim">
                                                            <em class="ni ni-check me-2 "></em>
                                                            <em >Soumettre</em>
                                                        </button>
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

    <script>
        document.getElementById("ajouterGroupe").addEventListener("click", function(event) {
            event.preventDefault();
            const groupe = document.createElement("div");
            groupe.className = "card card-bordered";
            groupe.innerHTML = `
                                    <div class="card-inner">
                                            <div class="row g-4">
                                                <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Cause">
                                                                    Matricule
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input id="matricule" autocomplete="off" required name="matricule[]" type="text" class="form-control" id="Cause" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Cause">
                                                                    Nom et Prénoms
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input id="nom" autocomplete="off" required name="np[]" type="text" class="form-control" id="Cause">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="corectif">
                                                                    Email
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input autocomplete="off" required name="email[]" type="email" class="form-control" id="corectif">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="preventif">
                                                                    Contact
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input autocomplete="off" required name="tel[]" type="tel" class="form-control" id="preventif">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6å">
                                                            <div class="form-group">
                                                                <label class="form-label" for="email-address-1">
                                                                    Poste
                                                                </label>
                                                                <select required name="poste[]" class="form-select ">
                                                                    <option value="">
                                                                        Choisir
                                                                    </option>
                                                                    <option value="responsable">
                                                                        Responsable
                                                                    </option>
                                                                    <option value="valideur">
                                                                        Validateur
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                <div class="col-12">
                                                    <div class="form-group text-center">
                                                        <a class="btn btn-lg btn-danger btn-dim supprimerGroupe">
                                                            <em class="ni ni-trash me-2"></em>
                                                            <em>Supprimer</em>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
            `;


            groupe.querySelector(".supprimerGroupe").addEventListener("click", function() {
                groupe.remove();
            });

            document.getElementById("groupesContainer").appendChild(groupe);
        });
    </script>

    <script>
        function generateMatricule(length) {
          const charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
          let matricule = "";
          for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * charset.length);
            matricule += charset.charAt(randomIndex);
          }
          return matricule;
        }

        document.addEventListener("DOMContentLoaded", function () {
          const nameInput = document.querySelector('#nom');
          const matriculeInput = document.querySelector('#matricule');
          const passwordInput = document.querySelector('#password');

          nameInput.addEventListener('input', function () {
            const matricule = generateMatricule(10);
            matriculeInput.value = matricule;
          });
        });
    </script>



@endsection
