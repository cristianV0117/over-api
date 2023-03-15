<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <center><h1 id="users" >USUARIOS</h1></center>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>user name</th>
                    <th>first name</th>
                    <th>second name</th>
                    <th>first last name</th>
                    <th>second last name</th>
                    <th>email</th>
                    <th>cellphone</th>
                    <th>state id</th>
                    <th>created at</th>
                    <th>updated at</th>
                </tr>
            </thead>
            <tbody>
            @for ($i = 0; $i < count($users); $i++)
                <tr>
                    <td>{{$users[$i]["id"]}}</td>
                    <td>{{$users[$i]["user_name"]}}</td>
                    <td>{{$users[$i]["first_name"]}}</td>
                    <td>{{$users[$i]["second_name"]}}</td>
                    <td>{{$users[$i]["first_last_name"]}}</td>
                    <td>{{$users[$i]["second_last_name"]}}</td>
                    <td>{{$users[$i]["email"]}}</td>
                    <td>{{$users[$i]["cellphone"]}}</td>
                    <td>{{$users[$i]["state_id"]}}</td>
                    <td>{{$users[$i]["updated_at"]}}</td>
                </tr>
            @endfor
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
