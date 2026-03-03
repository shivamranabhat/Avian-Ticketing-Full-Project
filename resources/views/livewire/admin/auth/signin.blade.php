<div class="main-signup-header">
    <h3>Welcome back!</h3>
    @error('auth')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <h6 class="fw-medium mb-4 fs-17">Please sign in to continue.</h6>
    <form wire:submit='login'>
        <div class="form-group mb-3"> <label class="form-label">Email</label>
            <input class="form-control" wire:model='email' placeholder="Enter your email" type="text">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-3"> <label class="form-label">Password</label>
            <input class="form-control" wire:model='password' placeholder="Enter your password" type="password">
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div> <button type='submit' class="btn btn-primary btn-block w-100">Sign In <x-spinner /></button>
       
    </form>
    <div class="main-signin-footer mt-5">
        <p class="mb-1"><a href="#">Forgot password?</a></p>
    </div>
</div>