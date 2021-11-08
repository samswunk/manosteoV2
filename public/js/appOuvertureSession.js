function appOuvertureSession()
  {
    console.log("appOuvertureSession chargé");
    $("#multi_repetition").change(function() 
    {
      $("#ConsoleRepetition").html($(this).val()+" fois ");
    });
    
    $("input[type=radio][name=day]").change(function() 
    {
      $("#ConsoleJour").html("Tous les " + $(this).attr('id'));
    });
    
    $(".disponible").on("change", function(ee)  
    {
      if (this.value == 1)
      {
        if (confirm("Attention vous avez cliqué sur libérer un rendez vous alors qu'un utilisateur était déjà inscrit"+"\n"
        +"Cette action libère l'atelier et le rend de nouveau disponible\n"
        +"Voulez vous continuer ?"))
        {
          //alert ("Suppression");
          $("#booking #booking_description").val('');
          $("#booking #booking_title").val("ATELIER DISPONIBLE " + $("div#booking #booking_start").val());
        }
      }
    });
    /*$("#booking_start").on("change", function(ee) 
    {
      console.log("on change : "+$(this).val());
      var dateStart = new Date($(this).val(), "d/M/Y H:i:s");
      console.log("dateStart : "+dateStart);
      $('#booking_end').datetimepicker('setDate', $(this).val());
    });/**/
  }