  function appCounterUp()
  {
    console.log("appCounterUp chargé");
    
    $('.counter').counterUp({
      delay: 100,
      time: 1200
    });
    
    $(".knob").knob();
  }