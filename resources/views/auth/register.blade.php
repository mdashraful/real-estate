@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Create an Account</h4>
                    </div>
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data"
                            class="needs-validation" novalidate>
                            @csrf

                            <div class="row g-3">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Full Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number <span
                                            class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Profile Photo -->
                                <div class="col-md-6">
                                    <label for="photo" class="form-label">Profile Photo</label>
                                    <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                        id="photo" name="photo" accept="image/*">
                                    @error('photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Max 2MB (JPG, PNG, JPEG)</small>
                                </div>

                                <!-- Password -->
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password <span
                                            class="text-danger">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">Confirm Password <span
                                            class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" required>
                                </div>

                                <!-- Country -->
                                <div class="col-md-6">
                                    <label for="country" class="form-label">Country <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('country') is-invalid @enderror" id="country"
                                        name="country" required>
                                        <option value="" disabled selected>Select Country</option>
                                        <option value="USA" {{ old('country') == 'USA' ? 'selected' : '' }}>United
                                            States</option>
                                        <option value="UK" {{ old('country') == 'UK' ? 'selected' : '' }}>United
                                            Kingdom</option>
                                        <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>Canada
                                        </option>
                                        <!-- Add more countries as needed -->
                                    </select>
                                    @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- State -->
                                <div class="col-md-6">
                                    <label for="state" class="form-label">State/Province <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('state') is-invalid @enderror"
                                        id="state" name="state" value="{{ old('state') }}" required>
                                    @error('state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- City -->
                                <div class="col-md-6">
                                    <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror"
                                        id="city" name="city" value="{{ old('city') }}" required>
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- ZIP/Postal Code -->
                                <div class="col-md-6">
                                    <label for="zip" class="form-label">ZIP/Postal Code <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('zip') is-invalid @enderror"
                                        id="zip" name="zip" value="{{ old('zip') }}" required>
                                    @error('zip')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Terms and Conditions -->
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input @error('terms') is-invalid @enderror"
                                            type="checkbox" id="terms" name="terms" required>
                                        <label class="form-check-label" for="terms">
                                            I agree to the <a href="#">Terms and Conditions</a> <span
                                                class="text-danger">*</span>
                                        </label>
                                        @error('terms')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 mt-4 text-center">
                                    <button type="submit" class="btn btn-primary py-2">Create Account</button>
                                </div>

                                <!-- Login Link -->
                                <div class="col-12 text-center">
                                    <p class="mb-0">Already have an account?
                                        <a href="{{ route('login') }}" class="text-primary">Sign In</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
