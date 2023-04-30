<x-guest-layout>
    <header>
        <h5 style="color: #1078d0;margin-top: 15px;">Member Login</h5>
    </header>
    <x-jet-validation-errors class="mb-4" />
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="field">
            <span class="fa fa-user"></span>
            <input type="email" name="email" id="email" placeholder="Email or Phone" :value="old('email')" required autofocus>
        </div>
        <div class="field space">
            <span class="fa fa-lock"></span>
            <input type="password" name="password" id="password" class="pass-key" placeholder="Password" required autocomplete="current-password">
            <span class="show">SHOW</span>
        </div>
        <div class="pass" style="display: flex;justify-content: space-between;">
            <a href="">Forgot Password?</a>
            <input style="padding: 10px 25px;
                        background: #1078d0;
                        outline: none;
                        border: none;
                        color: #fff;
                        font-weight: bolder;" type="submit" value="LOGIN">
        </div>
    </form>
    {{-- <div class="signup">Don't have account?
        <a href="{{ route('register') }}">Signup Now</a>
    </div> --}}
</x-guest-layout>