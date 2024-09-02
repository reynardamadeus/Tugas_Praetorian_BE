<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Product Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container position-absolute top-50 start-50 translate-middle shadow-sm p-3 mb-5 bg-body-tertiary rounded">
        <h1>Create Product</h1>
        <br>
        <form action="{{route('product.create')}}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="name_input" class="form-label">Name</label>
                <input type="text" class="form-control" id="name_input" name="name" placeholder="name.." value="{{old('name')}}">
            </div>

            @error('name')
            <div style="alert alert-danger">{{$message}}</div>
            @enderror

            <div class="mb-3">
                <label for="price_input" class="form-label">Price</label>
                <input type="integer" class="form-control" id="price_input" name="price" placeholder="e.x: 10,20" value="{{old('price')}}">
            </div>

            @error('price')
            <div style="alert alert-danger">{{$message}}</div>
            @enderror

            <div class="mb-3">
                <label for="stock_input" class="form-label">Stock</label>
                <input type="integer" class="form-control" id="stock_input" name="stock" placeholder="e.x: 10,20" value="{{old('stock')}}">
            </div>

            @error('stock')
            <div style="alert alert-danger">{{$message}}</div>
            @enderror

            <div class="mb-3">
                <label for="photo_input" class="form-label">Image</label>
                <input type="file" class="form-control" id="photo_input" name="photo" placeholder="e.x: 10,20" value="{{old('photo')}}">
            </div>

            @error('photo')
            <div style="alert alert-danger">{{$message}}</div>
            @enderror

            <div class="mb-3">
                <label for="category_input" class="form-label">Category</label>
                <select class="form-select" name="category_id" id="category_input" aria-label="Default select example">
                    <option selected>Select category</option>
                    @forelse ($categories as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
                    @empty
                    @endforelse
                </select>
            </div>

            @error('category_id')
            <div style="alert alert-danger">{{$message}}</div>
            @enderror

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>