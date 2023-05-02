<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@extends('frontend.index')


@section('content')





<div
class="hero page-inner overlay"



style="background-image: url('/unitImages/{{$unit->mainimage}}')"
>

<div class="container">
  <div class="row justify-content-center align-items-center">
    <div class="col-lg-9 text-center mt-5">


      <h1 class="heading" data-aos="fade-up">
        {{$unit->name}}
      </h1>

      <nav
        aria-label="breadcrumb"
        data-aos="fade-up"
        data-aos-delay="200"
      >
        <ol class="breadcrumb text-center justify-content-center">
          <li class="breadcrumb-item"><a href="{{route('unit.home.page')}}">Home</a></li>
          <li class="breadcrumb-item">
            <a href="{{route('Units.view.all')}}">Properties</a>
          </li>
          <li
            class="breadcrumb-item active text-white-50"
            aria-current="page"
          >
          {{$unit->name}}
          </li>
        </ol>
        @if(Session::has('succ'))
<div class="alert alert-success" role="alert"  timer= "5000">
    {{Session::get('succ')}}

</div>
       @endif
      </nav>
    </div>
  </div>
</div>
</div>

<div class="section">
<div class="container">
  <div class="row justify-content-between">
    <div class="col-lg-7">
      <div class="img-property-slide-wrap">
        <div class="img-property-slide">
          <img src="/unitImages/{{$unit->mainimage}}" alt="Image" class="img-fluid" />

          @foreach ($multiImages as $multiImage )

          <img src="/unitImages/{{$multiImage->image_name}}" alt="Image" class="img-fluid" />
        @endforeach

        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <h2 class="heading text-primary">  {{$unit->name}}</h2>
      <p class="meta">California, United States </p>
      <p class="text-black-50">

        {{$unit->details}}
       </p>

      <div class="d-block agent-box p-5">
        <div class="img mb-4">
          <img
            src="images/person_2-min.jpg"
            alt="Image"
            class="img-fluid"
          />
        </div>
        <div class="text">
          <h3 class="mb-0">Alicia Huston</h3>
          <div class="meta mb-3">Real Estate</div>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Ratione laborum quo quos omnis sed magnam id ducimus saepe
          </p>
          <ul class="list-unstyled social dark-hover d-flex">
            <li class="me-1">
              <a href="#"><span class="icon-instagram"></span></a>
            </li>
            <li class="me-1">
              <a href="#"><span class="icon-twitter"></span></a>
            </li>
            <li class="me-1">
              <a href="#"><span class="icon-facebook"></span></a>
            </li>
            <li class="me-1">
              <a href="#"><span class="icon-linkedin"></span></a>
            </li>
          </ul>
        </div>
      </div>


      {{-- //send a message --}}
      <div class="d-block agent-box p-5">

        <div class="text">
          <h3 class="mb-0">Send Message To the owner</h3>

          <p>

            <form action="{{route('massege.save')}}" method="POST">
                @csrf


                             <input type="hidden" name="user_id" value="{{$unit->user_id}}">
                             <input type="hidden" name="unit_id" value="{{$unit->id}}">
            <h3> name      <input type="text" name="name" > </h3><br>
            <h3>  phone      <input type="text" name="phone" > </h3><br>
              message <br> <textarea  name="messageDetails" rows="10" cols="35"> </textarea><br>



               <input type="submit" class="btn btn-rounded btn-primary mb-5"   value="send message">

            </form>
          </p>

        </div>
      </div>
    </div>
  </div>
</div>
</div>




@endsection
