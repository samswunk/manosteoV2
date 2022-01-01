function appPaiement()
  {
    console.log("appPaiement chargé");
    $('input[type=radio][class=moyenPaiement]').change(function()
    // $("#consultation[facture][paiement]").change(function()
    {
        $("#divNumeroCheque").hide();
        $("#add_consultation_facture_numeroCheque").removeAttr('required');
        if ($(this).val()==1) 
        {
          $("#divNumeroCheque").fadeIn(); 
          $("#add_consultation_facture_numeroCheque").attr('required',true);
        }
        console.log($(this).val());
    });
  }