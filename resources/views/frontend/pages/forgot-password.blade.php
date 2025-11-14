@include('frontend.layouts.header')

<section class="reset-wrapper">
    <h1 class="reset-title">Reset Password</h1>
    <div class="reset-panel">
        <form method="POST" action="{{ url('/reset-password') }}">
            @csrf
            <div class="reset-instructions">
                Please enter your email address. We will send you a message with further instructions.
            </div>
            <div class="form-group">
                <label for="reset-email">Email</label>
                <input 
                    type="email" 
                    id="reset-email" 
                    name="email" 
                    required 
                    autocomplete="email">
            </div>
            <button type="submit" class="reset-btn">Reset Password</button>
        </form>
    </div>
</section><br>

@include('frontend.layouts.footer')
