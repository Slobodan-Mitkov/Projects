<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('dashboard') }}#testimonials" class="btn btn-primary my-4">Go back</a>
                    <h1 class="text-center">Edit Testimonial</h1>
                    @if (session('success'))
                    <div class="alert alert-success my-4 mb-4" id="success-alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form id="TestimonialForm" action="{{ route('testimonials.update', $testimonial->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            @if ($errors->has('testimonial_text'))
                            @foreach ($errors->get('testimonial_text') as $error)
                            <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            @endif
                            <label for="testimonial_text" class="form-label">Collaboration Description:</label>
                            <textarea
                                id="testimonial_text"
                                name="testimonial_text"
                                class="form-control @error('testimonial_text') is-invalid @enderror"
                                required>{{ old('testimonial_text', $testimonial->testimonial_text) }}</textarea>
                        </div>

                        <div class="mb-3">
                            @if ($errors->has('client_name'))
                            @foreach ($errors->get('client_name') as $error)
                            <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            @endif
                            <label for="client_name" class="form-label">Client name:</label>
                            <input
                                type="text"
                                id="client_name"
                                name="client_name"
                                class="form-control @error('client_name') is-invalid @enderror"
                                value="{{ old('client_name', $testimonial->client_name) }}">
                        </div>

                        <div class="mb-3">
                            @if ($errors->has('client_position'))
                            @foreach ($errors->get('client_position') as $error)
                            <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            @endif
                            <label for="client_position" class="form-label">Client position:</label>
                            <input
                                type="text"
                                id="client_position"
                                name="client_position"
                                class="form-control @error('client_position') is-invalid @enderror"
                                value="{{ old('client_position', $testimonial->client_position) }}">
                        </div>

                        <div class="mb-3">
                            @if ($errors->has('client_company'))
                            @foreach ($errors->get('client_company') as $error)
                            <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            @endif
                            <label for="client_company" class="form-label">Client company:</label>
                            <input
                                type="text"
                                id="client_company"
                                name="client_company"
                                class="form-control @error('client_company') is-invalid @enderror"
                                value="{{ old('client_company', $testimonial->client_company) }}">
                        </div>

                        <div class="mb-3">
                            @if ($errors->has('client_profile_picture'))
                            @foreach ($errors->get('client_profile_picture') as $error)
                            <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            @endif
                            <label for="client_profile_picture" class="form-label">Client Profile Picture:</label>
                            <input
                                type="text"
                                id="client_profile_picture"
                                name="client_profile_picture"
                                class="form-control @error('client_profile_picture') is-invalid @enderror"
                                value="{{ old('client_profile_picture', $testimonial->client_profile_picture) }}">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>