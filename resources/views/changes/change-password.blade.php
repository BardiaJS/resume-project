
<x-layout>
  <a href="/change-profile/{{auth()->user()->id}}" style="text-decoration:none; color:black; margin-left:0%"><img width="24" height="24" src="https://img.icons8.com/material-rounded/24/back--v1.png"/>Back</a>
    <div class="container py-md-5">
      <div class="col-3"></div>
        <div class="col-6">
          <form action="/create-cv-form/{{$user->id}}/edit/password/save" method="POST" id="registration-form">
            @csrf
            <div class="form-group">
              <label for="username-register" class="text-muted mb-1"><small>Password</small></label>
              <input name="password" id="username-register" class="form-control" type="password" placeholder="Pick a password" autocomplete="off" />
              @error('password')
              <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
              @enderror
            </div>

            <div class="form-group">
              <label for="email-register" class="text-muted mb-1"><small>Password Confirmation</small></label>
              <input name="password_confirmation" id="email-register" class="form-control" type="password" placeholder="Confirm Password" autocomplete="off" />
              @error('password_confirmation')
              <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
              @enderror
            </div>

            

            <button type="submit" class="py-3 mt-4 btn btn-lg btn-success btn-block">change user settings</button>
          </form>
        </div>
      
    </div>
</x-layout>


    