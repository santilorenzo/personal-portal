<?php

namespace App\Http\Controllers;

use App\Models\DiaryPost;
use Illuminate\Support\Str;
use App\Http\Requests\StoreDiaryPostRequest;
use App\Http\Requests\UpdateDiaryPostRequest;

class DiaryPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.diary_posts.index', [
            'diaryPosts' => DiaryPost::latest()->paginate(10),
        ]);        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.diary_posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiaryPostRequest $request)
    {
        $validated = $request->validated();

        // create the slug and check if already exists
        $slug = Str::slug($validated['title'], '-');
        $validated['slug'] = $slug;

        // check if slug already exists
        $slugCount = DiaryPost::where('slug', 'like', "{$slug}%")->count();

        if ($slugCount > 0) {
            $validated['slug'] .= '-' . ($slugCount + 1);
        }

        $diaryPost = DiaryPost::create($validated);

        return redirect()->route('diary_posts.show', $diaryPost);
    }

    /**
     * Display the specified resource.
     */
    public function show(DiaryPost $diaryPost)
    {
        return view('app.diary_posts.show', [
            'diaryPost' => $diaryPost,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DiaryPost $diaryPost)
    {
        return view('app.diary_posts.edit', [
            'diaryPost' => $diaryPost,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiaryPostRequest $request, DiaryPost $diaryPost)
    {
        $diaryPost->update($request->validated());

        return redirect()->route('diary_posts.show', $diaryPost);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiaryPost $diaryPost)
    {
        $diaryPost->delete();

        return redirect()->route('diary_posts.index');
    }
}
