function appDateTimePickers() 
{
  console.log('appDateTimePicker chargé')
  $.datetimepicker.setLocale('fr');
  $.datetimepicker.setDateFormatter('moment');
  
  $('.datetimepicker').datetimepicker({
    format:"DD/MM/YYYY HH:mm",
    onChangeDateTime:function(ct,$i)
    {
      var control = $i[0]['id'];
      var today = new Date();
      ct.setHours(ct.getHours() + 2);
      var d = getFormattedDate(new Date(ct));
    }
  });

  $('.datepicker').datetimepicker({
    format:"DD/MM/YYYY",
    timepicker:false
  });

  $('.timepicker').datetimepicker({
    datepicker:false,
    format:'HH:mm',
    onChangeDateTime:function(ct,$i)
    {
      var control = $i[0]['id'];
      var today = new Date();
      ct.setHours(ct.getHours() + 2);
      var d = moment(ct).tz("Europe/Paris").format("HH:mm");
    }
  });/**/
}