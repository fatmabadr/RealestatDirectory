<!DOCTYPE html>
<html>
<style>
table, th, td {
  border:1px solid black;
}
</style>
<body>

<h2>units table</h2>

<table style="width:100%">
  <tr>
    <th>Nmae</th>
    <th>Area</th>
    <th>Price</th>
    <th>Image</th>
    <th>Action</th>
  </tr>
  @foreach($units as $unit)
  <tr>
    <td>{{$unit->name}}</td>
    <td>{{$unit->area}}</td>
    <td>{{$unit->price}} </td>
    <td><img width="30" height="30" src="/unitImages/{{$unit->mainimage}}" > </td>
    <td> <a  href="{{route('unit.delete',$unit->id)}}">delete</a> <a  href="{{route('unit.edite',$unit->id)}}">edite </a></td>

</tr>
 @endforeach
</table>
<a href="{{route('add.new.unit')}}">add new unit</a>

</body>
</html>


