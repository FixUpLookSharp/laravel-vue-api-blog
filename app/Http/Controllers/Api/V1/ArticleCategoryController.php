<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use App\Helpers\MyHelper;
use Illuminate\Http\Request;
use Illuminate\Queue\RedisQueue;

class ArticleCategoryController extends Controller
{

    public function index()
    {
        $categories = ArticleCategory::all();
        $result = [];

        foreach ($categories as $category) {
            $result[] = [
                'id' => $category->id,
                'name' => $category->name,
                'dir' =>$category->dir,
                'articleCount' => count($category->articles),
            ];
        }

        return response()->json($result, 200);
    }

    public function show($dir, Request $request)
    {
        $category = ArticleCategory::query()->where('dir', $dir)->first();

        if (!$category) {
            return response()->json(['error' => 'Запрашиваемый пост не существует'], 404);
        }

        $articles =  $category->articles->map(function ($article) use ($category) {
            $res = [
                'id' => $article->id,
                'title' => $article->title,
                'dir' => $article->dir,
                'likes_count' => $article->likes_count,
                'photo' => $article->photo,
                'created_at' => $article->created_at,
                'category_name'=> $article->category->name,
                'category_dir' => $category->dir,
                'creator' => [
                    'id' => $article->creator->id,
                    'photo' => $article->creator->photo,
                    'name' => $article->creator->name,
                ],
                'count_comments' => count($article->comments)
            ];
            return $res;
        });


        $page = $request->input('page');


        return response()->json(MyHelper::getPaginator($articles, 1, $page),200);
    }
}
