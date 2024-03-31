<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel - PayPal Integration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
 

<div class="container">
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
{{--Failed Payment--}}
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <h1 class="text-center text-primary mb-4 mt-2">Laravel Paypal Payment Page</h1>
    <a href="{{route('display')}}" class="btn btn-info mt-4 mb-4">Display All Payment</a>
<form action="{{ route('paypal') }}" method="post" autocomplete="off">
{{--We also pass Name,Email etc from here But in here we store name and email in db from the paypal server name email --}}
@csrf
<div class="row mb-4">
  <div class="col">
    <input type="text" class="form-control" placeholder="Product Name" name="product_name" aria-label="product_name" value="{{old('product_name')}}">
  </div>
  <div class="col">
    <input type="number" class="form-control" placeholder="Quantity" name="quantity" aria-label="quantity" value="{{old('quantity')}}">
  </div>
</div>
<div class="row mb-4">
  <div class="col">
    <input type="number" class="form-control" placeholder="Price" name="price" aria-label="price" value="{{old('price')}}">
  </div>
  <div class="col">
    <input type="text" class="form-control" placeholder="Address" name="address" aria-label="address" value="{{old('address')}}">
  </div>
</div>
<div class="row mb-4">
<button type="submit" class="btn btn-primary">Pay with Paypal</button>
</div>
</form>
</div>



</body>
</html>