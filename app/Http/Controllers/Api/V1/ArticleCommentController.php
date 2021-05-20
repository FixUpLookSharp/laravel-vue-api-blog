<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCommentRequest;
use App\Models\ArticleComment;
class ArticleCommentController extends Controller
{

    public function store(ArticleCommentRequest $request)
    {
        $creator_id = $request->input('creator_id');
        $article_id = $request->input('article_id');
        $content = $request->input('content');

        $newComment = new ArticleComment();

        $newComment->creator_id = $creator_id;
        $newComment->article_id = $article_id;
        $newComment->content = $content;
        $newComment->save();

        return response()->json($newComment, 200);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
