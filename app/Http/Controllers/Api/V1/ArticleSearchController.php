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
        $search = mb_strtolower($request->input('search'));

        $articles = Article::query()
            ->where('description', 'like','%' . $search . '%')
            ->get();

        $descExp = $articles
            ->map(function ($article) use ($search) {
                $test = [];
                $oprIndex = [];
                $descExp  = explode(' ', $article->description);
                $new = [];
                for ($i = 0; $i < count($descExp); $i++) {
                    $test[] = chop(mb_strtolower($descExp[$i]), ',.');
                    if ($search == chop(mb_strtolower($descExp[$i]), ',.')) {
                        $oprIndex[] =  "<b>" . chop($descExp[$i], ',.') . "</b>";

                    } else {
                        $oprIndex[] =  $descExp[$i];
                    }
                }
                $startIndex =  array_search($search, $test);
                if (!$startIndex && $startIndex !== 0) {
                    return false;
                }
                if ($startIndex < 50) {
                    $new = array_slice($oprIndex, $startIndex, 30);
                } else {
                    $new =  array_slice($oprIndex, $startIndex - 10, 30);
                }
                $implodeDesc = implode(" ", $new);
                $res = [
                    'id' => $article->id,
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
                    'count_comments' => count($article->comments),
                    'title' => '...' . $implodeDesc . '...',
                ];
                return $res;
        });

        $result = [];
        foreach ($descExp as $item) {
            if ($item) {
                $result[] = $item;
            }
        }
        return response()->json($result);
    }
}


//
//$descExp = $articles
//    ->map(function ($article) use ($search) {
//        $test = [];
//        $descExp  = explode(' ', $article->description);
//        $new = [];
//        for ($i = 0; $i < count($descExp); $i++) {
//            $test[] = chop(mb_strtolower($descExp[$i]), ',.');
//            $startIndex =  array_search($search, $test);
//        }
//
//        if (!$startIndex) {
//            return false;
//        }
//
//        $min = count($test) - $startIndex;
//
//        if ($min < 50) {
//            $new[] = array_slice($test, $startIndex);
//        }
//        $new[] = [ array_slice($test, $startIndex, 50) ];
//        $res = [
//            'id' => $article->id,
//            'title' => $article->title,
//            'dir' => $article->dir,
//            'likes_count' => $article->likes_count,
//            'photo' => $article->photo,
//            'created_at' => $article->created_at,
//            'category_name'=> $article->category->name,
//            'creator' => [
//                'id' => $article->creator->id,
//                'photo' => $article->creator->photo,
//                'name' => $article->creator->name,
//            ],
//            'count_comments' => count($article->comments),
//            'test' => $test,
//            'startIndex' => $startIndex
//        ];
//        return $new;
//    });
