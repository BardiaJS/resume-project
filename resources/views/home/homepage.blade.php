
<x-layout>
    <div class="container py-md-5">
      <div class="row align-items-center">
        <div class="col-lg-7 py-3 py-md-5">
          <h1 class="display-3">Haven't you make your CV yet??</h1>
          <p class="lead text-muted">You can make your CV here &ldquo;shared&rdquo; posts that are reminiscent of the late 90&rsquo;s You can do it here!</p>
        </div>
        <div class="col-lg-5 pl-lg-5 pb-3 py-lg-5">
          <form action="/register-user" method="POST" id="registration-form">
            @csrf
            <div class="form-group">
              <label for="username-register" class="text-muted mb-1"><small>Username</small></label>
              <input name="username" id="username-register" class="form-control" type="text" placeholder="Pick a username" autocomplete="off" />
              @error('username')
                <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
              @enderror
            </div>

            <div class="form-group">
              <label for="email-register" class="text-muted mb-1"><small>Email</small></label>
              <input name="email" id="email-register" class="form-control" type="text" placeholder="you@example.com" autocomplete="off" />
              @error('email')
              <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
            @enderror
            </div>

            <div class="form-group">
              <label for="password-register" class="text-muted mb-1"><small>Password</small></label>
              <input name="password" id="password-register" class="form-control" type="password" placeholder="Create a password" />
              @error('password')
              <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
            @enderror
            </div>

            <div class="form-group">
              <label for="password-register-confirm" class="text-muted mb-1"><small>Confirm Password</small></label>
              <input name="password_confirmation" id="password-register-confirm" class="form-control" type="password" placeholder="Confirm password" />
              @error('password_confirmation')
              <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
            @enderror
            </div>

            <div class="form-group">
              <label for="username-register" class="text-muted mb-1"><small>Security Question(Remember for password if you forget it)</small></label>
              <input name="first_high_school_name" id="username-register" class="form-control" type="text" placeholder="What is your first high school name?" autocomplete="off" />
              @error('first_high_school_name')
              <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
              @enderror
            </div>


            <button type="submit" class="py-3 mt-4 btn btn-lg btn-success btn-block">Sign up for OurApp</button>
          </form>
        </div>
      </div>
    </div>
</x-layout>


    