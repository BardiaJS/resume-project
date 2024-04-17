<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
<body>'
        

          <h4 class="my-0 mr-md-auto font-weight-normal" style="text-align: center"><a href="/" class="text-white">OurApp</a></h4>
          <h4 class="my-0 mr-md-auto font-weight-normal" style="text-align: center"><a href="/" class="text-white">back</a></h4>
            <div class="container">
              <div class="wrapper">
                <div class="title"><span>Personal Data</span></div>
                  <form action="/create-cv-form/{{$user->id}}/skills" method="POST">
                    @csrf
                    <div class="row">
                      <i class="fas fa-user"></i>
                      <input type="text" placeholder="Name" name="name">
                    </div>
                    <div class="row">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Family Name" name="familyName">
                      </div>
                      <div class="row">
                        <i class='fas fa-baby'></i>
                        <input type="number" placeholder="Age" name="age" min="0">
                      </div>
                      
                      <div class="row">
                        <i class='far fa-address-card'></i>
                        <input type="text" placeholder="Military service" name="military">
                      </div>

                    <div class="row">
                        <i class='fas fa-restroom'></i> {{-- male:1 female:0 --}}
                            <div class="row" style="display:inline-block; text-align:center; margin-left:25%" >
                                <input type="radio" id="age1" name="gender" value="Male" style="height:35px; width:35px;">
                                <label for="age1">Male</label>
                            </div>
                            <div class="row" style="display: inline-block">
                                <input type="radio" id="age2" name="gender" value="Female" style="height:35px; width:35px;">
                                <label for="age2">Female</label>
                            </div>
                    </div>
                    

                    <div class="row button">
                      <input type="submit" value="Next">
                    </div>
                    
                  </form>
                </div>
              </div>
        

</body>
</html>