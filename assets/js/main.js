const responsive = {
    0:{
        items:1
    },
    320:{
        items:1
    },
    500:{
        items:2
    },
    750:{
        items:3
    },
    1000:{
        items:4
    },
    1200:{
        items:5
    }

   
}
$(document).ready(function(){

    $nav = $('.nav');
    $toggleCollapse=$('.toggle-collapse');

    /*click event on toggle menu */
    $toggleCollapse.click(function(){
        $nav.toggleClass('collapse');
    })




    /*owl carousel for blog */
    $('.owl-carousel').owlCarousel({
        loop: true,
        items: 4,
        autoplay: true,
        // autoplayTimeout: 3000,
        dots: false,
        // nav: true,
        autoplayHoverPause: true,
        smartSpeed: 1000,
        navText: [$('.carousel-blog .prev-item'),$('.carousel-blog .next-item')],
        responsive:responsive
    });


    //animation on scroll instance
    AOS.init();



    // window.onscroll = function(){myFun()}

    // function myFun(){
    //     let navigation = document.querySelector('#sticky');
    //     var sticky = navigation.offsetTop;
    // if(window.pageYOffset >= sticky){
    //     navigation.classList.add('sticky-top');
    // }else{
    //     navigation.classList.remove('sticky-top')
    // }
    // }


    //Typing and deleting effect
    const words = ["...creating good food memories"];
    let i = 0;
    let timer;

    function typingEffect() {
        let word = words[i].split("");
        var loopTyping = function() {
            if (word.length > 0) {
                document.getElementById('site-subtitle').innerHTML += word.shift();
            } else {
                deletingEffect();
                return false;
            };
            timer = setTimeout(loopTyping, 200);
        };
        loopTyping();
    };

    function deletingEffect() {
        let word = words[i].split("");
        var loopDeleting = function() {
            if (word.length > 0) {
                word.pop();
                document.getElementById('site-subtitle').innerHTML = word.join("");
            } else {
                if (words.length > (i + 1)) {
                    i++;
                } else {
                    i = 0;
                };
                typingEffect();
                return false;
            };
            timer = setTimeout(loopDeleting, 200);
        };
        loopDeleting();
    };

    // typingEffect();








    // change background image at a specified time
    var x = 0;
    let images =[];
    var time = 2500;
    var slider = document.getElementById('slide-img');

    images[0] = "url('assets/img/travel.jpg')";
    images[2] = "url('assets/img/slide.jpg')";
    images[3] = "url('assets/img/slide2.jpg')";
    images[4] = "url('assets/img/slide3.jpg')";

    


    function changeImg(){
        slider.style.backgroundImage = images[x];

        if(x < images.length -1){
            x++;
        }else{
            x = 0;
        }

        setTimeout("changeImg()", time);
    }

    // window.onload = changeImg;

    /****************************  TutaBlog *************************/
    $('li.li-food').mouseenter(function(){
        $('.dropdown-items-food').fadeIn();
    })
    $('li.li-food').mouseleave(function(){
        $('.dropdown-items-food').fadeOut();
    })

    $('li.li-fashion').mouseenter(function(){
        $('.dropdown-items-fashion').fadeIn();
    })
    $('li.li-fashion').mouseleave(function(){
        $('.dropdown-items-fashion').fadeOut();
    })

    $('li.li-sports').mouseenter(function(){
        $('.dropdown-items-sports').fadeIn();
    })
    $('li.li-sports').mouseleave(function(){
        $('.dropdown-items-sports').fadeOut();
    })

    $('li.li-explore').mouseenter(function(){
        $('.dropdown-items-explore').fadeIn();
    })
    $('li.li-explore').mouseleave(function(){
        $('.dropdown-items-explore').fadeOut();
    })

    let hint = $("#titleHint");
    if(hint.text() == ""){
        hint.css({"background": "none", 'border': 'none'})
    }


});

