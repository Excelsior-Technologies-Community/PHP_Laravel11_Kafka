<!DOCTYPE html>
<html>
<head>
    <title>Kafka Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            font-family: Arial;
        }

        .card {
            border-radius: 10px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .badge-success {
            background: #28a745;
        }
    </style>
</head>

<body class="p-4">

<div class="container">

    <div class="header mb-4">
        <h2>Kafka Messages Dashboard</h2>
        <a href="/kafka-send?message=TestMessage" class="btn btn-primary">
            Send Test Message
        </a>
    </div>

    <div class="card p-3">

        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>

            <tbody>
                @forelse($messages as $msg)
                <tr>
                    <td>{{ $msg->id }}</td>

                    <td>
                        {{ $msg->message }}
                    </td>

                    <td>
                        <span class="badge badge-success">
                            Processed
                        </span>
                    </td>

                    <td>{{ $msg->created_at }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">
                        No messages found
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>

<!-- Auto Refresh -->
<script>
setInterval(() => {
    location.reload();
}, 5000);
</script>

</body>
</html>