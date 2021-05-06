<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCreateRequest;
use Illuminate\Http\Request;
use App\Models\Article;
use App\helpers\MyHelper;
use Illuminate\Support\Facades\Auth;


class ArticleController extends Controller
{

    public function index()
    {
        return response()->json(Article::paginate(10));
    }

    public function store(ArticleCreateRequest $request)
    {
        $article = new Article();

        $creator_id = $request->input('creator_id');
        $title = $request->input('title');
        $category_id = $request->input('category_id');
        $short_description = $request->input('short_description');
        $description = $request->input('description');

        if ($request->file()) {
            $photo = $request->file('photo')->store('post', 'public');
        }

        $dir = MyHelper::translit_file($request->input('title'));

        $article->category_id = $category_id;
        $article->creator_id = $creator_id;
        $article->title = $title;
        $article->short_description = $short_description;
        $article->description = $description;
        $article->photo = $photo;
        $article->dir = $dir;
        $article->save();

        return response()->json(Auth::user(), 200);

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
