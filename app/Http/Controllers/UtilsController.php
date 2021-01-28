<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilsController extends Controller
{
    public static function template_code($request)
    {
        $template = $request['template'];
        return view("$template", $request)->renderSections();
    }

}
