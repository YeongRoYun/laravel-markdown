<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Response;


class DocsController extends Controller
{
    protected $docs;

    public function __construct(\App\Models\Documentation $docs)
    {
        $this->docs = $docs;
    }

    public function show(?string $file = null): Response
    {
        // Etag 확인
        $request = request();
        $reqEtags = $request->getETags();
        $file = $file ?: "installation.md";
        $genEtag = $this->docs->etag($file);
        if (in_array($genEtag, $reqEtags)) {
            return response('', 304);
        }
        // Cache 적용 X
//        $index = markdown($this->docs->get());
//        $content = markdown($this->docs->get($file ?: "installation.md"));
        // Cache 적용 O
        $index = Cache::remember("docs.index", 120, function () {
            return markdown($this->docs->get());
        });

        $content = Cache::remember("docs.{$file}", 120, function () use ($file) {
            return markdown($this->docs->get($file));
        });

        debug($index);
        debug($content);
//        return Response::view("docs.show", compact("index", "content"));
        $res = new Response(view("docs.show", compact("index", "content")));
        $res->header("Etag", $genEtag);
        return $res;
    }
}
