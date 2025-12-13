<x-layout bodyClass="login-page">


    <div class="d-flex justify-content-center">
        <div class="card card-light p-4 mt-5" style="width: 450px;">

            <h4 class="text-center mb-4 fw-bold">Login</h4>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- email --}}
                <label class="mb-1">Email</label>
                <input type="email" name="email" 
                       class="form-control mb-3" 
                       value="{{ old('email') }}" required autofocus>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                {{-- password --}}
                <label class="mb-1">Password</label>
                <input type="password" name="password" 
                       class="form-control mb-3" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                {{-- remember me --}}
                <div class="form-check mb-3">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label for="remember" class="form-check-label">Remember me</label>
                </div>

            

                <button class="btn btn-blue w-100 mt-3">Log in</button>

                <div class="text-center mt-3">
                    @if (Route::has('register'))
                        <a class="small text-decoration-none" href="{{ route('register') }}">
                            Register
                        </a>
                    @endif
                </div>

            </form>

        </div>
    </div>

</x-layout>
