<x-layout>

    <h1 class="title">Register a new account</h1>
    <div class="mx-auto max-w-screen-sm card">
        <form action="{{ route("register") }}" method="POST">
            @csrf

            {{-- Username --}}
            <div class="mb-4">
                <label for="username">Username</label>
                <input type="text" name="username" value="{{ old("username") }}" class="input
                @error('username') ring-offset-2 ring-red-500 @enderror">
                @error('username')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email">Email</label>
                <input type="text" name="email" value="{{ old("email") }}" class="input
                @error('email') ring-offset-2 ring-red-500 @enderror">
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" value="{{ old("password") }}" class="input
                @error('password') ring-offset-2 ring-red-500 @enderror">
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirm password --}}
            <div class="mb-4">
                <label for="password_confirmation">Confirm password</label>
                <input type="password" name="password_confirmation" value="{{ old("password_confirmation") }}" class="input
                @error('password_confirmation') ring-offset-2 ring-red-500 @enderror">
                @error('password_confirmation')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button class="btn">
                Register
            </button>
        </form>
    </div>

</x-layout>
