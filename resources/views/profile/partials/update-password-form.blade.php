<section class="card shadow-lg border-0 mx-auto mt-4" style="max-width: 600px;">
    <div class="card-body">
        <h4 class="card-title mb-3">Update Password</h4>
        <p class="text-muted mb-4">Ensure your account uses a secure password.</p>

        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="mb-3">
                <label class="form-label fw-semibold">Current Password</label>
                <input type="password" name="current_password" class="form-control">
                <x-input-error :messages="$errors->get('current_password')" class="text-danger" />
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">New Password</label>
                <input type="password" name="password" class="form-control">
                <x-input-error :messages="$errors->get('password')" class="text-danger" />
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control">
                <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger" />
            </div>

            <button class="btn btn-primary w-100">Save</button>
        </form>
    </div>
</section>
