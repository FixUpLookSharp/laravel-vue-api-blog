<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCreateRequest;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Helpers\MyHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ArticleController extends Controller
{

    public function index(Request $request)
    {
        $articles = Article::all()->map(function ($article) {
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

        $page = $request->input('page');

        return response()->json(MyHelper::getPaginator($articles, 8, $page), 200);
    }

    public function show($title)
    {
        $article = Article::query()->where('dir', '=', $title)->first();

        $newArticle = [
            'id' => $article->id,
            'title' => $article->title,
            'likes_count' => $article->likes_count,
            'photo' => $article->photo,
            'created_at' => $article->created_at,
            'category_name'=> $article->category->name,
            'category_dir'=> $article->category->dir,
            'description' => $article->description,
            'dir' => $article->dir,
            'creator' => [
                'id' => $article->creator->id,
                'photo' => $article->creator->photo,
                'name' => $article->creator->name,
            ],
            'count_comments' => count($article->comments)
        ];

        if ($newArticle) {
            return response()->json($newArticle, 200);
        }

        return response()->json(['error' => '?????????????????????????? ???????? ???? ????????????????????'], 404);
    }

    public function store(ArticleCreateRequest $request)
    {
        $article = new Article();

        $creator_id = Auth::guard()->user()->id;
        $title = $request->input('title');
        $category_id = $request->input('category_id');
        $description = $request->input('description');

        if ($request->file()) {
            $photo = Image::make($request->file('photo'))->resize(710, 399)->save('storage/post/' . Str::random(40) . '.jpg');
        }

        $dir = MyHelper::translit_file($request->input('title'));

        if (isset($photo)) {
            $article->photo = 'post/' . $photo->filename . '.jpg';
        }

        $article->category_id = $category_id;
        $article->creator_id = $creator_id;
        $article->title = $title;
        $article->description = $description;
        $article->dir = $dir;
        $article->save();

        return response()->json($article, 200);

    }

    public function update(Request $request, $id)
    {
        return ['ewrew' => 'qewe'];
    }

    public function destroy($id)
    {
        //
    }


}
