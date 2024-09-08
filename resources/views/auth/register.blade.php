@extends('layouts.auth')

@section('content')
    <div class="page-content page-auth" id="register">
        <div class="section-store-auth" data-aos="fade-up">
            <div class="container">
                <div class="row justify-content-center row-login mt">
                    <div class="col-lg-4">
                        <h2>Belanja kebutuhan utama, <br> menjadi lebih mudah</h2>
                        <form action="{{ route('register') }}" method="POST" class="mt-3">
                            @csrf
                            <div class="form-group">
                                <label>{{ __('Full Name') }}</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus v-model="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('Email Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" v-model="email"
                                    @change="checkForEmailAvailability()" :class="{ 'is-invalid': this.email_unavailable }">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password-confirmation">{{ __('Confirm Password') }}</label>
                                <input id="password-confirmation" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <div class="form-group">
                                <label>{{ __('Store') }}</label>
                                <p class="text-muted">Apakah anda juga ingin membuka toko?</p>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="is_store_open"
                                        id="openStoreTrue" v-model="is_store_open" :value="true">
                                    <label for="openStoreTrue" class="custom-control-label">Iya, boleh</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="is_store_open"
                                        id="openStoreFalse" v-model="is_store_open" :value="false">
                                    <label for="openStoreFalse" class="custom-control-label">Enggak Makasih</label>
                                </div>
                            </div>
                            <div class="form-group" v-if="is_store_open">
                                <label>Nama Toko</label>
                                <input type="text" name="store_name" required
                                    class="form-control @error('store_name') is-invalid @enderror" autocomplete autofocus
                                    id="store_name" v-model="store_name">
                                @error('store_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group" v-if="is_store_open">
                                <label>Kategori</label>
                                <select name="categories_id" id="category" class="form-control">
                                    <option value="" disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" :disabled="this.email_unavailable">
                                {{ __('Register') }}
                            </button>
                            <a href="{{ route('login') }}" class="btn btn-signup btn-block mt-2">Already have an account?
                                Back to Sign In</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="/vendor/vue/vue.js"></script>
    <script>
        Vue.use(Toasted);

        var register = new Vue({
            el: '#register',
            mounted() {
                AOS.init();
            },
            methods: {
                checkForEmailAvailability: function() {
                    let self = this
                    axios.get('{{ route('api-register-check') }}', {
                            params: {
                                email: this.email,
                            }
                        })
                        .then(function(response) {
                            if (response.data == 'Available') {
                                self.$toasted.show(
                                    "Email tersedia", {
                                        position: "top-center",
                                        className: "rounded",
                                        duration: 1000,
                                    }
                                );
                                self.email_unavailable = false;
                            } else {
                                self.$toasted.error(
                                    "Maaf, tampaknya email sudah terdaftar pada sistem kami.", {
                                        position: "top-center",
                                        className: "rounded",
                                        duration: 1000,
                                    }
                                );
                                self.email_unavailable = true;
                            }
                        })
                        .catch(function (error) {
                            console.log(error.toJSON());
                        })
                }
            },
            data() {
                return {
                    name: "",
                    email: "",
                    password: "",
                    is_store_open: false,
                    store_name: "",
                    email_unavailable: false,
                }
            }
        })
    </script>
@endpush
