@extends('frontend.index')
@section('content')






    <div class="hero">
      <div class="hero-slide">
        <div
          class="img overlay"
          style="background-image: url('/frontend/assets/images/hero_bg_3.jpg')"
        ></div>
        <div
          class="img overlay"
          style="background-image: url('/frontend/assets/images/hero_bg_2.jpg')"
        ></div>
        <div
          class="img overlay"
          style="background-image: url('/frontend/assets/images/hero_bg_1.jpg')"
        ></div>
      </div>

      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center">
            <h1 class="heading" data-aos="fade-up">
                <br><br>
              Easiest way to find your dream home
            </h1>


<form  method="POST"  action="{{route('units.search')}}">
    @csrf
            <div

            class="narrow-w form-search d-flex align-items-stretch mb-3"
            data-aos="fade-up"
            data-aos-delay="200"
          >
          <h1 class="heading" data-aos="fade-up">
            Price:from
          </h1>
            <input
              type="number"
              name="minimumPrice"
              class="form-control px-4"
              min="{{$minimumPrice}}" value="{{$minimumPrice}}"
              placeholder="minimumPrice "
            />
            <h1 class="heading" data-aos="fade-up">
               to
              </h1>
            <input
            type="number"
            max="{{$maximumPrice}}" value="{{$maximumPrice}}"
            name="maximumPrice"
            class="form-control px-4"
            placeholder="maximumPrice "
          />

        </div>


        <div

        class="narrow-w form-search d-flex align-items-stretch mb-3"
        data-aos="fade-up"
        data-aos-delay="200"
      ><h1 class="heading" data-aos="fade-up">
            Area:from
          </h1>

        <input
          type="number"
          name="minimumArea"
          min="{{$minimumArea}}" value="{{$minimumArea}}"
          class="form-control px-4"
          placeholder="minArea "
        />
        <h1 class="heading" data-aos="fade-up">
         to
          </h1>
        <input
        type="number"
        max="{{$maximumArea}}" value="{{$maximumArea}}"
        name="maximumArea"
        class="form-control px-4"
        placeholder="maxArea "
      />

    </div>

{{-- search by type --}}
    <div

    class="narrow-w form-search d-flex align-items-stretch mb-3"
    data-aos="fade-up"
    data-aos-delay="200"
  >
  <h1 class="heading" data-aos="fade-up">
    &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; &ensp;&ensp; search  type
     </h1>

    </div>


    <div

    class="narrow-w form-search d-flex align-items-stretch mb-3"

    data-aos-delay="200"
  >

  @foreach ($types as $type )

  <input type="checkbox" color= "white" name="type[]" value={{$type->type}}>
  <h5 style="color:white;" name="type[]" color= "white" font-size="20px">
   {{$type->type}} </h5>
   &ensp;&ensp;&ensp;
  @endforeach
  <input type="checkbox" color= "white"  value=all>
  <h5 style="color:white;"  color= "white" font-size="20px">
  all </h5>
  </div>



    <button type="submit" class="btn btn-primary">Search</button>

</form>






          </div>
        </div>
      </div>
    </div>
<br><br><br><br>










@endsection
