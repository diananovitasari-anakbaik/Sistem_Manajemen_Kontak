<x-layout bodyClass="login-page">

    <div class="d-flex justify-content-center">
        <div class="card card-light p-4 mt-5" style="width: 450px;">

            <h4 class="text-center mb-4 fw-bold">Register</h4>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Name --}}
                <label class="mb-1">Name</label>
                <input type="text" name="name"
                       class="form-control mb-3"
                       value="{{ old('name') }}" required autofocus>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                {{-- Email --}}
                <label class="mb-1">Email</label>
                <input type="email" name="email"
                       class="form-control mb-3"
                       value="{{ old('email') }}" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                {{-- Password --}}
                <label class="mb-1">Password</label>
                <input type="password" name="password"
                       class="form-control mb-3" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                {{-- Confirm Password --}}
                <label class="mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation"
                       class="form-control mb-4" required>

                {{-- Login link --}}
                <div class="text-start mb-2">
                    <a class="small text-decoration-none" href="{{ route('login') }}">
                        Already registered?
                    </a>
                </div>

                {{-- Register button --}}
                <button class="btn btn-blue w-100 mt-2">Register</button>

            </form>

        </div>
    </div>

</x-layout>
