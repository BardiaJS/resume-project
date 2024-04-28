<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>You want to change wich part?</p>
    <a href="/create-cv-form/{{$user->id}}/edit/user">User Information</a>
    <a href="/create-cv-form/{{$user->id}}/edit/personal">Personal Information</a>
    <a href="/create-cv-form/{{$user->id}}/edit/skill">Skill Information</a>
    <a href="/create-cv-form/{{$user->id}}/edit/graduation">Graduation Information</a>
    <a href="/create-cv-form/{{$user->id}}/edit/experience">Work Experience</a>
</body>
</html>