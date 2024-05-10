
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>OurApp</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/main.css" />
    <script src="//unpkg.com/alpinejs" defer></script>
  </head>
  <body>
    <header class="header-bar mb-3">
      <div class="container d-flex flex-column flex-md-row align-items-center p-3">
        <h4 class="my-0 mr-md-auto font-weight-normal"><a href="/" class="text-white">OurApp</a></h4>
        
          @auth
          <div class="flex-row my-3 my-md-0">
            @if (auth()->user()->isCreateCV == 1)
            @endif
            <div>
              <a href="/" style="text-decoration:none; color:black; margin-left:0%"><img width="24" height="24" src="https://img.icons8.com/material-rounded/24/back--v1.png"/>Back</a>
            </div>
            <form action="/signout-user" method="POST" class="d-inline">
              @csrf
              <button class="btn btn-sm btn-secondary">Sign Out</button>
            </form>
          </div>
            @else
            <div class="row align-items-center">
              <form action="/login-form" method="GET" class="d-inline">
                @csrf
                <div class="col-md-auto">
                  <button class="btn btn-primary btn-sm">Already have an account?</button>
                </div>
              </form>
             
            </div>
          @endauth
         
        
      </div>
    </header>
    <!-- header ends here -->


  <h2 style="text-align: center">Wich template you want? choose one</h2>


<div style="display:flex; text-align:center; justify-content:center; align-items:center; margin-top:5%">
  {{-- first template --}}

<button onclick="document.getElementById('image1').style.display='block'" style="width:auto;">Template1</button>

<div id="image1" class="modal">
  
  <form class="modal-content animate" action="/first-template/{{$user->id}}" method="GET">
    <div class="imgcontainer">
      <span onclick="document.getElementById('image1').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="/images/first-template-picture.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">

        
      <button type="submit">I want this template</button>

    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('image1').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

{{-- second template --}}
<button onclick="document.getElementById('image2').style.display='block'" style="width:auto; margin-left:3%">Template2</button>

<div id="image2" class="modal">
  
  <form class="modal-content animate" action="/second-template/{{$user->id}}" method="GET">
    <div class="imgcontainer">
      <span onclick="document.getElementById('image2').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="/images/second-tamplate-picture.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">

        
      <button type="submit">I want this template</button>

    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('image2').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

{{-- third template --}}
<button onclick="document.getElementById('image3').style.display='block'" style="width:auto; margin-left:3%">Template3</button>

<div id="image3" class="modal">
  
  <form class="modal-content animate" action="/third-template/{{$user->id}}" method="GET">
    <div class="imgcontainer">
      <span onclick="document.getElementById('image3').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="/images/third-template.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
 
        
      <button type="submit">I want this template</button>

    </div>
    <script>
      if(event.target == modal1){
        modal.style.display = "non";
      }else if (event.target == modal2) {
        modal.style.display = "none";
      }else if (event.target == modal3) {
        modal.style.display = "none";
      }else (event.target == modal4) {
        modal.style.display = "none";
      }
    </script>
   
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('image3').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>



{{-- fourth template --}}
<button onclick="document.getElementById('image4').style.display='block'" style="width:auto;margin-left:3%">Template4</button>

<div id="image4" class="modal">
  
  <form class="modal-content animate" action="/fourth-template/{{$user->id}}" method="GET">
    <div class="imgcontainer">
      <span onclick="document.getElementById('image4').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="/images/fourth-template.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">

        
      <button type="submit">I want this template</button>

    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('image4').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>
</div>


<script>
// Get the modal
var modal1 = document.getElementById('image1');
var modal2 = document.getElementById('image2');
var modal3 = document.getElementById('image3');
var modal4 = document.getElementById('image4');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    } if (event.target == modal2) {
        modal2.style.display = "none";
    } if (event.target == modal3) {
        modal3.style.display = "none";
    } if (event.target == modal4) {
        modal4.style.display = "none";
    }
}
</script>

    <!-- footer begins -->
    <footer class="border-top text-center small text-muted py-3">
        <p class="m-0">Copyright &copy; {{date('Y')}} <a href="/" class="text-muted">OurApp</a>. All rights reserved.</p>
      </footer>
  
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
      <script>
        $('[data-toggle="tooltip"]').tooltip()
      </script>
    </body>
  </html>