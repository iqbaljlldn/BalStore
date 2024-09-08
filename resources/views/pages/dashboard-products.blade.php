@extends('layouts.dashboard')
@section('title')
    Store Dashboard Products
@endsection

@section('content')
    <!-- Section Content -->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">My Products</h2>
                <p class="dashboard-subtitle">Manage it well and get money</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('dashboard-products-create') }}" class="btn btn-success">Add New Product</a>
                    </div>
                </div>
                <div class="row mt-4">
                    @if ($products)
                        @foreach ($products as $product)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <a href="{{ route('dashboard-products-details', $product->id) }}"
                                    class="card card-dashboard-product d-block">
                                    <div class="card-body">
                                        <img src=" {{ Storage::url($product->galleries->first()->photos ?? '') }} "
                                            alt="" class="w-75 mb-2">
                                        <div class="product-title">{{ $product->name }}</div>
                                        <div class="product-category">{{ $product->category->name }}</div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <p>Tidak ada produk</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
