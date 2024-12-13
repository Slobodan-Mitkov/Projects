<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.css" rel="stylesheet">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6 border-gray-200">
                    <a class="text-white btn btn-primary" href="{{ route('dashboard') }}">Go back</a>
                    <h1 class="text-center">Chart</h1>
                    <div class="content-container">
                        <div class="chart-container container">
                            <h2 id="chart-title"></h2>
                            <canvas id="chart" width="100%" height="100%"></canvas>
                        </div>

                        <div class="statistic-container container">
                            <h3>Job Dates</h3>
                            <div id="calendar"></div>
                        </div>

                        <div class="statistic-container container">
                            <h3 class="section-title">Job Status</h3>
                            <table class="stat-table">
                                <thead>
                                    <tr>
                                        <th>Statistic</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Month with Most Jobs</strong></td>
                                        <td>{{ $maxMonth }} - {{ $maxJobs }} Jobs</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Month with Least Jobs</strong></td>
                                        <td>{{ $minMonth }} - {{ $minJobs }} Jobs</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Average Jobs per Month</strong></td>
                                        <td>{{ number_format($averageJobs, 2) }} Jobs</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="statistic-container container">
                            <h3 class="section-title">Job Statistics</h3>
                            <table class="stat-table">
                                <thead>
                                    <tr>
                                        <th>Month</th>
                                        <th>Jobs</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($chartData as $month => $count)
                                    <tr>
                                        <td>{{ $month }}</td>
                                        <td>{{ $count }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script>
        window.chartData = JSON.parse('{!! json_encode($chartData) !!}');
    </script>
    <script src="/js/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            const jobDates = JSON.parse('{!! json_encode($jobDates) !!}');

            const jobCounts = {};
            jobDates.forEach(function(job) {
                if (job.start) {
                    const date = job.start.split('T')[0];
                    if (!jobCounts[date]) {
                        jobCounts[date] = 0;
                    }
                    jobCounts[date] += 1;
                }
            });

            var calendar = new FullCalendar.Calendar(calendarEl, {
                timeZone: 'UTC',
                themeSystem: 'bootstrap5',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                weekNumbers: false,
                dayMaxEvents: true,
                events: jobDates,
                dayCellContent: function(arg) {
                    const date = arg.date.toISOString().split('T')[0];
                    const count = jobCounts[date] || 0;
                    if (arg.view.type === 'dayGridMonth' && count > 0) {
                        return {
                            html: `<p style="padding: 4px">${arg.dayNumberText}</p><div style="position: absolute; width: 50px; height: 25px; top: 50%; right: 15%; background-color: grey; color: white; border-radius: 4px; display: flex; justify-content: center; align-items: center; "><p>${count} Job${count > 1 ? 's' : ''}</p></div>`
                        };
                    } else {
                        return {
                            html: `<p style="padding: 4px">${arg.dayNumberText}</p>`
                        };
                    }
                },
                eventContent: function(arg) {
                    return {
                        html: `<div>${arg.event.title}</div>`
                    };
                }
            });

            calendar.render();
        });
    </script>
</x-app-layout>