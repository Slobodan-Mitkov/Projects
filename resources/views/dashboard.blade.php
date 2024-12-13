<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6">
                    <div class="flex">
                        <div class="ml-0 p-6 transition-all duration-300 w-full">
                            <!-- Home Section -->
                            <div id="home" class="dashboard-section">
                                <div class="content-container">
                                    <div class="messages-container container">
                                        <a style="width: 100%;" href="{{ route('messages.index') }}">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th><i class="fa-solid fa-inbox"></i> Messages
                                                            <span class="badge bg-danger">
                                                                @if ($messages->where('read', false)->where('deleted_at', null)->count() > 99)
                                                                99+
                                                                @else
                                                                {{ $messages->where('read', false)->where('deleted_at', null)->count() }}
                                                                @endif
                                                            </span>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($messages->sortByDesc('created_at')->where('read', false)->take(5) as $message)
                                                    <tr>
                                                        <td>{{ $message->full_name }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </a>
                                    </div>
                                    <div class="chart-container container">
                                        <a style="width: 100%; height: 100%;" href="{{ route('charts') }}">
                                            <canvas style="width: 100%; height: 100%;" id="chart"></canvas>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Jobs CRUD Section -->
                            <div id="jobs" class="dashboard-section" style="display: none;">
                                <h2>Jobs</h2>
                                <a class="btn btn-primary my-4" href="{{ route('jobs.create') }}">Add Job</a>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Job Type</th>
                                            <th>Work Mode</th>
                                            <th>Location</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jobs as $job)
                                        <tr>
                                            <td>{{ $job->title }}</td>
                                            <td>{{ $job->description }}</td>
                                            <td>{{ $job->job_type }}</td>
                                            <td>{{ $job->work_mode }}</td>
                                            <td>{{ $job->location }}</td>
                                            <td>
                                                <a class="btn btn-primary my-2" href="{{ route('jobs.edit', $job->id) }}">Edit</a>
                                                <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-primary my-2" type="submit">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Members CRUD Section -->
                            <div id="members" class="dashboard-section" style="display: none;">
                                <h2>Members</h2>
                                <a class="btn btn-primary my-4" href="{{ route('members.create') }}">Add Member</a>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Picture</th>
                                            <th>Name</th>
                                            <th>Surname</th>
                                            <th>Position</th>
                                            <th>Short Profile</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($members as $member)
                                        <tr>
                                            <td>{{ $member->picture }}</td>
                                            <td>{{ $member->name }}</td>
                                            <td>{{ $member->surname }}</td>
                                            <td>{{ $member->position->name }}</td>
                                            <td>{{ $member->short_profile }}</td>
                                            <td>
                                                <a class="btn btn-primary my-2" href="{{ route('members.edit', $member->id) }}">Edit</a>
                                                <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-primary my-2" type="submit">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Partners CRUD Section -->
                            <div id="partners" class="dashboard-section" style="display: none;">
                                <h2>Partners</h2>
                                <a class="btn btn-primary my-4" href="{{ route('partners.create') }}">Add Partner</a>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Company Name</th>
                                            <th>Industry</th>
                                            <th>Logo</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($partners as $partner)
                                        <tr>
                                            <td>{{ $partner->company_name }}</td>
                                            <td>{{ $partner->find($partner->industry_id)->name }}</td>
                                            <td>{{ $partner->logo }}</td>
                                            <td>
                                                <a class="btn btn-primary my-2" href="{{ route('partners.edit', $partner->id) }}">Edit</a>
                                                <form action="{{ route('partners.destroy', $partner->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-primary my-2" type="submit">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Testimonials CRUD Section -->
                            <div id="testimonials" class="dashboard-section" style="display: none;">
                                <h2>Testimonials</h2>
                                <a class="btn btn-primary my-4" href="{{ route('testimonials.create') }}">Add Testimonial</a>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Testimonial Text</th>
                                            <th>Client Name</th>
                                            <th>Client Position</th>
                                            <th>Client Company</th>
                                            <th>Client Profile Picture</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($testimonials as $testimonial)
                                        <tr>
                                            <td>{{ $testimonial->testimonial_text }}</td>
                                            <td>{{ $testimonial->client_name }}</td>
                                            <td>{{ $testimonial->client_position }}</td>
                                            <td>{{ $testimonial->client_company }}</td>
                                            <td>{{ $testimonial->client_profile_picture }}</td>
                                            <td>
                                                <a class="btn btn-primary my-2" href="{{ route('testimonials.edit', $testimonial->id) }}">Edit</a>
                                                <form action="{{ route('testimonials.destroy', $testimonial->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-primary my-2" type="submit">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Industries CRUD Section -->
                            <div id="industries" class="dashboard-section" style="display: none;">
                                <h2>Industries</h2>
                                <a class="btn btn-primary my-4" href="{{ route('industries.create') }}">Add Industry</a>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Icon</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($industries as $industry)
                                        <tr>
                                            <td>{{ $industry->name }}</td>
                                            <td>{{ $industry->description }}</td>
                                            <td>{{ $industry->icon }}</td>
                                            <td>
                                                <a class="btn btn-primary my-2" href="{{ route('industries.edit', $industry->id) }}">Edit</a>
                                                <form action="{{ route('industries.destroy', $industry->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-primary my-2" type="submit">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Services CRUD Section -->
                            <div id="services" class="dashboard-section" style="display: none;">
                                <h2>Services</h2>
                                <a class="btn btn-primary my-4" href="{{ route('services.create') }}">Add Service</a>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Service Category</th>
                                            <th>Industry</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($services as $service)
                                        <tr>
                                            <td>{{ $service->name }}</td>
                                            <td>{{ $service->description }}</td>
                                            <td>{{ $service->find($service->service_category_id)->name }}</td>
                                            <td>{{ $service->find($service->industry_id)->name }}</td>
                                            <td>
                                                <a class="btn btn-primary my-2" href="{{ route('services.edit', $service->id) }}">Edit</a>
                                                <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-primary my-2" type="submit">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Service Categories CRUD Section - Create Only -->
                            <div id="serviceCategories" class="dashboard-section" style="display: none;">
                                <h2>Service Categories</h2>
                                @if (session('success'))
                                <div class="alert alert-success my-4 mb-4" id="success-alert">
                                    {{ session('success') }}
                                </div>
                                @endif
                                <form class="mb-3 my-3" action="{{ route('serviceCategories.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        @if ($errors->has('name'))
                                        @foreach ($errors->get('name') as $error)
                                        <p class="text-danger">{{ $error }}</p>
                                        @endforeach
                                        @endif
                                        <label for="name" class="form-label">Client Name:</label>
                                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                                    </div>
                                    <button class="btn btn-primary my-4 w-100" type="submit">Add Category</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation@2.1.1"></script>
    <script src="{{ asset('js/input-validation.js') }}"></script>
    <script>
        window.chartData = JSON.parse('{!! json_encode($chartData) !!}');
    </script>
    <script src="/js/chart.js"></script>
</x-app-layout>