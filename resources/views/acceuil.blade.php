@extends('layouts.header', ['titre' => 'Home', 'style' => '<link rel="stylesheet" href="css/acceuil.css">']) 

@section('contenu')
<nav class="navbar navbar-expand-sm bg-light">
    <div class="container-fluid">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{URL::to('/profile')}}">
            <img src="/image/base-profile/farmer.png" alt="Avatar Logo" style="width:50px; height: 50px;" class="rounded-pill"> 
          </a>
          <span style="font-size: 1.3rem;"> {{ucfirst(Auth::user()->nom)}} </span>
        </div>
      <!-- Links -->
        <ul class="navbar-nav">
          {{-- <li class="nav-item">
            <a class="nav-link" href="{{URL::to('/admin')}}" style="color: #38ada9;font-size:1.5rem;margin-right:30px;"><i class="fas fa-user-shield" > </i></a>
          </li>  --}}
          <li class="nav-item">
            <span class="position-fixed translate-middle badge rounded-pill bg-danger counter" style="font-size: 0.75rem"> 0 </span> 
            <a class="nav-link btn" id="messageBox" href="{{URL::to('/acceuil')}}" style="color: #1da1f2;font-size:1.5rem;margin-right:30px;"><i class="fas fa-message" > 
            
          </i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="{{URL::to('/setting')}}" style="color: #1da1f2;font-size:1.5rem;margin-right:30px;"> <i class="fa fa-cog"> </i> 
             
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link"href="{{URL::to('deconnexion')}}" style="color: #1da1f2;font-size:1.5rem;margin-right:30px;"> <i class="fa fa-power-off"> </i> </a>
          </li>
        </ul>
    </div>
</nav> 

<div class="row mx-0 p-0 my-2" style="height: 89vh;">
     <!--  left component -->
        <div class="col-3 bg-light p-3 ">  
          <h4> Chats </h4>
           <form>
                <div class="input-group">
                    <input type="text" class="form-control search_username rounded-pill" style="height: 50px" placeholder="search by Username..."> 
                </div>
                <hr>
            </form> 
                  <div class="left_comp"> 
                      @include('layouts.discussion')
                  </div>
        </div>
        <!--  right component -->
        <div class="col-9 bg-light p-2 rounded"> 
          <div class="right_comp">
          @include('layouts.welcome')
          </div>
              
        </div>
    </div>  
    <script src="/js/jquery-3.6.0.min.js"> </script>
    <script> 
      Unseen()

      $('.search_username').on('input', function(e){
          var result_search = e.target.value;  
              if(result_search){ 
              $('.left_comp').text('chargement....'); 
              setTimeout(() => {
                $('.left_comp').load('resultSearch/'+result_search); //create URL  
              }, 1000);   
              } else {
                    $('.left_comp').load('discussion');
              }
          }); 

          function Unseen(){
            $(document).ready(function (){
                $.ajax({
                    url:'{{URL::to('unseen')}}',
                    type:'get',
                    dataType:'json', 
                    success :(response) => {      
                       if(response == 0){
                        $('.counter').css('display','none')
                       }else{
                        $('.counter').text(response)
                       }
                        
                    },error :(error) => {
                        console.log(error)
                    }
                })
            })
          } 

          $(document).ready(function (){
              $('#messageBox').on('click', function(e){
                e.preventDefault()
                $('.counter').css('display', 'none')
              } )
          })
  </script>
@endsection