const header = document.querySelector(".header");
function fixedNavbar(){
    header.classList.toggle('scroll',window.pageYOffset>0)
}
fixedNavbar();
window.addEventListener('scroll',fixedNavbar);

let menuButton = document.getElementById("menu-button");
menuButton.addEventListener('click',function(){
    let nav = document.querySelector(".navbar");
    nav.classList.toggle('active');
});

//slider-top
const slider = document.querySelector(".slider-top");
if(slider){
    function toRight(){
        if(slider.scrollWidth-slider.clientWidth === slider.scrollLeft){
            slider.scrollTo({
                left:0,
                behavior:'smooth'
            });
        }
        else{
            slider.scrollBy({
                left:window.innerWidth,
                behavior:'smooth'
            });
        }
    }

    function toLeft(){
        slider.scrollBy({
            left: -window.innerWidth,
            behavior:'smooth'
        });
    }

    let timerId = setInterval(toRight,5000);
    function resetTimer(){
        clearInterval(timerId);
        timerId=setInterval(toRight,5000);
    }
    document.querySelector(".left-arrow").onclick=function() {
        toLeft();
        resetTimer();
    }
    document.querySelector(".right-arrow").onclick=function() {
        toRight();
        resetTimer();
    }
}

//slider-middle
const slide1 = document.getElementById("slide-1");
    if(slide1){
    slide1.onclick= function() {
        document.getElementById("image-container").style.left='0px';
    }
}

const slide2 = document.getElementById("slide-2");
if(slide2){
    slide2.onclick= function() {
        document.getElementById("image-container").style.left='-600px';
    }
}

//slider products
$('.product-slider').slick({
    dots: true,
    arrows:true,
    slidesToShow: 3,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]

});

//registration
let register_show = document.getElementById("register-show");
if(register_show){
    register_show.onclick= function() {
        event.preventDefault(); // Prevent the default behavior of the button click
        document.getElementById("login-f").style.display='none';
        document.getElementById("register-f").style.display='block';
    }
}
let login_show = document.getElementById("login-show");
if(login_show){
    login_show.onclick= function() {
        event.preventDefault(); // Prevent the default behavior of the button click
        document.getElementById("register-f").style.display='none';
        document.getElementById("login-f").style.display='block';
    }
    }


/* profile box */

let userButton = document.getElementById("user-button");
if (userButton.href==""){
    userButton.addEventListener('click',function(){
        let box = document.querySelector(".profile-box");
        box.classList.toggle('active');
    });
}

// sign out */
$('#sign-out').click(function(){
    $.ajax({
        url: '?argument=signout',
        success: function(data) {
            window.location.href = 'index.php';
        }
    });
});

/** admin */
$("#message").fadeOut(2000,function(){
    $.ajax({
        url: '?argument=message',
    });
});