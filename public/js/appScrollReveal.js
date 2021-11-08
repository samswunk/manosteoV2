function appScrollReveal()
{
  console.log("appScrollReveal chargé");
  // sr.reveal('.navbar', {
  //   duration: 2000,
  //   origin:'bottom'
  // })
  // div_hello
  // div_accueil
  // image_accueil
  // $(".image_accueil").delay("800").fadeIn(1500);
//   sr.reveal('.image_accueil', {
//     distance: '0px',
//     opacity: 0
// });
  sr.reveal('.image_accueil', {   
    delay   : 200,
    duration: 1000,
    distance: '0px',
    origin  :'top',
    easing: 'ease-in',
    scale: 0.85
    // rotate: {
    //   x: 20,
    //   z: 20
    // }
  });
  sr.reveal('.div_accueil', { 
    delay   : 600,
    duration: 800,
    distance: '10px',
    origin  : 'right',
    easing: 'ease-out'
  });
  sr.reveal('.div_hello', {
    delay   : 800,
    duration: 1000,
    distance: '10px',
    origin:'bottom', 
    viewFactor:0.3,
    easing: 'ease-in'
  })
  sr.reveal('.card', { interval: 80 });
  sr.reveal('.qui', {
    duration: 1000,
    distance: '200px',
    origin:'left',
    viewFactor:0.5
  })
  sr.reveal('.h1', {
    duration: 1000,
    distance: '200px',
    origin:'top'
  })
  sr.reveal('#contact', {
    duration: 3000,
    distance: '200px',
    origin:'left',
    viewFactor:0.8
  })
}