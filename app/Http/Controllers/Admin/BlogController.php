<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax()) {
            $blogs = Blog::latest()->get();
            return response()->json(['blogs' => $blogs]);
        }
        return view('admin.blogs.index');
    }

    public function list(Request $request)
    {
        $query = Blog::query();

    if ($request->query) {
        $query->where('name', 'like', '%' . $request->get('query') . '%');
    }

    if ($request->get('sort') === 'recent') {
        $query->orderBy('date', 'desc');
    } else {
        $query->orderBy('created_at', 'desc'); // default order
    }

    $blogs = $query->paginate(9);

    if ($request->ajax()) {
        return response()->json([
            'blogs' => $blogs,
            'success' => true
        ]);
    }

    return view('blog', compact('blogs'));
    }

    public function blogDetails($id)
    {
        // Retrieve the specific blog
        $blog = Blog::findOrFail($id);

        // Fetch latest blogs for the "Latest Posts" section
        $latestBlogs = Blog::orderBy('date', 'desc')->take(5)->get();

        return view('blog-details', compact('blog', 'latestBlogs'));
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
            'name' => 'required|max:255',
            'date' => 'required|date',
            'author_name' => 'required|max:255',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
            $validated['image'] = $imagePath;
        }

        $blog = Blog::create($validated);
        return response()->json(['success' => true, 'blog' => $blog]);
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
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'date' => 'required|date',
            'author_name' => 'required|max:255',
            'content' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
            $validated['image'] = $imagePath;
        }

        $blog->update($validated);
        return response()->json(['success' => true, 'blog' => $blog]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return response()->json(['success' => true]);
    }
}
