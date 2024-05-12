

    <!-- Container (Contact Section) -->
    <div id="contact" class="container">
        <h1 class="text-center" style="margin-top: 100px">Image Upload</h1>

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{$message}}</strong>
            </div>

           
        @endif

        @if (auth()->user()->avatar)
        <img data-toggle="tooltip" data-placement="bottom" style="width:200px; height: 200px; border-radius: 16px" src="{{ asset(auth()->user()->avatar) }}" />
        @endif
        <form method="POST" action="/upload-image/{{auth()->user()->id}}" enctype="multipart/form-data">
            @csrf
            <input type="file" class="form-control" name="avatar" />

            <button type="submit" class="btn btn-sm">Upload</button>
        </form>
        <form method="GET" action="/change-profile/{{auth()->user()->id}}" enctype="multipart/form-data">
            <button type="submit" class="btn btn-sm">Next</button>
        </form>
    </div>
