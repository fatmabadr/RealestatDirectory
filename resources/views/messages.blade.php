<!DOCTYPE html>
<html>
<style>
table, th, td {
  border:1px solid black;
}
</style>
<body>

<h2>message table</h2>

<table style="width:100%">
  <tr>
    <th>unit id</th>
    <th>Nmae</th>
    <th>phone</th>
    <th>message</th>

  </tr>
  @foreach($messages as $message)
  <tr>

    <td>{{$message->unit_id}}</td>
    <td>{{$message->name}} </td>
    <td>{{$message->phone}}</td>
    <td>{{$message->messageDetails}}</td>

</tr>
 @endforeach
</table>


</body>
</html>


