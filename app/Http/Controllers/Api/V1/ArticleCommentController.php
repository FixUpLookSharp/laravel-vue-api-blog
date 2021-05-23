<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCommentRequest;
use App\Http\Requests\ArticleCommentUpdateRequest;
use App\Models\ArticleComment;
use App\Models\Article;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class ArticleCommentController extends Controller
{
    public function index(Request $request)
    {
        $article_id = $request->input('article_id');
        $limit = 4;
        $loadMore = $request->input('lenght') + $limit;



        $comments = ArticleComment::query()
            ->where('article_id', $article_id)
            ->limit($loadMore)
            ->get();

        if ($loadMore >= ArticleComment::all()->count()) {
            return response()->json([
                'allComment' => true,
                'message' => 'Все коментарии загружены',
                ]);
        }

        $newComments = [];

        foreach ($comments as $comment) {
            $newComments[] =
                [
                    'id' => $comment->id,
                    'content' => $comment->content,
                    'created_at' => $comment->created_at,
                    'creator' =>
                        [
                            'id' => $comment->creator->id,
                            'name' => $comment->creator->name,
                            'photo' => $comment->creator->photo
                        ]
                ];
        }

        return response()->json($newComments);
    }

    public function show($dir)
    {
        $article_id = Article::query()->where('dir', $dir)->value('id');
        $comments = ArticleComment::query()
            ->where('article_id', $article_id)
            ->orderByDesc('created_at')
            ->limit(4)
            ->get();

        $newComments = [];

        foreach ($comments as $comment) {
            $newComments[] =
                [
                    'id' => $comment->id,
                    'content' => $comment->content,
                    'created_at' => $comment->created_at,
                    'creator' =>
                        [
                            'id' => $comment->creator->id,
                            'name' => $comment->creator->name,
                            'photo' => $comment->creator->photo
                        ]
                ];
        }


        return response()->json(array_reverse($newComments),200);
    }

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

        $res =
            [
                'id' => $newComment->id,
                'content' => $newComment->content,
                'created_at' => $newComment->created_at,
                'creator' =>
                    [
                        'id' => $newComment->creator->id,
                        'name' => $newComment->creator->name,
                        'photo' => $newComment->creator->photo
                    ]
            ];

        return response()->json($res, 200);
    }

    public function update(ArticleCommentUpdateRequest $request, $id)
    {
        $comment = ArticleComment::findOrfail($id);
        $content = $request->input('content');

        $comment->content = $content;
        $comment->save();

        return response()->json($comment, 201);
    }

    public function destroy($id)
    {
        $comment = ArticleComment::findOrfail($id);

        try {
            $comment->delete();
        } catch (\Exception $e) {
            return response()->json(["message" => "Error"]);
        }

        return response()->json('Коментарий удален');


    }
}
