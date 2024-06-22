<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagRequest;

class TagController extends Controller
{
    /**
     * Menampilkan daftar resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::withCount('products')->get();

        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Menampilkan formulir untuk membuat resource baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        Tag::create($request->validated());

        return redirect()->route('admin.tags.index')->with([
            'message' => 'Success Created !',
            'type' => 'success'
        ]);
    }

    /**
     * Menampilkan formulir untuk edit resource yang spesifik.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Memperbarui resource yang spesifik di storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request,Tag $tag)
    {
        $tag->update($request->validated());

        return redirect()->route('admin.tags.index')->with([
            'message' => 'Success Updated !',
            'type' => 'info'
        ]);
    }

    /**
     * Hapus resource yang spesifik dari storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->back()->with([
            'message' => 'Success Deleted',
            'type' => 'danger'
        ]);
    }
}
