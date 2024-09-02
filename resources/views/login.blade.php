
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<body>

    
    <div class="container position-absolute top-50 start-50 translate-middle shadow- p-3 mb-5 bg-body-tertiary rounded">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Login</h1>
            <a href="{{route('register')}}" class="btn btn-primary">Register</a>
        </div>
        @if(session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
        
        <br>
        <form action="{{route('login.post')}}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="email_input" class="form-label">Email</label>
                <input type="text" class="form-control" id="email_input" name="email" placeholder="name@example.com">
            </div>

            @error('email')
            <div style="alert alert-danger">{{$message}}</div>
            @enderror

            <div class="mb-3">
                <label for="pass_input" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass_input" name="password" placeholder="6 -12 digits">
            </div>

            @error('password')
            <div style="alert alert-danger">{{$message}}</div>
            @enderror

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>