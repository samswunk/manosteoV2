function appCalendrier()
{
  const rdvIndex  = $("#rdvIndex").data('link');
  const userId    = $("#rdvIndex").data('userid');
  const userRole  = $("#rdvIndex").data('userrole');
  console.log("appCalendrier chargé \n"
              +"userRole : "+userRole+"\n"
              +"userId : "+userId);
  // console.log(moment(new Date()));
  var today = new Date();
  var demain = $("#startDate").val();
  //demain = moment(demain).tz("Europe/Paris").format("YYYY-MM-DD");
  var calendarEl = document.getElementById('calendar-holder2');
  var calendar = new FullCalendar.Calendar(calendarEl, 
  {
    height: 800,
    width: 600, 
    themeSystem: 'bootstrap4',
    defaultView: 'timeGridWeek',
    timezone: 'Europe/Paris',
    //ignoreTimezone: true,
    locale: 'fr',
    // editable: true,
    selectable: (userRole == "Administrateur" ? true : false),
    selectHelper: true,
    nowIndicator: true,
    validRange: 
    {
      start: demain
    },
    buttonText:  
    {
      today: 'Aujourd\'hui',
      month: 'Mois',
      week: 'Semaine',
      day: 'Jour',
      list: 'Liste'
    },
    header: 
    {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay,list',
    },
    plugins: ['dayGrid','timeGrid','list','interaction'],
    events: {
      url: rdvIndex,
      method: 'GET',
      /* paramètres envoyés lors de la requête 
      extraParams: {
        custom_param1: 'something',
        custom_param2: 'somethingelse'
      },/**/
      failure: function() {
        // alert('Impossible de charger les événements du calendrier !');
      }
    },
          /*eventRender: function(info) 
          {
            var cell = info['el'];
            var start = info.event.start;
            var end = info.event.end;
            var affichage3 = moment(start).format("HH:mm") + '-' + moment(end).format("HH:mm");
            if (moment(start).tz("Europe/Paris").format("YYYY-MM-DD") <= demain )
            {
                info.el.querySelector('.fc-content').setAttribute('style','opacity:0.2;background-color: #CCCCCC;');
                // ;
              }
              /*if ((info.view.type == 'dayGridMonth') ||  (info.view.type == 'timeGridWeek'))
              {
                var new_description =   info.event.title +
                '<br/><small>'
                  // + (info.event.extendedProps.description ? info.event.extendedProps.description : '') + '</small><br/>'
                  // + '<strong>Address: </strong><br/>' + infos.address + '<br/>'
                  + (info.event.extendedProps.adresse ? info.event.extendedProps.adresse : '');
                  info.el.querySelector('.fc-time').innerHTML = affichage3;
                  info.el.querySelector('.fc-title').innerHTML = new_description;
                  ;
              }
          },/**/
              /*function(info,event,element,view) 
              {
                var tooltip = new Tooltip(info.el, {
                  title: info.event.extendedProps.description,
                  placement: 'top',
                  trigger: 'hover',
                  container: 'body'
                });
            },/**/
            select: function(infos) 
            {
              if (userRole == "Administrateur")
              {   console.log("select: function(infos) ");
                  console.log("START : "+infos.start+"\n"+"END : "+infos.end);/**/
                  $('#ShowRdv').modal('show');
                  var vtitre  = moment(infos.start).tz("Europe/Paris").format("DD MMMM");
                  var vstart  = moment(infos.start).tz("Europe/Paris").format("DD/MM/YYYY HH:mm");
                  var vstart2 = getFormattedDate(new Date(infos.start));
                  var vend    = moment(infos.end).tz("Europe/Paris").format("DD/MM/YYYY HH:mm");
                  // console.log("START "+vstart+"\nSTART2 "+vstart+"\n END"+vend);
                  $('#ShowRdv').on('shown.bs.modal', function (event) 
                  {
                    $(".modal-body #booking_title").val('ATELIER DISPONIBLE '+vstart);
                    $(".modal-body #booking_start").val((vstart));
                    $(".modal-body #booking_end").val((vend));
                    
                    /*$.getScript('/event/new',function(){
                      $("#event_date_range").val(moment(start).format("DD/MM/YYYY HH:mm") +' - '+moment(end).format("DD/MM/YYYY HH:mm"));
                      date_range_picker();
                      $(".start_hidden").val(moment(start).format("DD/MM/YYYY HH:mm"));
                      $(".end_hidden").val(moment(end).format("DD/MM/YYYY HH:mm"));/**/
                  })
                  $('#ShowRdv').on('hidden.bs.modal', function () 
                  {
                      calendar.render();
                  })
              }
            },
            dateClick: function(info) 
            {
              if (userRole == "Administrateur")
              {
                console.log('dateClick: function(info) ');
                $('#ShowRdv').modal('show');
                var d = getFormattedDate(new Date(info.dateStr));
                $('#ShowRdv').on('shown.bs.modal', function (event) 
                {
                  $(".modal-body #booking_start").val((d));
                  $(".modal-body #booking_end").val((d));
                })
              }
            },
            eventDrop: (infos) => 
            {
              if (userRole == "Administrateur")
              {
                console.log(infos.event);
                $('#ShowRdv').modal('show');
                var vstart = new Date(infos.event.start);
                var vend = new Date(infos.event.end);
                
                $('#ShowRdv').on('shown.bs.modal', function (event) 
                {
                  $(".before").remove();
                  $("#booking_submit_button").show();
                  $("#booking_titreShowRdv").html("Etes vous sûr.e de vouloir déplacer cet évènement ?");
                  $(".modal-body #booking_submit_button").html("OUI");
                  $(".modal-body #booking_close_button").html("NON");

                  $(".modal-body #booking_id").val(infos.event.id);
                  $(".modal-body #booking_title").val(infos.event.title);
                  $(".modal-body #booking_start").before('<div class="col-3 before"><small>'+getFormattedDate(infos.oldEvent.start)+' => </small></div>');
                  $(".modal-body #booking_start").removeClass("col-8");
                  $(".modal-body #booking_start").addClass("col-5");
                  $(".modal-body #booking_start").val(getFormattedDate(vstart));
                  // $("#booking_start").val(getFormattedDate(vstart));
                  $(".modal-body #booking_end").before('<div class="col-3 before"><small>'+getFormattedDate(infos.oldEvent.end)+' => </small></div>');
                  $(".modal-body #booking_end").removeClass("col-8");
                  $(".modal-body #booking_end").addClass("col-5");
                  $(".modal-body #booking_end").val(getFormattedDate(vend));
                  $(".modal-body #booking_background_color").val(infos.event.backgroundColor);
                  $(".modal-body #booking_description").val(infos.event.extendedProps.description);             
                })
                $('#ShowRdv').on('hidden.bs.modal', function () 
                {
                  $(".before").remove();
                  infos.revert();
                  calendar.render();
                  // $(this).find('form')[0].reset();
                })
              }
            },
            eventClick: (infos) => 
            {
              console.log('eventClick: function(info) ');
              console.log('Event: ' + infos.event.title);
              console.log('Coordinates: ' + infos.jsEvent.pageX + ',' + infos.jsEvent.pageY);
              console.log('View: ' + infos.view.type);
              if (userRole == "Administrateur")
              {
                window.location.replace(""+infos.event.id+"/edit");
              }
              else
              {
                $.each(infos.event.extendedProps, function(index, val) {
                  console.log(index+"=>"+val);
                });/**/
                // console.log("isFree : "+ (infos.event.extendedProps.isFree));
                // console.log("idUser : "+ (infos.event.extendedProps.idUser));
                // console.log("idEvent: "+ (infos.event.id));
                // console.log('UserId: ' + userId );
                if (userId == infos.event.extendedProps.idUser) 
                {
                  console.log("LES DEUX ID SONT IDENTIQUES IL S'AGIT DE L'ATELIER DE LA PERS CONNECTÉE => MODIFICATION");
                  window.location.replace("../atelier/"+infos.event.id+"/edit"); 
                }
                else if ((infos.event.extendedProps.isFree) && (userId != infos.event.extendedProps.idUser))
                {
                  console.log("LES DEUX ID SONT DIFFÉRENTS MAIS L'ATELIER EST OUVERT ("+infos.event.extendedProps.isFree+") => INSCRIPTION" );
                  window.location.replace("../atelier/"+infos.event.id+"/edit");
                }
                else
                {
                  console.log("LES DEUX ID SONT DIFFÉRENTS ET L'ATELIER EST FERMÉ => PAS DE REACTION" );
                  // change the border color just for fun
                  infos.el.style.borderColor = 'red';
                  $('#ShowRdv').modal('show');
                  $("#ShowRdv .modal-lg").removeClass("modal-lg").addClass("modal-sm");
                  var vstart = new Date(infos.event.start);
                  var vend = new Date(infos.event.end);
                  
                  $("#divContenu").hide();
                  $('#ShowRdv').on('shown.bs.modal', function (event) 
                  {
                    $(".before").remove();
                    $("#booking_titreShowRdv").html("atelier indisponible");
                    $("#booking_submit_button").hide();
                    $("#booking_close_button").html("OK");

                    $(".modal-body #booking_id").val(infos.event.id);
                    /*$(".modal-body #booking_title").hide(); // .val(infos.event.title);
                    $(".modal-body #booking_start").hide(); // .val(getFormattedDate(vstart));
                    $(".modal-body #booking_end").hide(); // .val(getFormattedDate(vend));
                    $(".modal-body #booking_background_color").hide(); // .val(infos.event.backgroundColor);
                    $(".modal-body #booking_description").hide(); // .val(infos.event.extendedProps.description);             */
                  })
                  $('#ShowRdv').on('hidden.bs.modal', function () 
                  {
                    calendar.render();
                  })/**/
                }
              }
          },
          eventResize: (infos) => 
          {
            console.log(infos);
            if (userRole == "Administrateur")
              {
                $('#ShowRdv').modal('show');
                var vstart = new Date(infos.event.start);
                var vend = new Date(infos.event.end);
                console.log(infos);
                
                $('#ShowRdv').on('shown.bs.modal', function (event) 
                {
                  $(".before").remove();
                  $("#booking_submit_button").show();
                  $("#booking_titreShowRdv").html("Etes vous sûr.e de vouloir modifier cet évènement ?");
                  $("#booking_submit_button").html("OUI");
                  $("#booking_close_button").html("NON");
                  $(".modal-body #booking_id").val(infos.event.id);
                  $(".modal-body #booking_title").val(infos.event.title);

                  $(".modal-body #booking_start").val(getFormattedDate(vstart));
                  $(".modal-body #booking_start").val(getFormattedDate(vstart));

                  $(".modal-body #booking_end").val(getFormattedDate(vend));
                  $(".modal-body #booking_background_color").val(infos.event.backgroundColor);
                  $(".modal-body #booking_description").val(infos.event.extendedProps.description);             
                })
                $('#ShowRdv').on('hidden.bs.modal', function () 
                {
                  $(".before").remove();
                  infos.revert();
                  calendar.render();
                  // $(this).find('form')[0].reset();
                })
              }
          },
        });
      calendar.render();
      console.log('render effectué');
      $("#tabCalendrier").on('click',function(){
        appCalendrier();
      });      
}