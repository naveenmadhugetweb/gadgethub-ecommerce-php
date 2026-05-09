document.addEventListener("DOMContentLoaded", function () {

    const authform = document.getElementById("loginForm");

    if(authform){
        authform.addEventListener("submit", function(e){

            let email = document.querySelector("input[type='email']").value;
            if(email == "")
            {
                e.preventDefault();
                alert("Email is required");
            }
        });
    }


});
