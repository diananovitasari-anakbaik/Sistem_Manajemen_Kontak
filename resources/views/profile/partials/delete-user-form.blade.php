<section class="card shadow-lg border-0 mx-auto mt-4 mb-5" style="max-width: 600px;">
    <section class="card shadow-lg border-0 mx-auto mt-4 mb-5" style="max-width: 600px;">
    <div class="card-body">
        <h4 class="card-title mb-3 text-danger">Delete Account</h4>

        <p class="text-muted mb-3">
            After deleting your account, all of its data will be permanently removed.
        </p>

        <button class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#confirmDelete">
            Delete Account
        </button>
    </div>
</section>

<!-- Modal Konfirmasi Delete -->
<div class="modal fade" id="confirmDelete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-danger">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('profile.destroy') }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <p>Enter your password to confirm account deletion:</p>

                    <input type="password" name="password" class="form-control" placeholder="Password" required>

                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </div>
            </form>

        </div>
    </div>
</div>


</section>
