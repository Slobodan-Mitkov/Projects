<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('dashboard') }}#industries" class="text-white btn btn-primary my-4">Go back</a>
                    <h1 class="text-center">Edit Industry</h1>
                    @if (session('success'))
                    <div class="alert alert-success my-4 mb-4" id="success-alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form id="IndustryForm" action="{{ route('industries.update', $industry->id) }}" method="post" enctype="multipart/form-data">
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
                                value="{{ old('name', $industry->name) }}">
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
                                required>{{ old('description', $industry->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            @if ($errors->has('icon'))
                            @foreach ($errors->get('icon') as $error)
                            <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            @endif
                            <label for="icon" class="form-label">icon:</label>
                            <input
                                type="text"
                                id="icon"
                                name="icon"
                                class="form-control @error('icon') is-invalid @enderror"
                                value="{{ old('icon', $industry->icon) }}">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>