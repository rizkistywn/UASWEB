<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ImageUploadingTrait;
use App\Http\Requests\Admin\CategoryRequest;

class CategoryController extends Controller
{
    use ImageUploadingTrait;
    /**
     * Menampilkan daftar resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::withCount('products')->get();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Menampilkan formulir untuk membuat resource baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNull('category_id')->pluck('name', 'id');

        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Menyimpan resource baru yang dibuat di storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());

        if ($request->input('photo', false)) {
            $category->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        return redirect()->route('admin.categories.index')->with([
            'message' => 'Succeess Created !',
            'type' => 'success'
        ]);
    }

    /**
     * Menampilkan formulir untuk edit resource yang spesifik.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::whereNull('category_id')->pluck('name', 'id');

        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Memperbarui resource yang spesifik di storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request,Category $category)
    {
        $category->update($request->validated());

        if($request->input('photo', false)){
            if(!$category->photo || $request->input('photo') !== $category->photo->file_name){
                isset($category->photo) ? $category->photo->delete() : null;
                $category->addMedia(storage_path('tmp/uploads/') . $request->input('photo'))->toMediaCollection('photo');
            }
        }else if($category->photo){
            $category->photo->delete();
        }

        return redirect()->route('admin.categories.index')->with([
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
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->with([
            'message' => 'Deleted Successfully !',
            'type' => 'danger'
        ]);
    }
}
