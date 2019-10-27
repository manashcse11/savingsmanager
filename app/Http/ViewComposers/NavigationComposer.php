<?php
namespace App\Http\ViewComposers;

use App\Type;

class NavigationComposer
{
    public function compose($view)
    {
        $view->with('types', Type::orderby('name')->get());
    }
}