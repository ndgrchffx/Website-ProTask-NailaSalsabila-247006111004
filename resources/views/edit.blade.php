<!DOCTYPE html>
<html>

<head>
    <title>Edit Tugas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">📝 Edit Tugas (ID: {{ $task->id }})</h4>
                    </div>
                    <div class="card-body">
                        <form action="/update/{{ $task->id }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Tugas</label>
                                <input type="text" name="tugas" class="form-control" value="{{ $task->nama_tugas }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Deadline</label>
                                <input type="date" name="deadline" class="form-control" value="{{ $task->deadline }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Prioritas</label>
                                <select name="priority" class="form-select">
                                    <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Rendah</option>
                                    <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Sedang</option>
                                    <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>Tinggi!</option>
                                </select>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="/" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>