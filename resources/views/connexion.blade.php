@extends('layouts/header', ['titre' => 'Connexion', 'style' => '<link rel="stylesheet" href="css/connexion.css">'])
@section('contenu')
    <div class="container d-flex justify-content-center align-items-center" style="height: 85vh">
        <div class="container mt-3 w-25 border rounded p-2 bg-white">
            <form class="form_connexion">
                @csrf 
                <center> 
                    <div class="mt-3 mb-5"> 
                        <i class="fab fa-facebook-messenger" style="font-size: 2.5rem; color:#1da1f2"> </i> 
                        <span style="color:#1da1f2" class="lead display-6"> Chatify </span>
                    </div>
                </center>
                <div class="mt-3 mb-3">
                    <h1 style="text-align: center; font-size:1.5rem;" id="titre"> Se Connecter </h1>
                </div>
                <div class="mt-3 mb-3">
                    <input type="email" name="email" id="email" placeholder="Adresse email" class="form-control">
                </div>
                <div class="mt-3 mb-3">
                    <input type="password" name="password" id="password" placeholder="Entrer votre mot de passe" class="form-control">
                </div>
                <div class="mt-3 mb-3">
                    <button type="submit" class="w-100 p-2 rounded " style="font-size: 1.25rem"> Continuer </button>
                </div>
                <div class="mt-3 mb-4">
                    <span> Vous n'avez pas de compte?</span><a href="{{ URL::to('/inscription') }}">S'inscrire</a>
                </div>

            </form>
        </div>
    </div>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.form_connexion').on('submit', function(e) {
                e.preventDefault();
                var data = $(this)[0];
                var formdata = new FormData(data);
                $.ajax({
                    url: '{{ URL::to('authentification') }}',
                    type: 'post',
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        if (response.success) {
                            data.reset();
                            window.location.href = '{{ URL::to('/acceuil') }}';
                        } else {
                            alert(response.error);
                        }
                    },
                    error: (error) => {
                        console.log(error);
                    }
                });
            });
        })
    </script>
@endsection
