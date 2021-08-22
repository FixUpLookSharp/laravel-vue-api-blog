<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCommentRequest;
use App\Http\Requests\ArticleCommentUpdateRequest;
use App\Models\ArticleComment;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $allComments = $loadMore - ArticleComment::query()->where('article_id', $article_id)->count();

        if ($allComments == $limit) {
            return response()->json([
                'allComment' => true,
                'message' => 'Все коментарии загружены',
                'all' => ArticleComment::query()->where('article_id', $article_id)->count()
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

        $loadButton = false;
        if (ArticleComment::query()->where('article_id', $article_id)->count() > 4) {
            $loadButton = true;
        }


        return response()->json(['newComments' => array_reverse($newComments), 'loadButton' => $loadButton,],200);
    }

    public function store(ArticleCommentRequest $request)
    {

        $creator_id = Auth::guard()->user()->id;
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

    public function update(ArticleCommentUpdateRequest $request, ArticleComment $comment)
    {
        $this->authorize('update', [self::class, $comment]);

        $content = $request->input('content');

        $comment->content = $content;
        $comment->save();

        return response()->json($comment, 201);
    }

    public function destroy(ArticleComment $comment)
    {
        $this->authorize('delete', [self::class, $comment]);


        try {
            $comment->delete();
        } catch (\Exception $e) {
            return response()->json(["message" => "Error"]);
        }

        return response('',204);


    }
}
