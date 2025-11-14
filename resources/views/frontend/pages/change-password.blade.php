{{-- resources/views/account-change-password.blade.php --}}

@include('frontend.layouts.header')

<section class="account-change-pw-wrapper">
    
    @include('frontend.layouts.sidebar-2')

    <div class="account-change-pw-panel">
        <h1 class="main-title">Change Password</h1>
        <form class="change-pw-form" method="POST" action="{{ url('account/change-password') }}">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @csrf
            <div class="form-group">
                <label for="current-password">Current password</label>
                <input type="password" id="current-password" name="current_password" autocomplete="current-password" required>
            </div>
            <div class="form-group">
                <label for="new-password">New password</label>
                <input type="password" id="new-password" name="new_password" autocomplete="new-password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm new password</label>
                <input type="password" id="confirm-password" name="new_password_confirmation" autocomplete="new-password" required>
            </div>
            <button class="change-pw-btn" type="submit">Change Password</button>
        </form>
    </div>
</section>

@include('frontend.layouts.footer')
