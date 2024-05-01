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
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet"/>
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
            <a class="btn btn-sm btn-success mr-2" href="/show-resume/{{auth()->user()->id}}">See your cv</a>
            <a href="/change-profile/{{auth()->user()->id}}"><button class="btn btn-primary btn-sm">change profile</button>
            </a>
            @else
            <a class="btn btn-sm btn-success mr-2" href="/create-cv-form/{{auth()->user()->id}}/personal">Create CV</a>
            @endif
            <form action="/signout-user" method="POST" class="d-inline">
              @csrf
              <button class="btn btn-sm btn-secondary">Sign Out</button>
            </form>
          </div>
          @else
            <div class="row align-items-center">
              <a href="/" style="text-decoration:none; color:black; margin-left:0%;"><img width="24" height="24" src="https://img.icons8.com/material-rounded/24/back--v1.png"/>Back</a>


              <form action="/forget-password" method="GET" class="d-inline">
                @csrf
                <div class="col-md-auto">
                  <button class="btn btn-primary btn-sm">Forget the password?</button>
                </div>
              </form>
                             
            </div>
          @endauth
         
        
      </div>
    </header>
    <!-- header ends here -->
    @if (session()->has('message'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="container container-narrow">
      <div class="alert text-center" style="background-color: #16a085">
        {{session('message')}}
      </div>
    </div>
  @endif

  @if (session()->has('failure'))
  <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="container container-narrow">
    <div class="alert text-center" style="background-color: #e60000">
      {{session('failure')}}
    </div>
  </div>
@endif

    <div class="container d-flex flex-column flex-md-row align-items-center p-3" style="justify-content: center; align-items:center; align-items:center">
    <h4 class="my-0 mr-md-auto font-weight-normal"><a href="/" class="text-white">OurApp</a></h4>
    <div class="col-2"></div>
    <div class="col-8">
      <form action="/login-user" method="POST" class="mb-0 pt-2 pt-md-0">
        @csrf
        <div class="row align-items-center">
          <div class="col-md mr-0 pr-md-0 mb-3 mb-md-0">
            <input name="email" class="form-control form-control-sm input-dark" type="text" placeholder="Email" autocomplete="off" />
            @error('email')
            <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
            @enderror
          </div>
          <div class="col-md mr-0 pr-md-0 mb-3 mb-md-0">
            <input name="password" class="form-control form-control-sm input-dark" type="password" placeholder="Password" />
            @error('password')
            <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
            @enderror
          </div>
          <div class="col-md-auto">
            <button class="btn btn-primary btn-sm">Sign In</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-2"></div>
    
  </div>
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