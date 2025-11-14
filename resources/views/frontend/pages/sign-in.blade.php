{{-- resources/views/auth/signin.blade.php --}}

@include('frontend.layouts.header')

<section class="auth-container">
    <h1 class="auth-title">Sign In or Create Account</h1>
    <div class="auth-panel">
        <!-- Returning Customers -->
        <div class="auth-box">
            <div class="auth-box-header">Returning Customers</div>
            <div class="auth-box-body">
                <div class="auth-desc">
                    I already have an account with BBTS.<br>
                    <span class="required-note">*</span> indicates a required field.
                </div>
                <form action="{{ route('sign-in.submit') }}" method="POST">
                    @csrf

                    {{-- Show sign-in Error --}}
                    @if ($errors->has('sign-in_error'))
                        <div class="alert alert-danger">
                            {{ $errors->first('sign-in_error') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="signin-email">Email<span class="required-note">*</span></label>
                        <input id="signin-email" name="email" type="email" value="{{ old('email') }}" required />
                    </div>

                    <div class="form-group">
                        <label for="signin-password">Password<span class="required-note">*</span></label>
                        <input id="signin-password" name="password" type="password" required />
                    </div>

                    <button type="submit" class="sign-in-btn">Sign In</button>
                </form>
                <a href="{{ route('password.request') }}" class="forgot-link">I forgot my password</a>
            </div>
        </div>

        <!-- New Customers -->
        <div class="auth-box">
            <div class="auth-box-header">New Customers</div>
            <div class="auth-box-body">
                <div class="auth-desc">
                    I am a new customer and want to create an account.
                </div>
                <a href="{{ url('/register') }}" class="create-account-btn">Create Account</a>
            </div>
        </div>
    </div>
</section>

@include('frontend.layouts.footer')
