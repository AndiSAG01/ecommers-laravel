<?php

namespace App\Http\View;

use Illuminate\View\View;
use App\Models\Category;

class CategoryComposer
{
    public function compose(View $view)
    {
        $categories = Category::whereNot('name', 'Liquid')->get();
        $view->with('categories', $categories);
    }
}
