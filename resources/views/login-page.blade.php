<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
<body>'
        
        <div class="container d-flex flex-column flex-md-row align-items-center p-3">
          <h4 class="my-0 mr-md-auto font-weight-normal"><a href="/" class="text-white">OurApp</a></h4>
          <h4 class="my-0 mr-md-auto font-weight-normal"><a href="/" class="text-white">back</a></h4>
            <div class="container">
              <div class="wrapper">
                <div class="title"><span>Login Form</span></div>
                  <form action="/login-user" method="POST">
                    @csrf
                    <div class="row">
                      <i class="fas fa-user"></i>
                      <input type="text" placeholder="Email" name="email">
                    </div>
                    <div class="row">
                      <i class="fas fa-lock"></i>
                      <input type="password" placeholder="Password"  name="password">
                    </div>
                    <div class="pass"><a href="#">Forgot password?</a></div>
                    <div class="row button">
                      <input type="submit" value="Login">
                    </div>
                    <div class="signup-link">Not a member? <a href="/">Signup now</a></div>
                  </form>
                </div>
              </div>
        </div>

</body>
</html>
    