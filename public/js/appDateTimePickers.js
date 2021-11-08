function appDateTimePickers() 
{
    console.log("appDateTimePickers chargé");
    $.datetimepicker.setLocale('fr');
    jQuery.datetimepicker.setLocale('fr');

    $.datetimepicker.setDateFormatter('moment');
    
    $('.datetimepicker').datetimepicker(
        {
        format:'d/m/Y H:i',
        lang:'fr'
        });

    $('.datepicker').datetimepicker(
        {
        format:'d/m/Y',
        timepicker:false,
        lang:'fr'
        });

    $('.timepicker').datetimepicker(
        {
        format:'H:i',
        timepicker:true,
        datepicker:false,
        lang:'fr'
        });    
        
    $('.datetimepickerRdv').datetimepicker({
      format:"DD/MM/YYYY HH:mm",
      onChangeDateTime:function(ct,$i)
      {
        var control = $i[0]['id'];
        var today = new Date();
        ct.setHours(ct.getHours() + 2);
        var d = getFormattedDate(new Date(ct));
        switch (control) 
        {
          case 'booking_start':
            $('#booking_end').val(d);
            $('#booking_end').datetimepicker({minDate: ct});
            break;
          /*case 'booking_end':
              console.log("Je mets max date de booking_start à "+$('#booking_end').val());
            $('#booking_start').val($('#booking_end').val());
            $('#booking_start').datetimepicker({maxDate: ct});
            break;*/
        }
      }
    });

    $('.datepickerRdv').datetimepicker({
      format:"DD/MM/YYYY",
      timepicker:false,
      onChangeDateTime:function(ct,$i)
      {
        var control = $i[0]['id'];
        console.log("je suis "+control)
        switch (control) 
        {
          case 'multi_start':
            $('#multi_end').val($('#multi_start').val());
            $('#multi_end').datetimepicker({minDate: ct});
            break;
        }
        $("#ConsoleDate").html("Du " + $('#multi_start').val() +" au "+$('#multi_end').val());
      }
    });
    $('.timepickerRdv').datetimepicker({
      datepicker:false,
      format:'HH:mm',
      onChangeDateTime:function(ct,$i)
      {
        var control = $i[0]['id'];
        var today = new Date();
        ct.setHours(ct.getHours() + 2);
        var d = moment(ct).tz("Europe/Paris").format("HH:mm");
        switch (control) 
        {
          case 'multi_start_hour':
            $('#multi_end_hour').val(d);
            $('#multi_end_hour').datetimepicker({minDate: ct});
            break;
          }
          $("#ConsoleHeure").html("De " + $('#multi_start_hour').val() +" à "+$('#multi_end_hour').val());
      }
    });/**/
}