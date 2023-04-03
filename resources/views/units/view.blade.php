{{$unit}}
{{$multiImages}}


@if (Auth::user())->id==$unit-.user_id())




number of visitors {{$views}}


@else
Contact us

<form action="{{route('massege.save')}}" method="POST">
    @csrf



                 <input type="hidden" name="user_id" value="">
                 <input type="hidden" name="unit_id" value="{{$unit->id}}">
 name      <input type="text" name="name" > <br>
  phone      <input type="text" name="phone" > <br>
  message <br> <textarea  name="messageDetails" rows="10" cols="15"> </textarea><br>



  <input type="submit" class="btn btn-rounded btn-primary mb-5" value="send message">

</form>
@endif
