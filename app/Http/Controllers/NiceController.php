<?php

namespace App\Http\Controllers;

use App\Models\Nice;
use Illuminate\Http\Request;

class NiceController extends Controller
{
    public function store($postId) {
        $user = \Auth::user();
        if (!$user->is_nice($postId)) {
            $user->nice_posts()->attach($postId);
        }
        return back();
    }
    public function destroy($postId) {
        $user = \Auth::user();
        if ($user->is_nice($postId)) {
            $user->nice_posts()->detach($postId);
        }
        return back();
    }

}
