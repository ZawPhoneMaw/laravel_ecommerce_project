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
			<li class="nav-item ">
                <h5> Order Products Details</h5>                
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{url('/product_add')}}">
                    Product Add
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/user_details')}}">
                    User details
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{url('/product_details')}}">
                    Product Details
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                   href="{{url('/order_details')}}">Orders</a>
            </li>
        </ul>

	</div>
	<div class="col-sm-10">
		<h1 align="center" style="margin-top: 40px;">Orders</h1>

		<div style="align:center;" style="margin-top: 40px;">
					<table>
						<tr class="paddinglabel">
							<th>Image</th>
							<th>Product Name</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Total Price</th>
						</tr>
					@foreach($orderresult as $orderresult)
						<tr class="paddinglabel">
							<td><img src="/product/{{$orderresult->image}}" width="100px" height="100px"></td>
							<td>{{$orderresult->product_name}}</td>
							<td>{{$orderresult->price}}</td>
							<td>{{$orderresult->quantity}}</td>
							<td>{{$orderresult->quantity_price}}</td>

						</tr>
					@endforeach
					</table>
		</div>
		
		<div align="left" style="margin-top: 40px;"> 	
					<table style="padding:5px;">
						<tr class="paddinglabel">
							<td>Order Number Id :</td>
							<td>{{$orderuser->id}}</td>
						</tr>
						<tr>							
							<td>Total Ordered Quantity :</td>
							<td>{{$orderuser->total_quantity}}</td>
						</tr>
						<tr>
							<td>Total Ordered Price :</td>
							<td>${{$orderuser->totall_price}}</td>
						</tr>
						<tr>							
							<td>Delivery Status :</td>
							@if($orderuser->delivery_status=='Confirmed')
								<td style="color:red;">{{$orderuser->delivery_status}}</td>
							@else
								<td>{{$orderuser->delivery_status}}</td>
							@endif
						</tr>
						<tr>
							<td>User Name :</td>
							<td>{{$orderuser->user_name}}</td>
						</tr>
						<tr>
							<td>User Email :</td>
							<td>{{$orderuser->email}}</td>
						</tr>
						<tr>
							<td>User Address :</td>
							<td>{{$orderuser->address}}</td>
						</tr>
						<tr>							
							<td>User Phone Number :</td>
							<td>{{$orderuser->phone}}</td>
						</tr>


					

				</table>

		</div>
		<div align="center">
			@if($orderuser->delivery_status!='Confirmed')
			<a href="{{url('/confirmorderstatus', $orderuser->id)}}" class="btn btn-success">Order Confirm</a>
			@endif
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