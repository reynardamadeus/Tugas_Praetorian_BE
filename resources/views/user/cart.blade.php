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
    
    <div class="container mx-auto shadow-sm p-3 mb-5 bg-body-tertiary rounded">
        <h1>Cart</h1>
        <p>by: {{Auth::user()->name}}</p>
        
        @if(session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif

        <p class="text-dark fw-bold">Orders: </p>
        <table class="table">
            <thead>
              <tr>
                <th scope="col" class="text-success">ID</th>
                <th scope="col" class="text-success">Name</th>
                <th scope="col" class="text-success">Price</th>
                <th scope="col" class="text-success">Quantity</th>
                <th scope="col" class="text-success">Sub Total</th>
                <th scope="col" class="text-success">Actions</th>
              </tr>
            </thead>
            <tbody>
            @if(session('cart'))
            @foreach (session('cart') as $id => $details)
              <tr>
                <th scope="row" class="text-success">{{$id}}</th>
                <td>{{$details['name']}}</td>
                <td>Rp. {{$details['price']}},00</td>
                <td>{{$details['quantity']}}</td>
                <td>Rp. {{$details['sub_total']}},00</td>
                <td class="d-flex justify-content-start align-items-center gap-2">
                    <form action="{{route('delete.cart.item', $id )}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Remove Item</button>
                    </form>
                    <form action="{{route('edit.cart.item.qty', ['id' => $id, 'PoM' => 1])}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">+</button>
                    </form>
                    <form action="{{route('edit.cart.item.qty', ['id' => $id, 'PoM' => 0])}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning">-</button>
                    </form>
                </td>
                
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>

          <p class="text-dark fw-bold">Total: {{$cart_total}}</p>
          <br>
          <h3>Additional Information</h2>
            <br>
          <form action="{{route('submit.order')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="address_input" class="form-label">Address</label>
                <input type="text" class="form-control" id="address_input" name="address" placeholder="address" >
            </div>

            @error('address')
            <p style="text-danger">{{$message}}</p>
            @enderror

            <div class="mb-3">
                <label for="pos_input" class="form-label">Pos Code</label>
                <input type="text" class="form-control" id="pos_input" name="pos_code" placeholder="123.." >
            </div>

            @error('pos_code')
            <p style="text-danger">{{$message}}</p>
            @enderror

              <input type="text" class="form-control" hidden name="total" value="{{$cart_total}}" placeholder="123.." >
        
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{route('user.dashboard')}}" class="btn btn-primary"> < Back</a>
                <button class="btn btn-success" type="submit">Order Now!</button>
            </div>
            
          </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>