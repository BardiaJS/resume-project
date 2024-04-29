
<x-layout>
    <div class="container py-md-5">
      <div class="row align-items-center">
        <div class="col-lg-7 py-3 py-md-5">
          
        </div>
        <div class="col-lg-5 pl-lg-5 pb-3 py-lg-5">
          <form action="/create-cv-form/{{$user->id}}/edit/password/save" method="POST" id="registration-form">
            @csrf
            <div class="form-group">
              <label for="username-register" class="text-muted mb-1"><small>Password</small></label>
              <input name="password" id="username-register" class="form-control" type="password" placeholder="Pick a password" autocomplete="off" />
            </div>

            <div class="form-group">
              <label for="email-register" class="text-muted mb-1"><small>Password Confirmation</small></label>
              <input name="password_confirmation" id="email-register" class="form-control" type="password" placeholder="Confirm Password" autocomplete="off" />
            </div>

            

            <button type="submit" class="py-3 mt-4 btn btn-lg btn-success btn-block">change user settings</button>
          </form>
        </div>
      </div>
    </div>
</x-layout>


    