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
    @if(session('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif
    
    <div class="container position-absolute top-50 start-50 translate-middle shadow-sm p-3 mb-5 bg-body-tertiary rounded">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Product</h1>
            <div class="-flex justify-content-center align-items-center">
                <a href="{{route('cart')}}" class="btn btn-outline-danger">Cart <span class="badge bg-warning">{{count((array) session('cart'))}}</span></a>
                <a href="{{route('orders.get')}}" class="btn btn-success">Order History</a>
            </div>
            
        </div>
        <br>
        <form action="{{route('logout')}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger" >Logout</button>
        </form>
        <br>
        <form action="{{route('user.dashboard')}}" method="GET">
            <div class="mb-3">
                <select class="form-select" name="filter_id" id="category_input" aria-label=""  onchange="this.form.submit()">
                    <option value="">All</option>
                    @forelse ($categories as $c)
                        <option value="{{$c->id}}" {{ request('filter_id') == $c->id ? 'selected' : '' }} >{{$c->name}}</option>
                    @empty
                    @endforelse
                </select>
            </div>
        </form>
        <br>
        <div class="d-flex flex-row">
            @forelse ($products as $p)
                <div class="card" style="width: 18rem;">
                    <img src="{{asset( '/storage/product_images/'.$p->photo)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$p->name}}</h5>
                        <p class="card-text">{{$p->category->name}}</p>
                        <p class="card-text">Price: Rp {{$p->price}}</p>
                        <p class="card-text">Available: {{$p->stock}}</p>
                        
                        <form action="{{route('add.cart', $p->id )}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <button type="submit"  class="btn btn-outline-primary">Add to Cart</button>
                        </form>
            
                    </div>
                </div>
            
            @empty
                <div class="alert alert-warning">Product is not available</div>
            @endforelse

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>