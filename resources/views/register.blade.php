<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body >
    <div class="container position-absolute top-50 start-50 translate-middle shadow-sm p-3 mb-5 bg-body-tertiary rounded">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Register</h1>
            <a href="{{route('login')}}" class="btn btn-primary">Login</a>
        </div>
        @if(session('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
        <br>
        <form action="{{route('register.post')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name_input" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name_input" name="name" placeholder="John Doe...">
            </div>

            @error('name')
            <p style="color: red">{{$message}}</p>
            @enderror

            <div class="mb-3">
                <label for="email_input" class="form-label">Email</label>
                <input type="text" class="form-control" id="email_input" name="email" placeholder="name@example.com">
            </div>
            
            @error('email')
            <p style="color: red">{{$message}}</p>
            @enderror

            <div class="mb-3">
                <label for="phone_input" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone_input" name="phone_number" placeholder="08....">
            </div>

            @error('phone_number')
            <p style="color: red">{{$message}}</p>
            @enderror

            <div class="mb-3">
                <label for="pass_input" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass_input" name="password" placeholder="6 -12 digits">
            </div>

            @error('password')
            <p style="color: red">{{$message}}</p>
            @enderror
    
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>