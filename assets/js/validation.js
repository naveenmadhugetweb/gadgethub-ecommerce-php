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


    // console.log("validation.jsfile");
    // document.addEventListener("click", function() {
    //     e.preventDefault();
    // });

/*  // Try to foffcanvas dismiss bug pending
    adminProfile = document.getElementById('adminprofile');
    // Profile toggle
    adminProfile.addEventListener('click', (e) => {
        e.preventDefault();                             // stop the default behaviour of CartIcon element like href="#" to custom js (model showing like below)
        new bootstrap.Offcanvas(document.getElementById('offcanvasRight')).show();   // which opens the sidebar
    });
*/

});
