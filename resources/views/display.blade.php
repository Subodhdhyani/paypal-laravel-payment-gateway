<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Paypal Payment Display</title>
    <style>
      body{
        background-color:aliceblue;
      }
    </style>
</head>
<body>
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
 <h1 class="text-center mt-2 mb-2 text-success">All Paypal Payment</h1>

    
   <div class="container">
<div class="mt-2 mb-2" style="text-align: right;">
 <a href="{{route('welcome')}}" class="btn btn-info">Go TO Payment Page</a>
</div>

   <table class="table  table-striped table-bordered">
             <thead>
                 <tr>
                   <th scope="col">Id</th>
                   <th scope="col" class="d-none d-sm-table-cell">Booking Id</th>
                   <th scope="col">Product Name</th>
                   <th scope="col">Quantity</th>
                   <th scope="col">Total Amount</th>
                   <th scope="col">User Name</th>
                
                   <th scope="col">Operation</th>
                </tr>
             </thead> <tbody>
             @foreach($data as $record)
             
                 <tr>
                   <td>{{$record->id}}</td>
                   <td class="d-none d-sm-table-cell">{{$record->booking_id}}</td>
                   <td>{{$record->product_name}}</td>
                   <td>{{$record->quantity}}</td>
                   <td>{{$record->amount}}</td>
                   <td>{{$record->payer_name}}</td>
                   
                   <td>
                  
                    <a href="{{route('refund',$record->id)}}" class="btn btn-success">Refund</a>
                   </td>
                  
                </tr>
   
              @endforeach
             </tbody>
         </table>
   </div> 
</body>
</html>