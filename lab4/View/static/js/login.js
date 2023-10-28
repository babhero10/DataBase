const form = document.getElementById('login-form');

form.addEventListener("submit", e => {
   
    e.preventDefault();

    const email = document.getElementsByName("email")[0];
    const password = document.getElementsByName("password")[0];
    const emailFeedback = document.getElementById("email-feedback");
    const passwordFeedback = document.getElementById("password-feedback");

    if (!email || !password)
    {
      Swal.fire({
        title: 'Error!',
        text: 'You have to refresh the page!',
        icon: 'error',
        confirmButtonText: 'Understand!'
      }).then((e) => {
        return false;
      });
    }

    const validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();

    let validCheck = true;

    if (emailValue == "") {
      emailFeedback.style.display = "block";
      emailFeedback.innerHTML = "Email is required!";
      email.classList.remove("valid");
      email.classList.add("invalid");
      validCheck = false;
    }
    else
    {
      emailFeedback.style.display = "none";
      email.classList.add("valid");
      email.classList.remove("invalid");
    }

    if (!emailValue.match(validRegex)) {
      emailFeedback.style.display = "block";
      emailFeedback.innerHTML = "Invalid email address!";
      email.classList.remove("valid");
      email.classList.add("invalid");
      validCheck = false;
    }
    else
    {
      emailFeedback.style.display = "none";
      email.classList.add("valid");
      email.classList.remove("invalid");
    }

    if (passwordValue == "") {
      passwordFeedback.style.display = "block";
      passwordFeedback.innerHTML = "Password is required!";
      password.classList.remove("valid");
      password.classList.add("invalid");
      validCheck = false;
    }
    else
    {
      passwordFeedback.style.display = "none";
      password.classList.remove("invalid");
      password.classList.add("valid");
    }

    if (!validCheck) {
      Swal.fire({
        title: 'Error!',
        text: 'Some information is invalid!',
        icon: 'error',
        confirmButtonText: 'Understand!'
      })
      .then(() => {
        return false;
      });
    }

    fetch("../Controller/LoginControl.php", {
      method: 'POST',
      body: JSON.stringify({email: emailValue, password: passwordValue}),
      headers: {
        "Content-Type": "application/json; charset=UTF-8",
      }
    })
    .then((response) => response.json())
    .then((data) => {
      if (data.name != null) {
        localStorage.setItem("name", data.name);
        window.location.href = "http://localhost/collage/lab4/View/index.html";
      }
      else
      {
        Swal.fire({
          title: 'Error!',
          text: data.error,
          icon: 'error',
          confirmButtonText: 'Okay!'
        })
        .then(() => {
          return false;
        });
      }
    })
    .catch(() => {
      Swal.fire({
        title: 'Error!',
        text: 'Some went wrong!',
        icon: 'error',
        confirmButtonText: 'Okay!'
      })
      .then(() => {
        return false;
      });
    });
});