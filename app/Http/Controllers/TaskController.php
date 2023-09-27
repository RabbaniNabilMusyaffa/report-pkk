<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('content.tables.task-table', compact('tasks'));
    }

    public function create()
    {
        return view('tambahTask');
    }

    public function edit($id)
    {
        $tasks = Task::find($id);
        return view('editTask', compact('tasks'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'deadline' => 'required',
            'deskripsi' => 'required'
        ]);
        Task::create([
            'title' => $request->title,
            'deadline' => $request->deadline,
            'deskripsi' => $request->deskripsi
        ]);
        return redirect()->route('task-list')->with('message', 'Task berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $tasks = Task::find($id);
        $request->validate([
            'title' => 'required',
            'deadline' => 'required',
            'deskripsi' => 'required'
        ]);

        $tasks->update([
            'title' => $request->title,
            'deadline' => $request->deadline,
            'deskripsi' => $request->deskripsi
        ]);
        return redirect()->route('task-list')->with('message', 'Task berhasil diperbarui');
    }

    public function detail($id)
    {
        $tasks = Task::find($id);
        return view('detailTask', compact('tasks'));
    }

    public function Delete($id)
    {
        Task::destroy($id);

        return redirect()->route('task-list')->with('message', 'Task berhasil dihapus');
    }
}
