<!DOCTYPE html>
<html>
<head>
    <title>Project Details</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>{{ $project->name }}</h1>
        <p>{{ $project->description }}</p>

        <a href="{{ route('tasks.create', $project) }}" class="btn btn-primary">Add Task</a>

        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <h2 class="mt-5">Tasks</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Update Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($project->tasks as $index => $task)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->status }}</td>
                        <td>
                            <form action="{{ route('tasks.updateStatus', [$project, $task]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()">
                                    <option value="not started" {{ $task->status == 'not started' ? 'selected' : '' }}>Not Started</option>
                                    <option value="in progress" {{ $task->status == 'in progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="mt-5">Project Progress</h2>
        <canvas id="progressChart" width="400" height="200"></canvas>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('progressChart').getContext('2d');
            var progressChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Completed', 'In Progress', 'Not Started'],
                    datasets: [{
                        data: [
                            {{ $progressData['completed'] }},
                            {{ $progressData['inProgress'] }},
                            {{ $progressData['notStarted'] }}
                        ],
                        backgroundColor: ['#4caf50', '#ffeb3b', '#f44336']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Project Progress'
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
