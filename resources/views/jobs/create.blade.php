<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('dashboard') }}#jobs" class="text-white btn btn-primary my-4">Go back</a>
                    <h1 class="text-center">Create Job</h1>
                    @if (session('success'))
                    <div class="alert alert-success my-4 mb-4" id="success-alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form id="JobForm" action="{{ route('jobs.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            @if ($errors->has('title'))
                            @foreach ($errors->get('title') as $error)
                            <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            @endif
                            <label for="title" class="form-label">Title:</label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}"
                                required>
                        </div>

                        <div class="mb-3">
                            @if ($errors->has('location'))
                            @foreach ($errors->get('location') as $error)
                            <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            @endif
                            <label for="location" class="form-label">Location:</label>
                            <input
                                type="text"
                                id="location"
                                name="location"
                                class="form-control @error('location') is-invalid @enderror"
                                value="{{ old('location') }}"
                                required>
                        </div>

                        <div class="mb-3">
                            @if ($errors->has('job_type'))
                            @foreach ($errors->get('job_type') as $error)
                            <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            @endif
                            <label for="job_type" class="form-label">Work mode:</label>
                            <select
                                id="job_type"
                                name="job_type"
                                class="form-select @error('job_type') is-invalid @enderror"
                                required>
                                <option value="" disabled selected>Select a Work mode</option>
                                <option value="full-time" {{ old('job_type') == 'full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="part-time" {{ old('job_type') == 'part-time' ? 'selected' : '' }}>Part-time</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            @if ($errors->has('work_mode'))
                            @foreach ($errors->get('work_mode') as $error)
                            <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            @endif
                            <label for="work_mode" class="form-label">Work mode:</label>
                            <select
                                id="work_mode"
                                name="work_mode"
                                class="form-select @error('work_mode') is-invalid @enderror"
                                required>
                                <option value="" disabled selected>Select a work mode</option>
                                <option value="hybrid" {{ old('work_mode') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                <option value="on-site" {{ old('work_mode') == 'on-site' ? 'selected' : '' }}>On-site</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            @if ($errors->has('description'))
                            @foreach ($errors->get('description') as $error)
                            <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            @endif
                            <label for="description" class="form-label">Collaboration Description:</label>
                            <textarea
                                id="description"
                                name="description"
                                class="form-control @error('description') is-invalid @enderror"
                                required>{{ old('description') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/form-validation.js') }}"></script>
</x-app-layout>