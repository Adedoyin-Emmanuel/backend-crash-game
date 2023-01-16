
$(document).ready(($)=>{

    $.noConflict();

    $signUpForm = document.getElementById("signUpForm");

    $("#signUpForm").on("submit",(e)=>{
        e.preventDefault();

        console.log("form submitted");
    })

})
   


