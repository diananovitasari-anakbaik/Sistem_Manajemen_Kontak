<section class="card shadow-lg border-0 mx-auto mt-4" style="max-width: 600px;">
    <div class="card-body">
        <h4 class="card-title mb-3">Profile Information</h4>
        <p class="text-muted mb-4">Update your account's profile information and email address.</p>

        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Name</label>
                <input id="name" name="name" type="text" class="form-control"
                    value="{{ old('name', auth()->user()->name) }}" required autofocus>
                <x-input-error :messages="$errors->get('name')" class="text-danger" />
            </div>

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input id="email" name="email" type="email" class="form-control"
                    value="{{ old('email', auth()->user()->email) }}" required>
                <x-input-error :messages="$errors->get('email')" class="text-danger" />
            </div>

           

            <button class="btn btn-primary w-100">Save</button>
        </form>
    </div>
</section>
