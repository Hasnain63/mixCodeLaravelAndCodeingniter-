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

    <table>
        <tr>
            <td>
                <!-- <p>Hi,<b> {{ $data['name'] }}</b></p><br>
                <p>Your proposal was accepted by Supervisor successfully</p> -->
                Hi <b> {{ $data['name'] }}</b> ,<br>
                <br>i hope you are doing well. I have gone through your project
                <b> {{ $data['title'] }}</b> . i am glad to tell you that your project proposal is accepted . We will
                together make
                sure its execution and will implement it somewhere Live.
                <br> <br>
                Regards : <br>
                Supervisor
            </td>
        </tr>
    </table>
</body>

</html>
<!-- end document-->