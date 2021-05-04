<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCreateRequest;
use Illuminate\Http\Request;


class ArticleController extends Controller
{

    public function index()
    {
        return response()->json(['res' => 'index']);
    }

    public function store(ArticleCreateRequest $request)
    {

        $validated = $request->validated();
        $res = [];
        if ($validated) {
            $res = ['dasd' => 'das'];
        }

        return response()->json(['val' => $validated, 'res' => $res, $request->all()]);
//        return response()->json(['res' => 'store']);

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
