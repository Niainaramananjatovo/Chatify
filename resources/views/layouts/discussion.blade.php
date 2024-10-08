 <div id="listDiscussion"> 

 </div>
<script src="/js/jquery-3.6.0.min.js"> </script>

<script> 
     getDiscussion() 
         function getDiscussion(){
                 $.ajax({
                    url:'{{URL::to('getDiscussion')}}',
                    type:'get',
                    dataType:'json', 
                    success :(response) => {     
                        var data='';
                        if(response.length==0){
                             data +='Aucune conversation pour cette utilisateur'
                         } else{
                            for (let i = 0; i < response.length; i++) {
                                  data+= "<div class='Chat_to rounded p-2' userName ='"+ response[i].user.nom +"' id_Discussion ='"+response[i].id_Discussion +"' style ='border: 2px solid white; background-color:white; padding: 5px; margin-bottom: 5px; cursor:pointer;' >" 
                                  data+= "<div style='display: inline-block; clear: both; float: left; margin-right: 15px;'>"
                                  data+= "<img src='/image/base-profile/indian.png'  width='50px' height='50px' class='rounded-circle'>"
                                  data+= "</div>"
                                  data+= "<div style='display: inline-block;'>" 
                                  data+= "<h5>"+ response[i].user.nom.charAt(0).toUpperCase()+ response[i].user.nom.slice(1, response[i].user.nom.length) +"</h5>"
                                  data+= "<h6 class='last'> Start conversation  </h6>"
                                  data+= "</div>"
                                  data+= "</div>" 
                            }
                        }
                         $('#listDiscussion').html(data)
                    },
                    error :(error) => {
                          console.log(error)
                    } 
                    })
                }
                 

            $(document).on('click','.Chat_to', function(){
                var userName= $(this).attr('userName');
                var id_discution = $(this).attr('id_Discussion');
                $('.right_comp').load('message/'+userName +'/'+id_discution);
            })  

            // $(document).ready(function (){ 
            //     var id = 2
            //     $.ajax({
            //         url:'{{URL::to('lastmessage')}}/'+id,
            //         type:'get',
            //         dataType:'json', 
            //         success :(response) => {      
            //             if(response[0].from == {{Auth::user()->id}}){
            //                 $('.last').text('You: '+response[0].message) 
            //                 $('h6').addClass('text-muted')
            //             }
            //             else {
            //                 $('.last').text(response[0].message)
            //             }
            //         },error :(error) => {
            //             console.log(error)
            //         }
            //     })
            // })
</script> 