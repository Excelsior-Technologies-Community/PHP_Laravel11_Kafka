<!DOCTYPE html>
<html>
<head>
    <title>Kafka Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; font-family: Arial; }
        .card { border-radius: 10px; }
        .header { display: flex; justify-content: space-between; align-items: center; }
        .badge-success { background: #28a745; }
        .status-box { padding: 10px; border-radius: 5px; font-weight: bold; margin-bottom: 10px; }
    </style>
</head>
<body class="p-4">

<div class="container">
    <div class="header mb-4">
        <h2>Kafka Messages Dashboard</h2>
        <div>
            <span id="kafka-status" class="status-box bg-secondary text-white">Checking Kafka...</span>
            <a href="/kafka-send?message=TestMessage" class="btn btn-primary">Send Test Message</a>
        </div>
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
                    <td>{{ $msg->message }}</td>
                    <td><span class="badge badge-success">Processed</span></td>
                    <td>{{ $msg->created_at }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">No messages found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    async function checkKafkaStatus() {
        try {
            const res = await fetch('/kafka-status');
            const data = await res.json();
            const badge = document.getElementById('kafka-status');
            badge.innerText = data.status === 'success' ? 'Kafka Online' : 'Kafka Offline';
            badge.className = data.status === 'success' ? 'status-box bg-success text-white' : 'status-box bg-danger text-white';
        } catch (e) {
            document.getElementById('kafka-status').innerText = 'Kafka Offline';
            document.getElementById('kafka-status').className = 'status-box bg-danger text-white';
        }
    }

    checkKafkaStatus();
    setInterval(() => {
        location.reload();
    }, 5000);
</script>

</body>
</html>