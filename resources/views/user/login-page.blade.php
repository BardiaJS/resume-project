<x-layout>
  <div class="container d-flex flex-column flex-md-row align-items-center p-3" style="justify-content: center; align-items:center; align-items:center">
    <h4 class="my-0 mr-md-auto font-weight-normal"><a href="/" class="text-white">OurApp</a></h4>
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
</x-layout>