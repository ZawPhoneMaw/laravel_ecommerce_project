<x-app-layout>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	 <link rel="stylesheet"
              href=
"https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
              integrity=
"sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
              crossorigin="anonymous" />
        <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js">
      </script>
        <script src=
"https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js">
      </script>
 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style type="text/css">
.paddinglabel
{
	align: center;
}
th,td {
	padding: 15px;
	align: center;
	align-items: center;
}
.nav-link
{
	color: grey;
}
.navbar-nav > .active > a {
            
	color: black;
}
</style>
</head>
<body>
	@if(session()->has('message'))
	<div class="alert alert-secondary">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		{{session()->get('message')}}
	</div>
	@endif
<div class="container"> 
<div class="row"> 
	<div class="col-sm-2" style="margin-top: 70px">

      <ul class="navbar-nav flex-column">
            <li class="nav-item active">
            	 <a class="nav-link" href="{{url('/redirect')}}">
                   <h5>Product Details</h5>
                </a>
                    
    
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{url('/cartdetails')}}">
                    Add To Cart
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/userorders')}}">
                   Orders
                </a>
            </li>
            
        </ul>

	</div>
	<div class="col-sm-10">
		<h1 align="center" style="margin-top: 40px;">Product Details</h1>
		<div align="center" style="margin-top: 40px;"> 

					
					<table>
						<tr class="paddinglabel">
							<th>Image</th>
							<th>Product Name</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Total price</th>
							<th>Remove</th>
							
						</tr>

							<?php 
									$totalprice=0;
									$totalquantity=0;
							 ?>
			
					@foreach($cart as $cart)
											<form method="POST" action="{{url('/orderconfirm')}}" enctype="multipart/form-data">
							@csrf
						<tr class="paddinglabel">
							<td><img src="/product/{{$cart->image}}" width="300px" height="300px"></td>
							<input type="text" name="image" value="{{$cart->image}}" hidden>
							<input type="text" name="product_id" value="{{$cart->product_id}}" hidden>
							<td><input type="text" name="product_name" value="{{$cart->product_name}}" hidden>{{$cart->product_name}}</td>
							<td><input type="text" name="price" value="{{$cart->price}}" hidden>{{$cart->price}}</td>
							<td><input type="text" name="quantity" value="{{$cart->quantity}}" hidden>{{$cart->quantity}}</td>
							<td><input type="text" name="quantity_price" value="{{$cart->quantity_price}}" hidden>{{$cart->quantity_price}}</td>

							<td><a href="{{url('/cart_delete',$cart->id)}}" onclick="return confirm('Are You sure to delete?')" class="btn btn-danger">Delete</a></td>
						</tr>
						<?php 
							$totalprice = $totalprice + $cart->quantity_price;
							$totalquantity = $totalquantity + $cart->quantity;
				
							 ?>
							@endforeach
					<tr>
						<td colspan="2" style="text-align: center; background: grey; color: white; font-size: 19px;">Total Price :<input type="text" name="totalprice" value="{{$totalprice}}" hidden> {{$totalprice}}</td>
						<input type="text" name="totalquantity" value="{{$totalquantity}}" hidden>
						<td colspan="3" style="text-align: center;"><input type="submit" value="Order Confirm" class="btn btn-primary"></td>
					</tr>
					</form>
					</table>
					{{$totalquantity}}
					<form method="POST" action="{{url('/userinfoupdate')}}">
					@csrf 
					<table>
						<tr class="paddinglabel">
					
							<th>User Name</th>
							<th>Email</th>
							<th>Adress</th>
							<th>Phone</th>
							<th>Update</th>
						</tr>
						<tr class="paddinglabel">
							<td>{{$user->name}}</td>
							<td>{{$user->email}}</td>
							<td><input type="text" name="address" value="{{$user->address}}"></td>
							<td><input type="text" name="phone" value="{{$user->phone}}"></td>
							<td><input type="submit" value="Update" class="btn btn-primary"></td>
						</tr>
					</table>

				</form>


		</div>
	</div>
</div>
</div>
</body>
<script>
          $(document).ready(function () {
              $("ul.navbar-nav > li").click(function (e) {
               $("ul.navbar-nav > li").removeClass("active");
               $(this).addClass("active");
                });
            });
        </script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>

</x-app-layout>