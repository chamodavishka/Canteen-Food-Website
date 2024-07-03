
/*-------- radio button tic -----------*/
//searchform = document.querySelector('.student');
//searchform1 = document.querySelector('.teacher');

//document.querySelector('#one').onclick = () => {
  //  searchform.classList.toggle('activate'); 
    //searchform1.classList.remove('opened');
//}

//document.querySelector('#two').onclick = () => {
  //  searchform.classList.remove('activate');
    //searchform1.classList.toggle('opened');      
//}

/*--------- login form swiper and effects -----------*/
const container = document.querySelector(".login-container");
const pwShowHide = document.querySelectorAll(".showHidePw");
const pwFields = document.querySelectorAll(".password");
const signUp = document.querySelector(".signup-link");
const login = document.querySelector(".login-link");
const loginForm = document.querySelector(".login");
const signupForm = document.querySelector(".signup");

    //js code to show/hide password and change icon
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
            }) ;
        });
});
// js code to appear signup and login form
signUp.addEventListener("click", ( )=>{
    signupForm.classList.toggle("active");
    //loginForm.classList.remove("active");

});
login.addEventListener("click", ( )=>{
    loginForm.classList.toggle("active");
    //signupForm.classList.remove("active");
});



