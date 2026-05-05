
document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    // alert('hi', urlParams);
    // console.log("hellow", urlParams);

    if (urlParams.get('logout') === 'success') {
        // console.log("modal");

        var myModal = new bootstrap.Modal(document.getElementById('cartModalCenter'));
        myModal.show();
    }
});
