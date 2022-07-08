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






//   const menuBtn = $('.menu-icon');
 
//   menuBtn.click(function() {
//       if(!menuOpen){
//           $('menu-icon').addClass('open');
//          //  $('.side-menu').animate({left: '0px'});
//           menuOpen = true;
//       }else{
//           $('.menu-icon').removeClass('open');
//          //  $('.side-menu').animate({left: '-300px'});
//           menuOpen = false;
//       }
//   })
  
 




  

})