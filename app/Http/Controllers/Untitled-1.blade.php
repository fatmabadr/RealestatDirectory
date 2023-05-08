
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<h3 class="box-title">Add new unit</h3>



<form action="{{route('unit.save')}}" method="POST" enctype="multipart/form-data">
    @csrf



                 <input type="hidden" name="user_id" value="">
  unit name      <input type="text" name="name" > <br>
  unit area      <input type="text" name="area" > <br>
  noofbedrooms     <input type="number" name="noofbedrooms" > <br>
  noofbathrooms      <input type="number" name="noofbathrooms" > <br>
  unit price      <input type="text" name="price" > <br>
  unit googleMapsLocation_url      <input type="text" name="googleMapsLocation_url" > <br>
  unit type      <input type="text" name="type" > <br>
  building_date <input type="date" name="building_date" ><br>
  delevery_date <input type="date" name="delevery_date" ><br>
  {{-- start of unit location --}}




   <h3>unit area</h3><br>
   <h3>Governorate</h3>
       <select name="governorate_id" id="select" required class="form-control">
           <option value="">Select Governorate</option>
           @foreach ($governorates as $Governorate)
           <option value="{{$Governorate->id}}">{{$Governorate->name}}</option>
           @endforeach
       </select>


       <select name="city_id" id="select" required class="form-control">
           <option value="">Select City</option>
       </select>

       <select class="form-control "  name="district_id" id="select">
           <option value="">--Select District--</option>
       </select>






  {{-- end of unit location --}}

  <br>
  <select name="payment_type" >
   <option value="">Select payment_type</option>
   <option value="visa">visa</option>
   <option value="cash">cash</option>
  </select><br>


  <h1>choose  aminities</h1>
   @foreach ($aminities as $aminity )
   <input type="checkbox"  name="aminity[]" value="{{$aminity->id}}">
   <label  name="aminity[]" > {{$aminity->name}}</label><br>
   @endforeach

<br>


<div class="form-group">
   <h5>Main Photo <span class="text-danger">*</span></h5>
   <div class="controls">
<input type="file" name="unit_main_photo" id="image">
     </div> </div>
<img id ="showImage"src="" alt="avatar-5" width="30" height="30" >




<div class="form-group">
   <h5>Multiple Image <span class="text-danger">*</span></h5>
   <div class="controls">
<input type="file" name="multi_img[]" multiple="" id="multiImg" class="form-control" >
<div class="row" id="preview_img"></div>
    </div>
</div>

   <br>
   unit details <br> <textarea  name="details" rows="10" cols="15"> </textarea><br>
<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Save unit">

</form>




<script type="text/javascript">

$(document).ready(function(){

$('#image').change(function(e){
var reader = new FileReader();
reader.onload = function(e){
   $('#showImage').attr('src',e.target.result);
}
reader.readAsDataURL(e.target.files['0']);
});

});


   </script>

<script>

$(document).ready(function(){
$('#multiImg').on('change', function(){ //on file input change
if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
{
var data = $(this)[0].files; //this file data

$.each(data, function(index, file){ //loop though each file
if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
var fRead = new FileReader(); //new filereader
fRead.onload = (function(file){ //trigger function on successful read
return function(e) {
var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
.height(80); //create image element
$('#preview_img').append(img); //append image to output element
};
})(file);
fRead.readAsDataURL(file); //URL representing the file's data.
}
});

}else{
alert("Your browser doesn't support File API!"); //if File API is absent
}
});
});

</script>



<script>
//seclect city deprnds on governorate select
$(document).ready(function(){
$('select[name="governorate_id"]').on('change',function(){
var governorate_id =$(this).val();
if(governorate_id){
$.ajax({
url:"/getAllCities/Governorate/"+governorate_id,
type:'get',
dataType:"json",
success:function(data){
var d=$('select[name="city_id"]').empty();
$.each(data,function(key,value){
$('select[name="city_id"]').append('<option value="'+value.id+'">'+value.name+'</option>"')

});

}
});
}

});
});
</script>

<script type="text/javascript">
$(document).ready(function(){
$('select[name="city_id"] ').on('change',function(){
var city_id =$(this).val();
if(city_id){
$.ajax({
url:"/getAlldistrict/district/"+city_id,
type:'get',
dataType:"json",
success:function(data){
  var d=$('select[name="district_id"]').empty();
  $.each(data,function(key,value){
      $('select[name="district_id"]').append('<option  value="'+value.id+'">'+value.name+'</option>"')
  });

}
});
}

});
});
</script>
