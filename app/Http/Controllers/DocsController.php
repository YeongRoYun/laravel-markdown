<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DocsController extends Controller
{
    protected $docs;

    public function __construct(\App\Models\Documentation $docs)
    {
        $this->docs = $docs;
    }

    public function show(?string $file = null): View
    {
        $index = markdown($this->docs->get());
        $content = markdown($this->docs->get($file ?: "installation.md"));
        debug($index);
        debug($content);
        return view("docs.show", compact("index", "content"));
    }
}
