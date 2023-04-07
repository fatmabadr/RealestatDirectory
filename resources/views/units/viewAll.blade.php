
<!DOCTYPE html>
<html>
<style>
table, th, td {
  border:1px solid black;
}
</style>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>
<body>

<h2>units table</h2>
<div class="row">
    <div class = "col-md-6">
<h3>search </h3><br>
 area
<form action="{{route('units.search')}}" method="POST"  >
    @csrf
     min      <input type="number" name="minArea" id="minArea" min="{{$minArea}}" value="{{$minArea}}"> <br>
     max      <input type="number" name="maxArea"  value="{{$maxArea}}" > <br>
<br><br>


 price
<br>
     min      <input type="number" name="minPrice" id="minPrice" min="0" value="{{$minprice}}"> <br>
     max      <input type="number" name="maxPrice"value="{{$maxprice}}" > <br>
<br><br>

<h1>search  type</h1>
@foreach ($types as $type )
<input type="checkbox"  name="type[]" value={{$type->type}}>
<label  name="type[]" > {{$type->type}}</label><br>
@endforeach


     <input type="submit" class="btn btn-rounded btn-primary mb-5" value="search">

</form>
</div>


<div class = "col-md-6">

sort By :
<form action="{{route('units.Sort')}}" method="POST"  >
@csrf
<div class="form-check">
    <input class="form-check-input" type="radio" name="Sort" id="Sort" value="pricelow" checked >
    <label class="form-check-label" for="Sort">
        price from low to high
    </label><br>

    <input class="form-check-input" type="radio" name="Sort" id="Sort" value="priceHigh" >
    <label class="form-check-label" for="Sort">
        price from high to low
    </label><br>

    <input class="form-check-input" type="radio" name="Sort" id="Sort" value="areaLarge" >
    <label class="form-check-label" for="Sort">
        area from large to small
    </label><br>
    <input class="form-check-input" type="radio" name="Sort" id="Sort" value="areaSmall" >
    <label class="form-check-label" for="Sort">
        area from small to large
    </label>

  </div>
  <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Sort">




</div>
</div>





<table style="width:100%">
  <tr>
    <th>Nmae</th>
    <th>Area</th>
    <th>Price</th>
    <th>Main Image</th>
    <th>Action</th>
    <th>views</th>
  </tr>
  @foreach($units as $unit)
  <tr>
    <td><a  href="{{route('Unit.view',$unit->id)}}"> {{$unit->name}}</a></td>
    <td>{{$unit->area}}</td>
    <td>{{$unit->price}} </td>
    <td><img width="30" height="30" src="/unitImages/{{$unit->mainimage}}" > </td>
    <td> @if(Auth::user())<a  href="{{route('unit.delete',$unit->id)}}">delete</a> <a  href="{{route('unit.edite',$unit->id)}}">edite </a>@endif    </td>

        <td>  {{Illuminate\Support\Facades\Redis::get('unit'.$unit->id)}}     </td>



</tr>
 @endforeach
</table>
<a href="{{route('create.new.unit')}}">add new unit</a>




</body>
</html>
