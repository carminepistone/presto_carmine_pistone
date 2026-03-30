<x-layout>
    <div class="d-flex justify-content-center align-items-center vh-100 bg-light">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 420px;">

            <div class="text-center mb-4">
                <h2 class="fw-bold">{{ __('ui.welcome') }}</h2>
                <p class="text-muted">{{ __('ui.sign_up') }} {{ __('ui.to_account') }}</p>
            </div>

            <form method="POST" action="/login">
                @csrf

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
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                        required
                    />
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger py-2">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        {{ __('ui.sign_up') }}
                    </button>
                </div>

            </form>

            <div class="text-center mt-3">
                <small class="text-muted">
                    {{ __('ui.no_account') }} 
                    <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">
                        {{ __('ui.register') }}
                    </a>
                </small>
            </div>

        </div>
    </div>
</x-layout>