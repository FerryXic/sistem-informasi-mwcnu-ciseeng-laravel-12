<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Activitie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ManajemenPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->q;

        $posts = Post::with('user')
            ->when($keyword, function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('category', 'like', "%$keyword%")
                        ->orWhere('title', 'like', "%$keyword%")
                        ->orWhereHas('user', function ($q2) use ($keyword) {
                            $q2->where('name', 'like', "%$keyword%");
                        });
                });
            })
            ->orderBy('id', 'DESC')
            ->get();


        if ($request->ajax()) {
            return view('SuperAdmin.ManajemenPost.Read', compact('posts'))->render();
        }

        return view('SuperAdmin.ManajemenPost.Index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|in:article,news,proker',
            'title'    => 'required|string|max:255',
            'content'  => 'required|string',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            if ($request->hasFile('image')) {
                // Simpan ke storage/app/public/posts
                $path = $request->file('image')->store('posts', 'public');
                $validated['image'] = basename($path);
            }

            $validated['author'] = Auth::id();
            $post = Post::create($validated);

            Activitie::create([
                'user_id' => Auth::id(),
                'method'  => 'store',
                'value'   => Auth::user()->name . ' Menambahkan post: ' . $post->category,
            ]);

            return redirect()->back()->with('success', 'Post berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan post: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category' => 'required|in:article,news,proker',
            'title'    => 'required|string|max:255',
            'content'  => 'required|string',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            $post = Post::findOrFail($id);

            if ($request->hasFile('image')) {
                // Hapus file lama di storage kalau ada
                if ($post->image && Storage::disk('public')->exists('posts/' . $post->image)) {
                    Storage::disk('public')->delete('posts/' . $post->image);
                }

                // Simpan file baru
                $path = $request->file('image')->store('posts', 'public');
                $validated['image'] = basename($path);
            }

            $validated['author'] = Auth::id();
            $post->update($validated);

            Activitie::create([
                'user_id' => Auth::id(),
                'method'  => 'update',
                'value'   => Auth::user()->name . ' Memperbarui post: ' . $post->category,
            ]);

            return redirect()->back()->with('success', 'Post berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui post: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
            $category = $post->category;

            // Hapus file di storage jika ada
            if ($post->image && Storage::disk('public')->exists('posts/' . $post->image)) {
                Storage::disk('public')->delete('posts/' . $post->image);
            }

            $post->delete();

            Activitie::create([
                'user_id' => Auth::id(),
                'method'  => 'delete',
                'value'   => Auth::user()->name . ' Menghapus post: ' . $category,
            ]);

            return redirect()->back()->with('success', 'Post berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus post: ' . $e->getMessage());
        }
    }
}
