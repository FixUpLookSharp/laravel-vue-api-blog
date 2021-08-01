<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Article;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function topPost()
    {
        $articles = Article::query()->orderByDesc('likes_count')->limit(3)->get();

        $res = [];

        foreach ($articles as $article) {
            $res[] = [
                'id' => $article->id,
                'title' => $article->title,
                'dir' => $article->dir,
                'likes_count' => $article->likes_count,
                'photo' => $article->photo,
                'created_at' => $article->created_at,
                'category_name'=> $article->category->name,
                'creator' => [
                    'id' => $article->creator->id,
                    'photo' => $article->creator->photo,
                    'name' => $article->creator->name,
                ],
                'count_comments' => count($article->comments)
            ];
        }

        return response()->json($res, 200);
    }

    public function randomPost()
    {
        $articles = Article::query()->inRandomOrder()->limit(3)->get();

        $res = [];

        foreach ($articles as $article) {
            $res[] = [
                'id' => $article->id,
                'title' => $article->title,
                'dir' => $article->dir,
                'likes_count' => $article->likes_count,
                'photo' => $article->photo,
                'created_at' => $article->created_at,
                'category_name'=> $article->category->name,
                'creator' => [
                    'id' => $article->creator->id,
                    'photo' => $article->creator->photo,
                    'name' => $article->creator->name,
                ],
                'count_comments' => count($article->comments)
            ];
        }

        return response()->json($res, 200);
    }

    public function topWeek()
    {
        $startOfWeek = Carbon::now()->startOfWeek()->addDays(-7);


        $topWeek = User::query()->select(
            'users.id as user_id',
            'users.name as user_name',
            'users.photo as user_photo',
            'article_categories.name as category_name',
            'article_categories.id as category_id',
            'articles.title as article_title',
            'articles.dir as article_dir')
            ->join('articles', function ($join) use ($startOfWeek) {
                $join->on('users.id', 'articles.creator_id')
                ->where('articles.created_at', '>=', $startOfWeek);
            })->join('article_categories', function ($join) {
                $join->on('article_categories.id', 'articles.category_id');
            })
            ->orderByDesc('articles.likes_count')->first();

        if (!$topWeek) {

            $topWeek = User::query()->select(
                'users.id as user_id',
                'users.name as user_name',
                'users.photo as user_photo',
                'article_categories.name as category_name',
                'article_categories.id as category_id',
                'articles.title as article_title',
                'articles.dir as article_dir')
                ->join('articles', function ($join) use ($startOfWeek) {
                    $join->on('users.id', 'articles.creator_id');
                })->join('article_categories', function ($join) {
                    $join->on('article_categories.id', 'articles.category_id');
                })
                ->orderByDesc('articles.likes_count')->first();

            return response()->json(['topWeek' => $topWeek, 'topWeekTitle' => 'ТОП ЗА ВСЕ ВРЕМЯ'], 200);
        }

        return response()->json(['topWeek' => $topWeek, 'topWeekTitle' => 'ТОП ЗА НЕДЕЛЮ'], 200);
    }

    public function recentPosts() {
        $articles = Article::query()->orderByDesc('created_at')->limit(3)->get()->reverse();

        $res = [];

        foreach ($articles as $article) {
            $res[] = [
                'id' => $article->id,
                'title' => $article->title,
                'dir' => $article->dir,
                'likes_count' => $article->likes_count,
                'photo' => $article->photo,
                'created_at' => $article->created_at,
                'category_name'=> $article->category->name,
                'creator' => [
                    'id' => $article->creator->id,
                    'photo' => $article->creator->photo,
                    'name' => $article->creator->name,
                ],
                'count_comments' => count($article->comments)
            ];
        }

        return response()->json($res, 200);
    }
}
