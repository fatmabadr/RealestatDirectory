

                         <h3 class="box-title">Add new unit</h3>



                         <form action="{{route('unit.save')}}" method="POST" >
                             @csrf



                                          <input type="hidden" name="user_id" value="">
                           unit name      <input type="text" name="name" > <br>
                           unit area      <input type="text" name="area" > <br>
                           unit price      <input type="text" name="price" > <br>
                           unit googleMapsLocation_url      <input type="text" name="googleMapsLocation_url" > <br>
                           unit type      <input type="text" name="type" > <br>
                           building_date <input type="date" name="building_date" ><br>
                           delevery_date <input type="date" name="delevery_date" ><br>
                           <select name="payment_type" >
                            <option value="">Select payment_type</option>
                            <option value="visa">visa</option>
                            <option value="cash">cash</option>
                           </select><br>
                           unit details <br> <textarea  name="details" rows="10" cols="15"> </textarea>






                            <br>
                         <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Save unit">

                     </form>
