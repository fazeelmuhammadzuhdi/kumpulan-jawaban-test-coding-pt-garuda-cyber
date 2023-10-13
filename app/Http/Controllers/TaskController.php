<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\User;
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
        // Cara Ini Juga Bisa Tapi 2 Kali Looping Di Viewnnya
        // $listTasks = User::with('tasks')->where('id', auth()->user()->id)->get();
        // dd($tasks);
        // return view('tasks.index', compact('title', 'listTasks'));

        $title = "List Tasks";
        // Mengambil Data Task Berdasarkan User Yang Sedang Login
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
        // Validasi Data
        $data = $request->validated();
        // dd($data);

        // Menyimpan Data
        Task::create($data);

        //Pesan Berhasil
        flash()->addSuccess('Daftar Tugas Berhasil Di Tambahkan');

        // Kembali Ke Halaman 
        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {

        $task = Task::UserId()->findOrFail($id);
        $title = "Upload File Gambar Ke Tugas";

        return view('tasks.edit', compact('task', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        // Cek Apakah Gambarnya Ada ?
        if (File::exists(public_path($task->gambar))) {
            // Jika Ada hapus Gambar Lama Tersebut
            File::delete(public_path($task->gambar));
        }
        // Upload Gambar Baru
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
    // Menggunakan Model Binding
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
        // dd($task);
        $task->status = $request->input('status');
        $task->save();

        if ($task) {
            return response()->json(['text' => 'Status Tugas Berhasil Di Update Menjadi Selesai'], 200);
        } else {
            return response()->json(['text' => 'Status Tugas Gagal Di Perbaharui'], 400);
        }
    }
}
