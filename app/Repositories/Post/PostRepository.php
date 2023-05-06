<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Models\User;

use Illuminate\Support\Facades\Storage;

class PostRepository implements PostRepositoryInterface
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getAll()
    {
        return $this->post
            ->withCount('comments', 'nices')
            ->with('user', 'comments', 'nices')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function getWithSearch(int $search)
    {
        return $this->post
            ->where('money', '>=', $search)
            ->withCount('comments', 'nices')
            ->with('user', 'comments', 'nices')
            ->orderBy('created_at', 'desc')
            ->paginate(9);
    }

    public function getById(int $id)
    {
        return $this->post->findOrFail($id);
    }

    public function create(array $data)
    {
        if (isset($data['image'])) {
            $path = Storage::disk('s3')->putFile('image', $data['image']);
            $data['image'] = Storage::disk('s3')->url($path);
        }

        return $this->post->create($data);
    }

    public function update(Post $post, array $data)
    {
        if (isset($data['image'])) {
            $path = Storage::disk('s3')->putFile('image', $data['image']);
            $data['image'] = Storage::disk('s3')->url($path);
        }

        return $post->update($data);
    }

    public function delete(Post $post)
    {
        return $post->delete();
    }
}
