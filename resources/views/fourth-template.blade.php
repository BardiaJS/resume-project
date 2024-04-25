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
  <body style="background-image: url('/images/fox.jpeg'); color:white; text-align:center">
    <header class="header-bar mb-3">
      <div class="container d-flex flex-column flex-md-row align-items-center p-3">
        <h4 class="my-0 mr-md-auto font-weight-normal"><a href="/" class="text-white">OurApp</a></h4>
        
          @auth
          <div class="flex-row my-3 my-md-0">
            @if (auth()->user()->isCreateCV == 1)
              <a href="#" class="mr-2"><img title="My Profile" data-toggle="tooltip" data-placement="bottom" style="width: 32px; height: 32px; border-radius: 16px" src="https://gravatar.com/avatar/f64fc44c03a8a7eb1d52502950879659?s=128" /></a>
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
    {{-- personal inforamtion --}}
    <h1 style="color: rgb(255, 255, 255);">Personal information</h1>
    <h3 style="color: rgb(255, 255, 255);">Name: Jhon</h3>
    <h3 style="color: rgb(255, 255, 255);">Family Name: Doe</h3>
    <h3 style="color: rgb(255, 255, 255);">Age: 34</h3>
    <h4 style="color: rgb(255, 255, 255);">Gender: Male</h4>
    <h4 style="color: rgb(255, 255, 255);">Military: Passed</h4>
    {{-- graduation infromation --}}
    <h1 style="color: rgb(255, 255, 255);">Graduation information</h1>
    <h3 style="color: rgb(255, 255, 255);">Graduation Level: Doctore</h3>
    <h3 style="color: rgb(255, 255, 255);">major in high school: Math</h3>
    <h3 style="color: rgb(255, 255, 255);">major in university: Computer engeneering</h3>
    <h4 style="color: rgb(255, 255, 255);">university name: Tabriz</h4>
    {{-- skills information --}}
    <h1 style="color: rgb(255, 255, 255);">Skills information</h1>
    <h2 style="color: rgb(255, 255, 255);">The skills are</h2>

    <ol style="color: rgb(255, 255, 255);">
        <li>Html</li>
        <li>PHP</li>
        <li>Java script</li>
    </ol> 

       {{-- skills information --}}
       <h1 style="color: rgb(255, 255, 255);">Work Experience information</h1>
       <h2 style="color: rgb(255, 255, 255);">I worked this places:</h2>
   
       <ol style="color: rgb(255, 255, 255);">
           <li>Google</li>
           <li>Apple</li>
           <li>Microsoft</li>
       </ol> 
       <form action="#" method="GET" class="d-inline">
        @csrf
        <div class="col-md-auto">
          <button class="btn btn-primary btn-sm">Make your resume</button>
        </div>
      </form>








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
      
      