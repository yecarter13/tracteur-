<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(string $page)
    {
        $views = ['delivery', 'returns', 'privacy', 'terms', 'warranty', 'about'];

        if (!in_array($page, $views)) {
            abort(404);
        }

        return view('pages.' . $page);
    }
}