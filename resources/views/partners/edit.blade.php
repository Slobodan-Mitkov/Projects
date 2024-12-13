<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('dashboard') }}#partners" class="text-white btn btn-primary my-4">Go back</a>
                    <h1 class="text-center">Edit Partner</h1>
                    @if (session('success'))
                    <div class="alert alert-success my-4 mb-4" id="success-alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form id="PartnerForm" action="{{ route('partners.update', $partner->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            @if ($errors->has('logo'))
                            @foreach ($errors->get('logo') as $error)
                            <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            @endif
                            <label for="logo" class="form-label">Logo:</label>
                            <input
                                type="text"
                                id="logo"
                                name="logo"
                                class="form-control @error('logo') is-invalid @enderror"
                                value="{{ old('logo', $partner->logo) }}">
                        </div>

                        <div class="mb-3">
                            @if ($errors->has('company_name'))
                            @foreach ($errors->get('company_name') as $error)
                            <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            @endif
                            <label for="company_name" class="form-label">Company name:</label>
                            <input
                                type="text"
                                id="company_name"
                                name="company_name"
                                class="form-control @error('company_name') is-invalid @enderror"
                                value="{{ old('company_name', $partner->company_name) }}">
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

                        <div class="mb-3">
                            @if ($errors->has('collaboration_description'))
                            @foreach ($errors->get('collaboration_description') as $error)
                            <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            @endif
                            <label for="collaboration_description" class="form-label">Collaboration Description:</label>
                            <textarea
                                id="collaboration_description"
                                name="collaboration_description"
                                class="form-control @error('collaboration_description') is-invalid @enderror"
                                required>{{ old('collaboration_description', $partner->collaboration_description) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>