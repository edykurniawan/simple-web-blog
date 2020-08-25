<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{

    public function index(Request $request)
    {
        // membuat fungsi search
        // $search_q = urldecode($request->input('search'));

        // if (!empty($search_q))
        //     $blogs = Blog::with('tags')->where('title_blog', 'like', '%' . $search_q . '%')->get();
        // else
        $tags = Tag::all();
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(5);

        return view('blogs.index', compact('blogs', 'tags'));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->first();

        if ($blog == null)
            abort(404);

        return view('blogs.show', compact('blog'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('blogs.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title_blog' => 'required|min:5',
            'content_blog' => 'required:min:15',
            'thumbnail_blog' => 'max:2000'
        ]);

        $request->tags = array_diff($request->tags, [0]);
        if (empty($request->tags))
            return redirect('/blog/create')->withInput($request->input())->with('tag_error', 'Tag is required');

        if ($validator->fails()) {
            return redirect('/blog/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // upload file 
            if ($request->hasFile('thumbnail_blog')) {
                $fileName = time() . '.png';
                $request->file('thumbnail_blog')->storeAs('public/blog', $fileName);
            } else {
                $fileName = null;
            }
            $slug = Str::slug($request->title_blog, '-');

            if (Blog::where('slug', $slug)->first() != null);
            $slug = $slug . '-' . time();

            $blog = Blog::create([
                'title_blog' => $request->title_blog,
                'slug' => $slug,
                'thumbnail_blog' => $fileName,
                'content_blog' => $request->content_blog,
                'user_id' => Auth::user()->id
            ]);

            $blog->tags()->attach($request->tags);

            return redirect('/blogs');
        }
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $tags = Tag::all();

        return view('blogs.edit', compact('blog', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title_blog' => 'required|min:5',
            'content_blog' => 'required|min:5'
        ]);

        // $blog = Blog::find($id);
        // $blog->title_blog = $request->title_blog;
        // $blog->content_blog = $request->content_blog;
        // $blog->save();

        // mass assigment
        $blog = Blog::findOrFail($id)->update([
            'title_blog' => $request->title_blog,
            'content_blog' => $request->content_blog,
        ]);

        $blog->tags()->sync($request->tags);

        return redirect('/blogs');
    }

    public function destroy($id)
    {
        Blog::findOrFail($id)->delete();
        return redirect('/blogs');
    }

    public function filter($tag)
    {
        $tags = Tag::all();

        $blogs = Blog::with('tags')->whereHas('tags', function ($query) use ($tag) {
            $query->where('name', $tag);
        })->get();

        return view('blogs.index', compact('blogs', 'tags'));
    }
}
