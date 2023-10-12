<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "List Tasks";
        $tasks = Task::UserId()->paginate(10);
        return view('tasks.index', compact('title', 'tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Tasks";
        return view('tasks.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();
        // dd($data);

        Task::create($data);
        flash()->addSuccess('Daftar Tugas Berhasil Di Tambahkan');
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $title = "Upload File Gambar Ke Tugas";

        return view('tasks.edit', compact('task', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);

        if (File::exists(public_path($task->gambar))) {
            File::delete(public_path($task->gambar));
        }

        $image = $request->file('gambar');
        $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->gambar->move(public_path('upload'), $imageName);
        $imageUrl = 'upload/' . $imageName;

        $task->update([
            'gambar' => $imageUrl,
        ]);

        flash()->addSuccess('Gambar Tugas Berhasil Di Upload');
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {

        if (File::exists(public_path($task->gambar))) {
            File::delete(public_path($task->gambar));
        }
        $task->delete();

        return back();
    }

    public function tandaiSebagaiSelesai(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->status = $request->input('status');
        $task->save();

        if ($task) {
            return response()->json(['text' => 'Status Tugas Berhasil Di Update Menjadi Selesai'], 200);
        } else {
            return response()->json(['text' => 'Status Tugas Berhasil Di Update Menjadi Selesai'], 400);
        }
    }
}
