
/*------- search button ----------- */

searchform = document.querySelector('.search-form');

document.querySelector('#search-btn').onclick = () => {
    searchform.classList.toggle('active');
}

 /*======= toggle icon navbar ===========*/
 let menuIcon = document.querySelector('#menuBar');
 let navbar = document.querySelector('.navbar');
 
 menuIcon.onclick = () => {
    // menuIcon.classList.toggle('bx-x');
     navbar.classList.toggle('active');
 };

/*======= scroll section active line ===========*/

window.onscroll = () => {

    /*======= sticky nav bar ===========*/
    let header = document.querySelector('div.top-header');

    header.classList.toggle('sticky', window.scrollY > 180);

    /*======= remove toggle icon and navbar when click navbar link ===========*/
    //menuIcon.classList.remove('bx-x');
    navbar.classList.remove('active');
};

/*----- home section start ------*/

var swiper = new Swiper(".mySwiper", {
    spaceBetween: 5,
    centeredSlides: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },  
});

/*--------- login form swiper and effects -----------*/
const container = document.querySelector(".container");
const pwShowHide = document.querySelectorAll(".showHidePw");
const pwFields = document.querySelectorAll(".password");
const signUp = document.querySelector(".signup-link");
const login = document.querySelector(".login-link");

    //   js code to show/hide password and change icon
    pwShowHide.forEach(eyeIcon =>{
        eyeIcon.addEventListener("click", ()=>{
            pwFields.forEach(pwField =>{
                if(pwField.type ==="password"){
                    pwField.type = "text";
                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("uil-eye-slash", "uil-eye");
                    })
                }else{
                    pwField.type = "password";
                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("uil-eye", "uil-eye-slash");
                    })
                }
            }) 
        })
    })


/*-------- radio button tic -----------*/
searchform = document.querySelector('.student');
searchform1 = document.querySelector('.teacher');

    document.querySelector('#one').onclick = () => {
        searchform.classList.toggle('activate'); 
        searchform1.classList.remove('opened');
    }

    document.querySelector('#two').onclick = () => {
        searchform.classList.remove('activate');
        searchform1.classList.toggle('opened');      
    }

/*-------- side menu bar -----------*/
const times = document.querySelector('#time-icon');
const bars = document.querySelector('#bars');
const headerTwo = document.querySelector('.header_two');

bars.onclick = () =>{
    bars.classList.toggle('bx-x');
    headerTwo.classList.toggle('open');
  }

times.onclick = () => {
    bars.classList.remove('bx-x');
    headerTwo.classList.remove('open');
}
