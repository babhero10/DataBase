
if (localStorage.getItem("name") != null) {
    document.getElementById("username").innerText = localStorage.getItem("name");
    document.getElementById("logout-btn").addEventListener("click", (e) => {
        localStorage.removeItem("name");
        window.location.href = "http://localhost/collage/lab4/View/login.html";
    });

} else {
    Swal.fire({
        title: 'Error!',
        text: 'You have to log in first!',
        icon: 'error',
        confirmButtonText: 'Login!'
    })
    .then(() => {
        window.location.href = "http://localhost/collage/lab4/View/login.html";        
    });

}
