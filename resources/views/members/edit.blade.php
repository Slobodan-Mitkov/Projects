<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('dashboard') }}#members" class="text-white btn btn-primary my-4">Go back</a>
                    <h1 class="text-center">Edit Member</h1>
                    @if (session('success'))
                    <div class="alert alert-success my-4 mb-4" id="success-alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form id="MemberForm" action="{{ route('members.update', $member->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            @if ($errors->has('picture'))
                            @foreach ($errors->get('picture') as $error)
                            <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            @endif
                            <label for="picture" class="form-label">Picture:</label>
                            <input
                                type="text"
                                id="picture"
                                name="picture"
                                class="form-control @error('picture') is-invalid @enderror"
                                value="{{ old('picture', $member->picture) }}">
                        </div>

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
                                value="{{ old('name', $member->name) }}">
                        </div>

                        <div class="mb-3">
                            @if ($errors->has('surname'))
                            @foreach ($errors->get('surname') as $error)
                            <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            @endif
                            <label for="surname" class="form-label">Surname:</label>
                            <input
                                type="text"
                                id="surname"
                                name="surname"
                                class="form-control @error('surname') is-invalid @enderror"
                                value="{{ old('surname', $member->surname) }}">
                        </div>

                        <div class="mb-3">
                            @if ($errors->has('position_id'))
                            @foreach ($errors->get('position_id') as $error)
                            <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            @endif
                            <label for="position_id" class="form-label">Position:</label>
                            <select
                                id="position_id"
                                name="position_id"
                                class="form-select @error('position_id') is-invalid @enderror"
                                required>
                                <option value="" disabled>Select a position</option>
                                @foreach($positions as $position)
                                <option value="{{ $position->id }}" {{ old('position_id', $member->position_id) == $position->id ? 'selected' : '' }}>{{ $position->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            @if ($errors->has('short_profile'))
                            @foreach ($errors->get('short_profile') as $error)
                            <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            @endif
                            <label for="short_profile" class="form-label">Short profile:</label>
                            <textarea
                                id="short_profile"
                                name="short_profile"
                                class="form-control @error('short_profile') is-invalid @enderror"
                                required>{{ old('short_profile', $member->short_profile) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>