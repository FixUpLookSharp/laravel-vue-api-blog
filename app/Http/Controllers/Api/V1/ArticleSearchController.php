<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleCategory;


class ArticleSearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $articles = Article::query()
            ->where('title', 'like', $search . '%')
            ->get();

       $res = $articles->map(function ($article) {
           $res = [
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

           return $res;
        });
        return response()->json($res);
    }
    public function category(Request $request, $dir)
    {
        $search = $request->input('search');

        $categoryId = ArticleCategory::query()
            ->where('dir', '=', $dir)
            ->value('id');

        $articles  = Article::query()
            ->where('category_id', $categoryId)
            ->where('title', 'like', $search . '%')
            ->get();

        $res = $articles->map(function ($article) {
            $res = [
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

            return $res;
        });
        return response()->json($res);
    }
    public function post(Request $request)
    {
        $search = $request->input('search');

        $articles = Article::query()
            ->where('description', 'like','%' . $search . '%')
            ->get();

        $res = $articles->map(function ($article) {
            $res = [
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

            return $res;
        });

        return response()->json($res);
    }
}
