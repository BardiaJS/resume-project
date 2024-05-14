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
  <body style="background-image: url('/images/third-template.png'); color:white; text-align:center; display:block; justify-content:center; align-items:center; background-size:cover; background-repeat:no-repeat">
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
    {{-- personal inforamtion --}}
    <div class="title" style="">
      <h1 style="text-decoration:underline; font-weight:bold">Personal information</h1>
    </div>
    <img src="{{auth()->user()->avatar}}" style="width:200px; height:200px; clip-path:circle(); margin-top:20px; margin-bottom: 20px"/>
    <h4 style="font-weight: bold">Name:</h4>
    <h5 style="color: rgb(78, 77, 77)">{{$personal->name}}</h5>
    <h4 style="font-weight: bold">Family Name:</h4>
    <h5 style="color: rgb(78, 77, 77)">{{$personal->familyName}}</h5>
    <h4 style="font-weight: bold">Age:</h4>
    <h5 style="color: rgb(78, 77, 77)">{{$personal->age}}</h5>
    <h4 style="font-weight: bold">Gender:</h4>
    <h5 style="color: rgb(78, 77, 77)">{{$personal->gender}}</h5>
    <h4 style="font-weight: bold">Military:</h4>
    <h5 style="color: rgb(78, 77, 77)">{{$personal->military}}</h5>
    {{-- graduation infromation --}}
    <div class="title">
      <h1 style="text-decoration:underline; font-weight:bold">Graduation information</h1>
    </div>
    @foreach ($graduations as $graduation)
    <h4 style="font-weight: bold">Graduation Level:</h4>
    <h5 style="color: rgb(78, 77, 77)">{{$graduation->level}}</h5>
    <h4 style="font-weight: bold">major in high school:</h4>
    <h5 style="color: rgb(78, 77, 77)">{{$graduation->high_school_major}}</h5>
    <h4 style="font-weight: bold">major in university:</h4>
    <h5 style="color: rgb(78, 77, 77)">{{$graduation->university_major}}</h5>
    <h4 style="font-weight: bold">university name:</h4>
    <h5 style="color: rgb(78, 77, 77)">{{$graduation->university_name}}</h5>
    @endforeach
  
    
    {{-- skills information --}}
    <div class="title">
      <h1 style="text-decoration:underline; font-weight:bold">Skills</h1>
    </div>

    <ol>
      @foreach ($skills as $skill)
        <li style="color: rgb(78, 77, 77)">{{$skill->title}}: {{$skill->body}}</li><br>
      @endforeach

    </ol> 

       {{-- skills information --}}
       <div class="title">
        <h1 style="text-decoration:underline; font-weight:bold">Work Experience</h1>
      </div>
        
        @foreach ($experiences as $experience)
        <h5 style="color: rgb(78, 77, 77)"> {{$experience->body}}</h5>

        @endforeach

      @if ($graduationData == false && $skillData == false)
      <h2 style="font-weight: bold; color:red">You should complete these information for better resume:</h2>
      <a href="/create-cv-form/{{auth()->user()->id}}/skills">Skill</a>
      <br>  
      <a href="/create-cv-form/{{auth()->user()->id}}/graduation">Graduation</a>
      @elseif ($graduationData == false)
      <h2>You should complete these information for better resume:</h2><a href="/create-cv-form/{{auth()->user()->id}}/graduation" >Graduation</a>
      @elseif ($skillData == false)
      <h2>You should complete these information for better resume:</h2><a href="/create-cv-form/{{auth()->user()->id}}/skills">Skill</a>
      @endif
      
  
       <form action="/" method="GET" class="d-inline">
        <div class="col-md-auto" style="margin-top: 30px; margin-bottom:20px">
          <button class="btn btn-primary btn-sm">Confirm</button>
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
      
      