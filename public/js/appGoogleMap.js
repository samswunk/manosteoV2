function appGoogleMap()
{
  let map;

  function initMap() 
  {
      map = new google.maps.Map(document.getElementById("map"), 
      {
          center: { lat: -34.397, lng: 150.644 },
          zoom: 8,
      });
  }

  function toggle_div(bouton, id) 
  { 
      var div = document.getElementById(id); // On r�cup�re le div cibl� gr�ce à l'id
      if(div.style.display=="none") {
          div.style.display = "block";
          bouton.innerHTML = "-"; 
      } else { // S'il est visible...
          div.style.display = "none"; 
          bouton.innerHTML = "+";  
      }
  }
  function sub()
  {
      document.forms['recherche'].submit();
  }              

}