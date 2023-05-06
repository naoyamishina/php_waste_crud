<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Models\User;
use InterventionImage;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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

    public function create(array $data)
    {
        if (isset($data['image'])) {
          if (app()->isLocal()) {
            // ローカル環境
            $time = date("Ymdhis");
            $image = InterventionImage::make($data['image']);
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
            $data['image'] = $imagePath;
          } else {
              // 本番環境
              $image = $data->file('image');
              $path = Storage::disk('s3')->putFile('/', $image);
              $data['image'] = $path;
          }
        }

        return $this->post->create($data);
    }

    public function update(Post $post, array $data)
    {
      if (isset($data['image'])) {
        if (app()->isLocal()) {
          // ローカル環境
          $time = date("Ymdhis");
          $image = InterventionImage::make($data['image']);
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
          $data['image'] = $imagePath;
        } else {
            // 本番環境
            $image = $data->file('image');
            $path = Storage::disk('s3')->putFile('/', $image);
            $data['image'] = $path;
        }
      }

        return $post->update($data);
    }

    public function delete(Post $post)
    {
      $post->comments()->delete();
      $post->nices()->delete();
      return $post->delete();
    }

    public function getMyPost()
    {
        return $posts = \Auth::user()
              ->posts()
              ->withCount('comments','nices')
              ->orderBy('created_at', 'desc')
              ->with('user', 'comments', 'nices')
              ->paginate(10);
    }

    public function getNicePost()
    {
        return $posts = \Auth::user()
              ->nice_posts()
              ->withCount('comments','nices')
              ->orderBy('created_at', 'desc')
              ->with('user', 'comments', 'nices')
              ->paginate(10);
    }

    public function getRanking()
    {
      return $this->post
            ->withCount('comments','nices')
            ->orderBy('nices_count', 'desc')
            ->with('user', 'comments', 'nices')
            ->paginate(10);
    }
}
