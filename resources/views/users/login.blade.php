<x-layout>
    <section>
        <div class="container d-flex flex-column">
            <div class="row align-items-center justify-content-center gx-0 min-vh-100">
                <div class="col-12 col-md-6 col-lg-4 py-8 py-md-11">
                    <!-- Heading -->
                    <h1 class="mb-0 fw-bold">
                        Sign in
                    </h1>

                    <!-- Text -->
                    <p class="mb-6 text-body-secondary">
                        Simplify your workflow in minutes.
                    </p>

                    <!-- Form -->
                    <form class="mb-6" method="POST" action="user/authenticate">
                        @csrf
                        <!-- Email -->
                        <div class="form-group">
                            <label class="form-label" for="email">
                                Email Address
                            </label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="name@address.com">
                            @error('email')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group mb-5">
                            <label class="form-label" for="password">
                                Password
                            </label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Enter your password">
                        </div>

                        <!-- Submit -->
                        <button class="btn w-100 btn-primary" type="submit">
                            Sign in
                        </button>

                    </form>

                    <!-- Text -->
                    <p class="mb-0 fs-sm text-body-secondary">
                        Don't have an account yet? <a href="signup-cover.html">Sign up</a>.
                    </p>

                </div>
                <div class="col-lg-7 offset-lg-1 align-self-stretch d-none d-lg-block">

                    <!-- Image -->
                    <div class="h-100 w-cover bg-cover"
                        style="background-image: url('{{ asset('images/covers/cover-1.jpg') }}')">
                    </div>

                    <!-- Shape -->
                    <div class="shape shape-start shape-fluid-y text-white">
                        @php echo file_get_contents('shapes/angles/angle-start.svg') @endphp
                    </div>

                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>
</x-layout>
