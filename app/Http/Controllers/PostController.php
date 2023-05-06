<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Nice;
use App\Models\User;
use App\Models\Comment;
use App\Repositories\Post\PostRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use InterventionImage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $posts = $this->postRepository->getWithSearch($search);
        } else {
            $posts = $this->postRepository->getAll();
        }

        return view('post.index', compact('posts'));
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
    public function store(PostRequest $request)
    {
        $inputs = $request->validated();
        $inputs['user_id'] = auth()->user()->id;

        if ($request->file('image')) {
            $inputs['image'] = $request->file('image');
        }
        $this->postRepository->create($inputs);
        
        return redirect()->route('post.index')->with('message', '投稿を作成しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.show', [
            'post' => $post,
            'image' => str_replace('public/', 'storage/', $post->image)
        ],
        compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $user = Auth::user();

        if ($user->can('update', $post)) {
            return view('post.edit', [
                'post' => $post,
                'image' => str_replace('public/', 'storage/', $post->image) // 変更
            ],
            compact('post'));
        }   else {
        return redirect()->route('post.index')->with('errormessage', '編集権限がありません');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $inputs = $request->validated();

        if ($request->file('image')) {
            $inputs['image'] = $request->file('image');
        }

        $this->postRepository->update($post, $inputs);

        return redirect()->route('post.show', $post)->with('message', '投稿を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $this->postRepository->delete($post);
        return redirect()->route('post.index')->with('message', '投稿を削除しました');
    }

    public function mypost() {
        $posts = $this->postRepository->getMyPost();
        return view('post.mypost', compact('posts'));
    }

    public function nice(Request $request){
        $user_id = Auth::user()->id;
        $post_id = $request->post_id; //2.投稿idの取得
        $already_niced = Nice::where('user_id', $user_id)->where('post_id', $post_id)->first(); //3.

        if (!$already_niced) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
            $nice = new Nice; //4.niceクラスのインスタンスを作成
            $nice->post_id = $post_id; //niceインスタンスにpost_id,user_idをセット
            $nice->user_id = $user_id;
            $nice->save();
        } else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
            Nice::where('post_id', $post_id)->where('user_id', $user_id)->delete();
        }
        //5.この投稿の最新の総いいね数を取得
        $post_nices_count = Post::withCount('nices')->findOrFail($post_id)->nices_count;
        $param = [
            'post_nices_count' => $post_nices_count,
        ];
        return response()->json($param); //6.JSONデータをjQueryに返す
    }

    public function nice_posts() {
        $posts = \Auth::user()->nice_posts()->withCount('nices')->orderBy('created_at', 'desc')->with('user', 'comments', 'nices')->paginate(10);
        return view('post.nice_posts', compact('posts'));
    }

    public function ranking() {
        $posts = Post::withCount('nices')->orderBy('nices_count', 'desc')->with('user', 'comments', 'nices')->paginate(10);
        return view('post.ranking', compact('posts'));
    }
}
