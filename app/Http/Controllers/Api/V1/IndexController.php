<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;

class IndexController extends Controller
{
    public function showCategory()
    {
        $categories = ArticleCategory::all();
        $result = [];

        foreach ($categories as $category) {
            $result[] = [
              'id' => $category->id,
              'name' => $category->name,
              'articleCount' => count($category->articles),
            ];
        }

        return response()->json($result, 200);
    }
}
