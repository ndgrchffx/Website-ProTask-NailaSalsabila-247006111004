<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{

    public function apiIndex()
    {
        $tasks = Task::all();
        return response()->json([
            'success' => true,
            'data'    => $tasks
        ], 200);
    }

    public function index(Request $request)
    {
        $view = $request->query('view');
        $search = $request->query('search');
        $filter = $request->query('filter');

        $query = DB::table('tasks');
        if (!empty($search)) {
            $query->where('nama_tugas', 'LIKE', "%{$search}%");
        }

        // Filter status untuk Dashboard
        if ($filter == 'active') {
            $query->where('is_completed', 0);
        } elseif ($filter == 'done') {
            $query->where('is_completed', 1);
        }

        $query->orderBy('is_completed', 'asc')
            ->orderByRaw('deadline IS NULL ASC')
            ->orderBy('deadline', 'asc')
            ->orderByRaw("FIELD(priority, 'high', 'medium', 'low')");

        $tasks = $query->get();

        // Data untuk ringkasan di atas dan halaman Analytics
        $stats = [
            'total' => DB::table('tasks')->count(),
            'completed' => DB::table('tasks')->where('is_completed', 1)->count(),
            'active' => DB::table('tasks')->where('is_completed', 0)->count(),
            'high' => DB::table('tasks')->where('priority', 'high')->where('is_completed', 0)->count(),
        ];

        return view('todo', compact('tasks', 'stats', 'view'));
    }
    public function store(Request $request)
    {
        DB::table('tasks')->insert([
            'nama_tugas' => $request->tugas,
            'deadline' => $request->deadline,
            'priority' => $request->priority,
        ]);
        return redirect('/')->with('success', 'Tugas baru berhasil ditambahkan!');
    }
    public function edit($id)
    {
        $task = DB::table('tasks')->where('id', $id)->first();
        return view('edit', ['task' => $task]);
    }
    public function update(Request $request, $id)
    {
        DB::table('tasks')->where('id', $id)->update([
            'nama_tugas' => $request->tugas,
            'deadline' => $request->deadline,
            'priority' => $request->priority
        ]);
        return redirect('/')->with('success', 'Tugas berhasil diperbarui!');
    }
    public function destroy($id)
    {
        DB::table('tasks')->where('id', $id)->delete();
        return redirect('/')->with('success', 'Tugas telah dihapus!');
    }
    public function check($id)
    {
        // 1. Ambil data tugas berdasarkan id
        $task = DB::table('tasks')->where('id', $id)->first();

        // 2. Cek status sekarang, kalau 1 jadi 0, kalau 0 jadi 1
        $newStatus = $task->is_completed ? 0 : 1;

        // 3. Update ke database pakai DB Table (biar seragam)
        DB::table('tasks')->where('id', $id)->update([
            'is_completed' => $newStatus
        ]);

        return redirect()->back();
    }
}
