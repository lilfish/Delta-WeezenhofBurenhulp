<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\categorie;

Class homeComposer
{
    public function compose(View $view)
    {
        $allCategories = categorie::all();
        $view->with('allCategories', $allCategories);
    }
}

?>