

document.getElementById("loginForm").addEventListener("submit", function(e){

    let email =
        document.querySelector("input[type='email']").value;

    if(email == "")
    {
        e.preventDefault();

        alert("Email is required");
    }

});

