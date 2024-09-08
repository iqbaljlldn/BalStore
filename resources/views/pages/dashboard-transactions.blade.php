@extends('layouts.dashboard')
@section('title')
    Store Dashboard Transactions
@endsection

@section('content')
    <!-- Section Content -->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Transactions</h2>
                <p class="dashboard-subtitle">Big result start from the small one</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12 mt-2">
                        <h5 class="mb-3">Recent Transactions</h5>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">Sell Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                    aria-controls="profile" aria-selected="false">Buy Products</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                @foreach ($sellTransactions as $transaction)
                                    <a href="{{ route('dashboard-transactions-details', $transaction->id) }}"
                                        class="card card-list d-block">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <img src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                                                        alt="" class="w-50">
                                                </div>
                                                <div class="col-md-4">{{ $transaction->product->name }}</div>
                                                <div class="col-md-3">{{ $transaction->product->user->store_name }}</div>
                                                <div class="col-md-3">{{ $transaction->created_at->format('d F Y') }}
                                                </div>
                                                <div class="col-md-1 d-none d-md-block">
                                                    <img src="/images/dashboard-arrow-right.svg" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="tab-panel fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                @foreach ($buyTransactions as $transaction)
                                    <a href="{{ route('dashboard-transactions-details', $transaction->id) }}"
                                        class="card card-list d-block">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <img src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                                                        alt="" class="w-50">
                                                </div>
                                                <div class="col-md-4">{{ $transaction->product->name }}</div>
                                                <div class="col-md-3">{{ $transaction->product->user->store_name }}</div>
                                                <div class="col-md-3">{{ $transaction->created_at->format('d F Y') }}
                                                </div>
                                                <div class="col-md-1 d-none d-md-block">
                                                    <img src="/images/dashboard-arrow-right.svg" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
