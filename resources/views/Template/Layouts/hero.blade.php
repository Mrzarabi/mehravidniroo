<!--*********************************************************************************************************-->
<!--************ HERO ***************************************************************************************-->
<!--*********************************************************************************************************-->
<div id="ts-hero" class="ts-animate-hero-items">
    <!--HERO CONTENT ****************************************************************************************-->
    <div class="container position-relative h-100 ts-align__vertical">
        <div class="row w-100">
            <div class="col-md-12">
                <!--SOCIAL ICONS-->
                {{-- <figure class="ts-social-icons mb-4">
                    <a href="#" class="mr-3">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="mr-3">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="mr-3">
                        <i class="fab fa-pinterest"></i>
                    </a>
                    <a href="#" class="mr-3">
                        <i class="fab fa-slack"></i>
                    </a>
                    <a href="#" class="mr-3">
                        <i class="fab fa-instagram"></i>
                    </a>
                </figure> --}}

                <!--TITLE -->
                {{-- <h1 class="text-right" >مهراوید نیرو</h1>
                <h1 class="ts-bubble-border ">
                    <span class="ts-title-rotate">
                        @foreach ($banners as $banner)
                            <span> {{$banner->title}} </span>
                        @endforeach
                    </span>
                </h1> --}}

            </div>
            <!--end col-md-8-->
        </div>
        <!--end row-->
        <a href="#my-services" class="ts-btn-effect position-absolute ts-bottom__0 ts-left__0 ts-scroll ml-3 mb-3">
            <span class="ts-visible ts-circle__sm rounded-0 ts-bg-primary">
                <i class="fa fa-arrow-down text-white"></i>
            </span>
            <span class="ts-hidden ts-circle__sm rounded-0">
                <i class="fa fa-arrow-down text-white"></i>
            </span>
        </a>

    </div>
    <!--end container-->
    <!--END HERO CONTENT ************************************************************************************-->

    <!--HERO BACKGROUND *************************************************************************************-->
    <div class="ts-background owl-carousel" data-owl-dots="1" data-owl-loop="1" data-animate="ts-fadeInUp" >
        @foreach ($banners as $banner)
            <div class="ts-background-image" data-bg-image="{{ $banner->image }}"></div>
        @endforeach 
    </div>
    <!--END HERO BACKGROUND *********************************************************************************-->

</div>
<!--end #hero-->
