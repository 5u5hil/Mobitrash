@extends('frontend.layouts.site')
@section('content')

<section id="content" style="margin-bottom: 0px;">
    <div class="secpad" style="background: url('http://mobitrash.in/public/Frontend/images/parallax/home/clouds-background.jpg') no-repeat; background-size: 100% auto;padding-bottom: 237px;padding-top:88px">
        <div class="container clearfix">
            <div class="col_full">

                <h2>Gallery</h2>

                <div class="masonry-thumbs col-5" data-lightbox="gallery">
                    @foreach($images as $image)
                    <a class="gallery-images" href="{{Config('constants.uploadGallery').$image['image']}}" data-lightbox="gallery-item"><img class="image_fade" src="{{Config('constants.uploadGallery').$image['image']}}" alt="Gallery Thumb 1"></a>
                    @endforeach
                </div>
            </div>
        </div>
</section>
@stop
@section("myscripts")
<script>
   
</script>
@stop

<!-- External JavaScripts
============================================= -->


