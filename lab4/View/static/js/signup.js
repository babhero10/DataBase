const form = document.getElementById('login-form');

form.addEventListener("submit", e => {
   
    e.preventDefault();

    const name = document.getElementsByName("name")[0];
    const email = document.getElementsByName("email")[0];
    const password = document.getElementsByName("password")[0];
    const rePassword = document.getElementsByName("rePassword")[0];

    const nameFeedback = document.getElementById("name-feedback");
    const emailFeedback = document.getElementById("email-feedback");
    const passwordFeedback = document.getElementById("password-feedback");
    const rePasswordFeedback = document.getElementById("rePassword-feedback");

    if (!name || !email || !password || !rePassword)
    {
      Swal.fire({
        title: 'Error!',
        text: 'You have to refresh the page!',
        icon: 'error',
        confirmButtonText: 'Understand!'
      })
    }

    const validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    const nameValue = name.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    const rePasswordValue = rePassword.value.trim();
    let validCheck = true;
    
    if (nameValue == "") {
      nameFeedback.style.display = "block";
      nameFeedback.innerHTML = "Name is required!";
      name.classList.remove("valid");
      name.classList.add("invalid");
      validCheck = false;
    }
    else
    {
      nameFeedback.style.display = "none";
      name.classList.add("valid");
      name.classList.remove("invalid");
    }
    
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
      let text = passwordValue;
      let n = text.search(/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/);
 
      if (n == -1) {
        passwordFeedback.style.display = "block";
        passwordFeedback.innerHTML = "Password should has minimum 8 characters in length, at least one Digit, one Lower letter and one Upper letter";
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

    }
    
    if (rePasswordValue == "") {
      rePasswordFeedback.style.display = "block";
      rePasswordFeedback.innerHTML = "Password is required!";
      rePassword.classList.remove("valid");
      rePassword.classList.add("invalid");
      validCheck = false;
    }
    else
    {
      if (passwordValue != rePasswordValue)
      {
        rePasswordFeedback.style.display = "block";
        rePasswordFeedback.innerHTML = "Password isn't matching!";
        rePassword.classList.remove("valid");
        rePassword.classList.add("invalid");
        validCheck = false;
      }
      else
      {
        rePasswordFeedback.style.display = "none";
        rePassword.classList.remove("invalid");
        rePassword.classList.add("valid");
      }
    }

    if (!validCheck) {
      Swal.fire({
        title: 'Error!',
        text: 'Some information is invalid!',
        icon: 'error',
        confirmButtonText: 'Understand!'
      })
      return false;
    }

    fetch("../Controller/SignupControl.php", {
      method: 'POST',
      body: JSON.stringify({name: nameValue, email: emailValue, password: passwordValue}),
      headers: {
        "Content-Type": "application/json; charset=UTF-8",
      }
    })
    .then((response) => response.json())
    .then((data) => {
      if (data.name != null) {
        localStorage.setItem("name", data.name);
        Swal.fire(
          'Good Job!',
          'You have created new account!',
          'success'
        ).then(() => {
          window.location.href = "http://localhost/collage/lab4/View/index.html";
        })
      } else {
        Swal.fire({
          title: 'Error!',
          text: data.error,
          icon: 'error',
          confirmButtonText: 'Okay!',
          footer: '<p class="form-text text-muted align-center">Already have an account? <a href="login.html">Log in</a></p>'
        })
        .then(() => {
          if (data.error == "This email already exist") {
            emailFeedback.style.display = "block";
            emailFeedback.innerHTML = "Email already exist!";
            email.classList.remove("valid");
            email.classList.add("invalid");
          }
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