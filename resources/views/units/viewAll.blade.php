@extends('frontend.index')
@section('content')



<div
class="hero page-inner overlay"
style="background-image: url('/frontend/assets/images/hero_bg_1.jpg')"
>
<div class="container">
  <div class="row justify-content-center align-items-center">
    <div class="col-lg-9 text-center mt-5">
      <h1 class="heading" data-aos="fade-up">Properties</h1>

      <nav
        aria-label="breadcrumb"
        data-aos="fade-up"
        data-aos-delay="200"
      >
        <ol class="breadcrumb text-center justify-content-center">
          <li class="breadcrumb-item"><a href="{{route('unit.home.page')}}">Home</a></li>
          <li
            class="breadcrumb-item active text-white-50"
            aria-current="page"
          >
            Properties
          </li>
        </ol>
      </nav>
    </div>
  </div>
</div>
</div>




<div class="section section-properties">
    <div class="container">
      <div class="row">


@foreach($units as $unit)
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
          <div class="property-item mb-30">
            <a href="{{route('Unit.view',$unit->id)}}" class="img">
              <img src="/unitImages/{{$unit->mainimage}}"  alt="Image" class="img-fluid" width="300" height="300" >
            </a>

            <div class="property-content">
              <div class="price mb-2"><span>${{$unit->price}}</span></div>
              <div>
                <span class="d-block mb-2 text-black-50"
                  >{{$unit->name}}</span
                >
                <span class="city d-block mb-3">{{$unit->district->name}}, {{$unit->district->Governorate->name}}</span>

                <div class="specs d-flex mb-4">
                  <span class="d-block d-flex align-items-center me-3">
                    <span class="icon-bed me-2"></span>
                    <span class="caption">{{$unit->noofbedrooms}} beds</span>
                  </span>
                  <span class="d-block d-flex align-items-center">
                    <span class="icon-bath me-2"></span>
                    <span class="caption">{{$unit->noofbathrooms}} baths</span>
                  </span>
                </div>

                <a

                  href="{{route('Unit.view',$unit->id)}}"
                  class="btn btn-primary py-2 px-3"
                  >See details</a
                >
              </div>
            </div>
          </div>
          <!-- .item -->
        </div>

@endforeach







            {{$units->links("pagination::bootstrap-4")}}




    </div>
  </div>





@endsection
