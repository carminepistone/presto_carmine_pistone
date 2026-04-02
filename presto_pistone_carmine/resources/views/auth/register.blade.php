<x-layout>
    <div class="d-flex justify-content-center align-items-center vh-100 bg-light">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 420px;">

            <div class="text-center mb-4">
                <h2 class="fw-bold">{{ __('ui.account_create') }}</h2>
                <p class="text-muted">{{ __('ui.form') }}</p>
            </div>

            <form method="POST" action="/register">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">{{ __('ui.user_name') }}</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control form-control-lg @error('name') is-invalid @enderror"
                        placeholder="Mario Rossi"
                        value="{{ old('name') }}"
                        required
                    />
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                        placeholder="nome@esempio.it"
                        value="{{ old('email') }}"
                        required
                    />
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                        placeholder="••••••••"
                        required
                    />
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-semibold">
                        {{ __('ui.password_confirmation') }}
                    </label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="form-control form-control-lg"
                        required
                    />
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger py-2">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-account">
                        {{ __('ui.register') }}
                    </button>
                </div>

            </form>

            <div class="text-center mt-3">
                <small class="text-muted">
                    {{ __('ui.got_account') }}
                    <a href="{{ route('login') }}" class="text-decoration-none special-text fw-semibold">
                        {{ __('ui.sign_up') }}
                    </a>
                </small>
            </div>

        </div>
    </div>
</x-layout>