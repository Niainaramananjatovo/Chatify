@extends('layouts/header', ['titre' => 'Inscription', 'style' => '<link rel="stylesheet" href="css/inscription.css">'])
@section('contenu')
    <div class="container d-flex justify-content-center align-items-center bg-light" style="height: 90vh">
        <div class="container w-50 bg-white border border-black p-3">
            <form  id="formulaire">
                @csrf
                <h1 style="text-align: center;"> Inscription </h1>

                <div class="mb-3 mt-3 ">
                    <label for="nom" class="form-label">Nom d'utilisateur </label>
                    <input type="text" class="form-control" id="nom" placeholder="entrer un nom d'utilisateur"
                        name="nom">
                    <span class="text-danger error_nom" style="font-size:0.75em"> </span>
                </div>

                <div class="mb-3 mt-3 ">
                    <label for="email" class="form-label">Adresse Email </label>
                    <input type="email" class="form-control" id="email" placeholder="Entrer votre adresse email"
                        name="email">
                    <span class="text-danger error_email" style="font-size:0.75em"></span>
                </div>

                <div class="mt-3 mb-3 ">
                    <label for="pwd" class="form-label">Mot de passe </label>
                    <input type="password" class="form-control " id="pwd" placeholder="Entrer votre mot de passe"
                        name="pswd">
                    <span class="text-danger error_pswd" style="font-size:0.75em"></span>
                </div> 

                <div class="mt-3 mb-3">
                    <label for="cpwd" class="form-label">Confirm password </label>
                    <input type="password" class="form-control" id="cpwd" placeholder="Confirmez votre mot de passe"
                        name="cpswd">
                    <span class="text-danger error_cpswd" style="font-size:0.75em"></span>
                </div> 

                <div class="mt-3 mb-3"> 
                  <button type="submit" class="btn btn-primary rounded" style="margin-bottom: 5px;"> S'inscrire </button>
                </div>
                <hr>
                <span> Avez-vouz déjà de compte?</span><a href="{{ URL::to('') }}"> Se Connecter </a>
            </form>
        </div>
    </div>

    <script src="{{ 'js/jquery-3.6.0.min.js' }}"></script>
    <script>
        $(document).ready(function() {
            $('#formulaire').on('submit', function(e) {
                e.preventDefault();
                var data = $(this)[0];
                var formdata = new FormData(data);
                $.ajax({
                    url: '{{ URL::to('CreateUser') }}',
                    type: 'post',
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        alert(response.success)
                        data.reset();
                        window.location.href = "{{ URL::to('') }}";
                    },
                    error: (error) => {
                        $('.error_nom').text(error.responseJSON.errors.nom);
                        $('.error_email').text(error.responseJSON.errors.email);
                        $('.error_pswd').text(error.responseJSON.errors.pswd);
                        $('.error_cpswd').text(error.responseJSON.errors.cpswd);
                    }
                });

            });
        })
    </script>
@endsection
