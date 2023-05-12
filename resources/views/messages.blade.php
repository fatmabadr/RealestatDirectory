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

    <td>
        <a href="{{route('Unit.view',$message->unit_id)}}"
        class="btn btn-primary py-2 px-3"
        >  {{$message->unit_id}}</a>
    </td>
    <td>{{$message->name}} </td>
    <td>{{$message->phone}}</td>
    <td>{{$message->messageDetails}}</td>

</tr>
 @endforeach
</table>


</body>
</html>


