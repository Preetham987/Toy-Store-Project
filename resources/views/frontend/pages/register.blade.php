@include('frontend.layouts.header')

<section class="create-account-section">
    <h2 class="account-title">Create a New Account</h2>
    <form class="create-account-form" method="POST" action="{{ route('register.submit') }}">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @csrf
        <div class="required-note">* Indicates a required field.</div>

        <div class="form-group">
            <label for="name">Full Name*</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required />
            @error('name') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email*</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required />
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password*</label>
            <input type="password" id="password" name="password" required />
            @error('password') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password*</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required />
        </div>

        <div class="form-actions">
            <button type="submit" class="register-btn">Register</button>
            <button type="button" class="cancel-btn" onclick="window.location.href='{{ url('/') }}'">Cancel</button>
        </div>
    </form>
</section>

@include('frontend.layouts.footer')
