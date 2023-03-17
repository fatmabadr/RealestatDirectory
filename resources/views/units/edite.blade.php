

                         <h3 class="box-title">Edite unit</h3>



                         <form action="{{route('unit.update')}}" method="POST" >
                             @csrf


                                          <input type="hidden" name="id" value="{{$unit->id}}">
                                          <input type="hidden" name="user_id" value="">
                           unit name      <input type="text" name="name" value="{{$unit->name}}" > <br>
                           unit area      <input type="text" name="area" value="{{$unit->area}}"> <br>
                           unit price      <input type="text" name="price" value="{{$unit->price}}"> <br>
                           unit googleMapsLocation_url      <input type="text" name="googleMapsLocation_url" value="{{$unit->googleMapsLocation_url}}"> <br>
                           unit type      <input type="text" name="type" value="{{$unit->type}}"> <br>
                           building_date <input type="date" name="building_date"value="{{$unit->building_date}}" ><br>
                           delevery_date <input type="date" name="delevery_date"value="{{$unit->delevery_date}}" ><br>
                           <select name="payment_type" >
                            <option value="">Select payment_type</option>
                            <option value="visa">visa</option>
                            <option value="cash">cash</option>
                           </select><br>
                           unit details <br> <textarea  name="details" rows="10" cols="15" value="">{{$unit->details}} </textarea>






                            <br>
                         <input type="submit" class="btn btn-rounded btn-primary mb-5" value="update">

                     </form>
