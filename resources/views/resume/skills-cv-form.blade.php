
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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

    @if (session()->has('message'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="container container-narrow">
      <div class="alert text-center" style="background-color: #16a085">
        {{session('message')}}
      </div>
    </div>
  @endif

  @if (session()->has('failure'))
  <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="container container-narrow">
    <div class="alert text-center" style="background-color: #fd0a0a">
      {{session('failure')}}
    </div>
  </div>
@endif
<div class="row">
  <div class="col-3" style="text-align: center"></div>
    <div class="col-6" style="text-align: center">
        <form action="/create-cv-form/{{$user->id}}/skills/information" method="POST" id="registration-form">
          @csrf
          <div class="form-group" style="text-align: center">
            Enter your skills
          </div>

          <div class="form-group">
            <label for="username-register" class="text-muted mb-1">Title</label>
            <input name="title" id="username-register" style="font-size: 13px" class="form-control" type="text" placeholder="Name" autocomplete="off" />
            @error('title')
            <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
            @enderror
          </div>

          <div class="form-group">
            <label for="email-register" class="text-muted mb-1">Body</label>
            <input name="body" style="font-size: 13px" id="email-register" class="form-control" type="text" placeholder="Description" autocomplete="off" />
            @error('body')
            <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
            @enderror
          </div>



          <button type="submit" class="py-3 mt-4 btn btn-lg btn-success btn-block">Confirm</button>

          
        </form>

        <form action="/create-cv-form/{{$user->id}}/work-experience" method="GET" id="registration-form">
          @csrf
          <button type="submit" class="py-3 mt-4 btn btn-lg btn-success btn-block">Next</button>
        </form>
    </div>
    <div class="col-3"></div>   
</div>
    
      @foreach ($skills as $skill)
      

        <div>
            
         
          <div class="" style="border: 1px solid black; text-align:center; margin-top:30px">
          <p>{{$skill->title}}</p>
          <p style="color: green">{{$skill->body}}</p>
          @can('update' , $skill)
          <form action="/delete-skill/{{$skill->id}}/{{$user->id}}" method="POST" id="registration-form">
            @csrf
            @method('DELETE')
            <button type="submit"  style="width:100px; height:30px; text-align:center; background-color:#e4bdbd">delete</button>
          </form>

          @endcan

          @can('update' , $skill)
          <form action="/edit-skill/{{$skill->id}}/{{$user->id}}" method="GET" id="registration-form">
            <button type="submit" style="width:100px; height:30px; text-align:center; margin-top:10px; background-color:#e4bdbd">edit</button>
          </form>
          
          @endcan
          </div>
        </div>
      @endforeach
   
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



  