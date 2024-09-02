<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    
    <div class="container mx-auto shadow-sm p-3 mb-5 bg-body-tertiary rounded d-flex flex-column">
      <div class="d-flex justify-content-between align-items-center">
        <h1>Orders</h1>
        <a href="{{route('user.dashboard')}}" class="btn btn-primary">Back</a>
    </div>
        <p>by: {{Auth::user()->name}}</p>
        
        @if(session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif

        @forelse ($orders as $o)
          <div class="container p-3 shadow bg-body rounded">
            <h3 class="text-success">Invoice:  {{$o->invoice}}</h2>
            <br>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Category</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Subtotal</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($o->items as $items)
                <tr>
                  <th scope="row" >{{$items['name']}}</th>
                  <td>{{$items['category']}}</td>
                  <td>{{$items['quantity']}}</td>
                  <td>{{$items['sub_total']}}</td>
                </tr>
                  
                @endforeach
                
              </tbody>
            </table>
            <p class="text-success fw-bold">Total: {{$o->total}}</p>
            <p class="text-success">address: {{$o->address}}</p>
            <p class="text-success">pos code: {{$o->pos_code}}</p>
          </div>
        @empty
          <div class="alert alert-warning">Create your first order now!</div>
        @endforelse

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>