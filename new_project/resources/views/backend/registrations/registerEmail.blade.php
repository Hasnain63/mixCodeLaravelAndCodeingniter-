<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Page-->
    <title>Notification Email</title>

    <!-- Fontfaces CSS-->


</head>

<body class="">



    Hi,
    <br> Dear student, i hope you are doing well. Your group was created successfully: your login
    details are given below, <br> <br>


    Group name : &nbsp; &nbsp; {{ $data['name'] }} <br>


    Email : &nbsp; &nbsp; {{ $data['groupEmail']}}<br>

    Password : &nbsp; &nbsp; {{ $data['password']}}<br>
    <br>


    Regards : <br>
    Supervisor

</body>

</html>
<!-- end document-->