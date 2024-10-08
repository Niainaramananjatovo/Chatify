<div class='result'>    
</div> 

<script src="/js/jquery-3.6.0.min.js"> </script>
<script> 
resultSearch()

function resultSearch(){
    $.ajax ({
            url:'{{URL::to('getSearchPerson')}}/{{$data}}',
            type:'get', 
            dataType:'json',
            success:(response) => { 
                var data ="";
                if(response.length == 0){
                        data = 'Aucune résultat à afficher pour"{{$data}}"';
                } else {
                    for( let i = 0; i < response.length; i++){
                        console.log(response[i].nom)
                        if(response[i].id == {{Auth::user()->id}} ){
                            continue; 
                        } else {
                            data += "<div style = 'boborder: 2px solid white; background-color:white; padding: 5px;margin-bottom: 5px; cursor:pointer;' class='rounded'>"; 
                            data +="<div style='display: inline-block; clear: both; float: left; margin-right: 15px; '>";  
                            data +="<img src='/image/base-profile/indian.png'  width='50px' height='50px' style='border-radius: 50%;'>";
                            data +="</div>";
                            data +="<div style='display: inline-block;'>";
                            data +="<h5>"+response[i].nom+"</h5>";
                            data +="<span class='text-muted'> Users </span>";
                            data +="</div>";
                            data += "<a class='btn btn-primary' identifiant='"+ response[i].id+"' style='float:right; margin-top:7px;' id='addUserDiscussion'> <i class='fa fa-user-plus'> </i> </a>"
                            data +="</div >" ;
                        }
                    }
                }
                $('.result').append(data);
                console.log(response);
            }, 
            error: (error)=>{
                console.log(error);
            } 
        })
    }

    $(document).on('click', '#addUserDiscussion', function(){
        var chatTo = $(this).attr('identifiant');
        $.ajax ({
            url:'{{URL::to('addUserDiscussion')}}/'+chatTo,
            type:'get', 
            success : (response) => { 
                console.log(response);
            }, 
            error: (error) => {
            }
    }) 
})
</script>

