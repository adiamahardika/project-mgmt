<!DOCTYPE html>
<html>
<head>
    <title>Project Management</title>
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
<body class="container mt-5">
    <h1>Project List</h1>

    <a href="{{ route('projects.create') }}" class="btn btn-primary">Create New Project</a>

    @if (session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <table class="mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $index => $project)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->created_at }}</td>
                    <td>{{ $project->updated_at }}</td>
                    <td><a href="{{ route('projects.show', $project) }}" class="btn btn-success">View</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
