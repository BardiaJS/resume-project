
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
              <a href="/change-profile/{{auth()->user()->id}}" style="text-decoration:none; color:black; margin-left:0%"><img width="24" height="24" src="https://img.icons8.com/material-rounded/24/back--v1.png"/>Back</a>
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
  <div class="container py-md-5">
    <div class="row align-items-center">
      <div class="col-lg-5 pl-lg-5 pb-3 py-lg-5">

        <form action="/create-cv-form/{{$user->id}}/edit/personal/save" method="POST" id="registration-form">
          @csrf
          <div class="form-group">
            <label for="username-register" class="text-muted mb-1">Name</label>
            <input name="name" id="username-register" style="font-size: 13px" class="form-control" type="text" placeholder="Name" autocomplete="off" value="{{$personal->name}}" />
            @error('name')
            <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
            @enderror
          </div>

          <div class="form-group">
            <for="emaillabel-register" class="text-muted mb-1">Family Name</label>
            <input name="familyName" style="font-size: 13px" id="email-register" class="form-control" type="text" placeholder="Family Name" autocomplete="off" value="{{$personal->familyName}}">
            @error('familyName')
            <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
            @enderror
          </div>
          <div class="form-group">
            <label for="password-register" class="text-muted mb-1">Age</label>
            <input name="age" style="font-size: 13px" id="password-register" class="form-control" type="number" placeholder="Age" min="0" value="{{$personal->age}}"/>
            @error('age')
            <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
            @enderror

          <div class="form-group">
            <div>
              <label for="password-register-confirm" class="text-muted mb-1">Gender</label>
            </div>
            @error('gender')
            <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
            @enderror
            <input type="radio" id="age1" name="gender" value="male" value="{{$personal->gender}}">
            <label for="gender" style="font-size: 13px">Male</label><br>
            <input type="radio" id="age2" name="gender" value="female" value="{{$personal->gender}}">
            <label for="gender" style="font-size: 13px">Female</label><br> 
          </div>


          <div class="form-group">
              <label for="password-register-confirm" class="text-muted mb-1">Military</label>
            <input name="military" id="password-register-confirm" class="form-control" type="tex" placeholder="Military" value="{{$personal->military}}" />
            @error('military')
            <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
            @enderror
          </div>

          <button type="submit" class="py-3 mt-4 btn btn-lg btn-success btn-block">change the settings</button>
        </form>
      </div>
    </div>
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



  