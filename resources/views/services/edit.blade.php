<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('dashboard') }}#services" class="text-white btn btn-primary my-4">Go back</a>
                    <h1 class="text-center">Edit Service</h1>
                    @if (session('success'))
                    <div class="alert alert-success my-4 mb-4" id="success-alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form id="ServiceForm" action="{{ route('services.update', $service->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            @if ($errors->has('name'))
                            @foreach ($errors->get('name') as $error)
                            <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            @endif
                            <label for="name" class="form-label">Name:</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $service->name) }}">
                        </div>

                        <div class="mb-3">
                            @if ($errors->has('description'))
                            @foreach ($errors->get('description') as $error)
                            <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            @endif
                            <label for="description" class="form-label">Description:</label>
                            <textarea
                                id="description"
                                name="description"
                                class="form-control @error('description') is-invalid @enderror"
                                required>{{ old('description', $service->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            @if ($errors->has('service_category_id'))
                            @foreach ($errors->get('service_category_id') as $error)
                            <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            @endif
                            <label for="service_category_id" class="form-label">Service Category:</label>
                            <select
                                id="service_category_id"
                                name="service_category_id"
                                class="form-select @error('service_category_id') is-invalid @enderror"
                                required>
                                <option value="" disabled>Select a service category</option>
                                @foreach($service_categories as $service_category)
                                <option value="{{ $service_category->id }}" {{ old('service_category_id', $service_category->service_category_id) == $service_category->id ? 'selected' : '' }}>{{ $service_category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            @if ($errors->has('industry_id'))
                            @foreach ($errors->get('industry_id') as $error)
                            <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            @endif
                            <label for="industry_id" class="form-label">Industry:</label>
                            <select
                                id="industry_id"
                                name="industry_id"
                                class="form-select @error('industry_id') is-invalid @enderror"
                                required>
                                <option value="" disabled>Select a industry</option>
                                @foreach($industries as $industry)
                                <option value="{{ $industry->id }}" {{ old('industry_id', $industry->industry_id) == $industry->id ? 'selected' : '' }}>{{ $industry->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>