<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>


    <div class="container m-5 p-5">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Admin Dashboard</h1>
        <a href="{{route('product.create.page')}}" class="btn btn-success">Submit New Product</a>    
    </div>
    <form action="{{route('logout')}}" method="POST">
      @csrf
      <button type="submit" class="btn btn-danger" >Logout</button>
    </form>
    @if(session('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif

    <br>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Stock</th>
            <th scope="col">Category</th>
            <th scope="col">Actions</th>
            <th scope="col">Photo</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($products as $p)
          <tr>
            <th scope="row">{{$p->name}}</th>
            <td>{{$p->price}}</td>
            <td>{{$p->stock}}</td>
            <td>{{$p->category->name}}</td>
            <td class="d-flex justify-content-start align-items-center gap-2">
                <a href="{{route('product.update.page', $p->id)}}" class="btn btn-warning">Edit</a>
                <form action="{{route('product.delete', $p->id)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
           <td><img src="{{asset( '/storage/product_images/'.$p->photo)}}" alt="" class="card-img-top" style="max-width: 50%"></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>