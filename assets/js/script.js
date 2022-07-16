$(document).ready(function(){
 $('.menu-icon').click(function(){
  let sideMenuWidth = $(".side-menu").innerWidth();
  let menuOpen = sideMenuWidth > 100;
   if(menuOpen){
     $('.side-menu').css("left", "-200px");
     $('.side-menu').css("width", "0px");
     
     
   }else if(!menuOpen){
      $('.side-menu').css("left", "0px");
      $('.side-menu').css("width", "200");
     

    
   }
});


$('.side-menu .close').click(function(){
   $('.side-menu').css("left", "-200px");
   $('.side-menu').css("width", "0px");   
})





// 
$('.admin-name').click(function(){
   $('.nav-card-c').hide();
   $('.nav-card-l').hide();
   $(".nav-card-r").slideToggle();
})

$('.li-card-r').click(function(){
   $('.nav-card-c').hide();
   $('.nav-card-l').hide();
   $(".nav-card-r").slideToggle();
})

$('.li-card-c').click(function(){
   $('.nav-card-r').hide();
   $('.nav-card-l').hide();
   $(".nav-card-c").slideToggle();
})
  
 
$('.li-card-l').click(function(){
   $('.nav-card-r').hide();
   $('.nav-card-c').hide();
   $(".nav-card-l").slideToggle();
})
  
 




  

})