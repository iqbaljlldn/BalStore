@extends('layouts.app')
@section('title')
    Store Homepage
@endsection

@section('content')
    <!-- Page Contents -->
    <div class="page-content page-details">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Product Details
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-gallery mb-3" id="gallery">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8" data-aos="zoom-in">
                        <transition name="slide-fade" mode="out-in">
                            <img :src="photos[activePhoto].url" :key="photos[activePhoto].id" class="w-100 main-image"
                                alt="">
                        </transition>
                    </div>
                    <div class="col-lg-2">
                        <div class="row">
                            <div class="col-3 col-lg-12 mt-lg-8" v-for="(photo, index) in photos" :key="photo.id"
                                data-aos="zoom-in" data-aos-delay="100">
                                <a href="#" @click="changeActive(index)">
                                    <img :src="photo.url" class="w-100 thumbnail-image"
                                        :class="{ active: index == activePhoto }" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="store-details-container" data-aos="fade-up">
            <section class="store-heading">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <h1>{{ $product->name }}</h1>
                            <div class="owner">By {{ $product->user->store_name }}</div>
                            <div class="price">${{ number_format($product->price) }}</div>
                        </div>
                        <div class="col-lg-2" data-aos="zoom-in">
                            @auth
                                <form action="{{ route('detail-add', $product->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <button type="submit" class="btn btn-success px-4 text-white btn-block mb-3">
                                        Add to Cart
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-success px-4 text-white btn-block mb-3">Log In</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </section>

            <section class="store-description">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            {!! $product->description !!}
                        </div>
                    </div>
                </div>
            </section>

            <section class="store-review">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-8 mt-3 mb-3">
                            <h5>Customer Review (3)</h5>
                            <div class="col-12 col-lg-8">
                                <ul class="list-unstyled">
                                    <li class="media">
                                        <img src="/images/icons-testimonial-1.png" alt=""
                                            class="mr-3 rounded-circle">
                                        <div class="media-body">
                                            <h5 class="mt-2 mb-1">Susan Doe</h5>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, incidunt harum
                                            deleniti expedita sequi architecto.
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img src="/images/icons-testimonial-2.png" alt=""
                                            class="mr-3 rounded-circle">
                                        <div class="media-body">
                                            <h5 class="mt-2 mb-1">Jane Doe</h5>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, incidunt harum
                                            deleniti expedita sequi architecto.
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img src="/images/icons-testimonial-3.png" alt=""
                                            class="mr-3 rounded-circle">
                                        <div class="media-body">
                                            <h5 class="mt-2 mb-1">Ahmad Kasim</h5>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, incidunt harum
                                            deleniti expedita sequi architecto.
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
        var gallery = new Vue({
            el: "#gallery",
            mounted() {
                AOS.init();
            },

            data: {
                activePhoto: 0,
                photos: [
                    @foreach ($product->galleries as $gallery)
                        {
                            id: {{ $gallery->id }},
                            url: "{{ Storage::url($gallery->photos) }}"
                        },
                    @endforeach
                ],
            },
            methods: {
                changeActive(id) {
                    this.activePhoto = id;
                },
            }
        })
    </script>
@endpush
