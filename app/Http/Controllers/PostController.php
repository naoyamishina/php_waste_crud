<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use InterventionImage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Post::query();

        // もし検索フォームにキーワードが入力されたら
        if(!empty($keyword)) {
            $query->where('money', '>=', $keyword);
        }
        $posts = $query->with('user')->orderBy('created_at', 'desc')->paginate(10);

        $user=auth()->user();
        return view('post.index', compact('posts', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs=$request->validate([
            'title'=>'required|max:255',
            'body'=>'required|max:1000',
            'image'=>'image|max:1024',
            'money'=>'integer|required|min:0'
        ]);
        $post=new Post();
        $post->title=$request->title;
        $post->money=$request->money;
        $post->body=$request->body;
        $post->user_id=auth()->user()->id;
        if (request('image')){
            if (app()->isLocal()) {
                // ローカル環境
                $time = date("Ymdhis");
                $image = InterventionImage::make($request->image);
                $image->orientate();
                $image->resize(
                    400,
                    500,
                    function ($constraint) {
                        // 縦横比を保持したままにする
                        $constraint->aspectRatio();
                        // 小さい画像は大きくしない
                        $constraint->upsize();
                    }
                );
                $filePath = storage_path('app/public/images');
                $image->save($filePath.'/'.$time.'_'.Auth::user()->id.'.png');
                $imagePath = 'storage/images/'.$time.'_'.Auth::user()->id.'.png';
                $post->image = $imagePath;
            } else {
                // 本番環境
                $image = $request->file('image');
                $path = Storage::disk('s3')->putFile('/', $image);
                $post->image = $path;
            }
        }
        $post->save();
        return redirect()->route('post.index')->with('message', '投稿を作成しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.show', [
            'post' => $post,
            'image' => str_replace('public/', 'storage/', $post->image) // 変更
        ],
        compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('post.edit', [
            'post' => $post,
            'image' => str_replace('public/', 'storage/', $post->image) // 変更
        ],
        compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $inputs=$request->validate([
            'title'=>'required|max:255',
            'body'=>'required|max:1000',
            'image'=>'image|max:1024',
            'money'=>'integer|required|min:0'
        ]);

        $post->title=$inputs['title'];
        $post->body=$inputs['body'];
        $post->money=$request->money;
                
        if(request('image')){
            if (app()->isLocal()) {
                // ローカル環境
                // ローカル環境
                $time = date("Ymdhis");
                $image = InterventionImage::make($request->image);
                $image->orientate();
                $image->resize(
                    400,
                    500,
                    function ($constraint) {
                        // 縦横比を保持したままにする
                        $constraint->aspectRatio();
                        // 小さい画像は大きくしない
                        $constraint->upsize();
                    }
                );
                $filePath = storage_path('app/public/images');
                $image->save($filePath.'/'.$time.'_'.Auth::user()->id.'.png');
                $imagePath = 'storage/images/'.$time.'_'.Auth::user()->id.'.png';
                $post->image = $imagePath;
            } else {
                // 本番環境
                $image = $request->file('image');
                $path = Storage::disk('s3')->putFile('/', $image);
                $post->image = $path;
            }
        }

        $post->save();

        return redirect()->route('post.show', $post)->with('message', '投稿を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('post.index')->with('message', '投稿を削除しました');
    }

    public function mypost(Request $request) {
        $keyword = $request->input('keyword');
        $query = Post::query();

        // もし検索フォームにキーワードが入力されたら
        if(!empty($keyword)) {
            $query->where('money', '>=', $keyword);
        }

        $user=auth()->user()->id;
        $posts = $query->where('user_id', $user)->with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('post.mypost', compact('posts', 'user'));
    }
}
