$(document).ready(function(){

    //Manage Indikator
    $('#itdformsubjek').on('submit', function(event){

        var myForm = document.getElementById('itdformindikator');
        var formData = new FormData(myForm);
        var id_subjek = $("#itdsubjek :selected").val();

        formData.append('id_subjek', id_subjek);

       event.preventDefault();
       $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

      $.ajax({
          url: $(this).attr('action'),
          method: 'post',
          data: formData, 
          contentType: false,
          processData: false,
          success: function(result){
            var obje = JSON.parse(result);
            var x = document.getElementById('itdindikator');
            var len = 0;

            //Delete Populated Select Option
            var optionlen = x.options.length;
            for(var i=0; i<optionlen; i++)
            {
                x.remove(i);
            }

            if(obje != null){
                len = obje.length;
              }

            if(len > 0){
                //Read data and create <option>
                for(var i=0; i<len; i++){
                  var id = obje[i].id;
                  var nama_indikator = obje[i].nama_indikator;
                  var option = "<option value='"+id+"'>"+nama_indikator+"</option>"; 
 
                  $('#itdindikator').append(option); 
                }

                //show the form
                document.getElementById('panelitdformindikator').style.display = "block";

              }else{
                document.getElementById('panelitdformindikator').style.display = "none";
              }
          },
          
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Error: " + XMLHttpRequest.responseText); 
            } 
        });

       });
 



});

  