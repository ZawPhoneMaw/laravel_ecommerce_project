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
                <a class="nav-link" href="{{url('/product_update')}}">
                    Product Update
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{url('/product_add')}}">
                    Product Add
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/user_details')}}">
                    User Details
                </a>
            </li>

            <li class="nav-item">
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
		<h1 align="center" style="margin-top: 40px;">Add Product</h1>
		<div align="center" style="margin-top: 40px;"> 

				<form method="POST" action="{{url('/update_product',$product->id)}}" enctype="multipart/form-data">
					@csrf
				
					<table>

						<tr class="paddinglabel">
							<td><label for="name" >Product Name</label></td>
							<td><input id="name" type="text" name="name" value="{{$product->name}}"></td>
						</tr>
		
						<tr class="paddinglabel">
							<td><label for="catagory" >Product Catagory</label></td>	
							<td><input id="catagory" type="text" name="catagory" value="{{$product->catagory}}"></td>
						</tr>

						<tr class="paddinglabel">
							<td><label for="price">Product Price</label></td>
							<td><input id="price" type="text" name="price" value="{{$product->price}}"></td>
						</tr>	

						<tr class="paddinglabel">
							<td><label for="description" >Description</label></td>
							<td><textarea name="description" id="description" rows="4"> {{$product->description}}</textarea></td>
						</tr>
						<tr class="paddinglabel">
							<td colspan="2"><img src="/product/{{$product->image}}" width="300px" height="300px"></td>
						</tr>
					
						<tr class="paddinglabel">
							<td><label for="image" > New Image</label></td>
							<td><input id="image" type="file" name="image"></td>
						</tr>
						<tr>
							<td colspan="2" align="center"><input type="submit" class="btn btn-primary" name="Update" value="Update Product"></td>
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