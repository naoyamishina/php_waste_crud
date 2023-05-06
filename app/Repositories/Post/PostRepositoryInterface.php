<?php

namespace App\Repositories\Post;

use App\Models\Post;

interface PostRepositoryInterface
{
    public function getAll();
    public function getWithSearch(int $search);
    public function create(array $data);
    public function update(Post $post, array $data);
    public function delete(Post $post);
}
