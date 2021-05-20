<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\ArticleLikes;
use Illuminate\Support\Facades\Auth;

class ArticleLikeController extends Controller
{
    public function setLike(Article $article)
    {
        $user = Auth::user();
        $like = ArticleLikes::query()
            ->where('article_id', $article->id)
            ->where('user_id', $user->id)
            ->exists();

        if ($like) {
            ArticleLikes::query()
                ->where('article_id', $article->id)
                ->where('user_id', $user->id)
                ->delete();

            $article->likes_count = $article->likes_count - 1;
            $article->save();
            return response()->json(['likes_count' => $article->likes_count, 'status' => false], 200);
        }

        $like = $article->likes()->make();
        $like->creator()->associate($user);
        $like->save();

        $article->likes_count = $article->likes_count + 1;
        $article->save();

        return response()->json(['likes_count' => $article->likes_count, 'status' => true], 200);
    }

    public function getLike($dir)
    {
        $article = Article::query()->where('dir', $dir)->first();

        $user = Auth::user();
        if ($article && $user) {
            $like = ArticleLikes::query()
                ->where('article_id', $article->id)
                ->where('user_id', $user->id)
                ->exists();

            return response()->json($like);
        }


    }
}
