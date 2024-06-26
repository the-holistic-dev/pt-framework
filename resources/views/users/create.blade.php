<x-layout>
    @include('partials._nav')
    <div class="bg-black bg-pattern-2 text-light py-10">
        <div class="container">
            <h1>
                Register
            </h1>
            <form method="POST" action="/users">
                @csrf
                <label class="form-label" for="name">
                    Name
                </label>
                <input type="text" name="name" class="form-control">
                @error('name')
                    <p>
                        {{ message }}
                    </p>
                @enderror
                <label class="form-label" for="email">
                    Email
                </label>
                <input class="form-control" type="email" name="email">
                @error('email')
                    <p>
                        {{ message }}
                    </p>
                @enderror
                <label class="form-label" for="password">
                    Password
                </label>
                <input class="form-control" type="password" name="password">
                @error('password')
                    <p>
                        {{ message }}
                    </p>
                @enderror
                <label class="form-label" for="password_confirmation">
                    Confirm password
                </label>
                <input class="form-control" type="password_confirmation" name="password_confirmation">
                @error('password_confirmation')
                    <p>
                        {{ message }}
                    </p>
                @enderror
                <button type="submit" class="btn btn-primary mt-5">
                    Sign up
                </button>
            </form>
            <p class="text-center">
                Already have an account ?
                <a href="/login">Login</a>
            </p>
        </div>
    </div>
</x-layout>
