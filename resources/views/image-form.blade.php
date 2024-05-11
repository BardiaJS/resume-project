

    <!-- Container (Contact Section) -->
    <div id="contact" class="container">
        <h1 class="text-center" style="margin-top: 100px">Image Upload</h1>

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{$message}}</strong>
            </div>

           
        @endif

        <form method="POST" action="/upload-image/{{auth()->user()->id}}" enctype="multipart/form-data">
            @csrf
            <input type="file" class="form-control" name="avatar" />

            <button type="submit" class="btn btn-sm">Upload</button>
        </form>

    </div>
