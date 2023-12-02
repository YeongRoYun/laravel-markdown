<?php

namespace App\Models;

use Illuminate\Support\Facades\File;

class Documentation
{
    public function get(string $file = "documentation.md")
    {
        $content = File::get($this->path($file));
        return $this->replaceLinks($content);
    }

    protected function path(string $file): string
    {
        $file = str_ends_with($file, ".md") ? $file : $file . ".md";
        $path = base_path("docs" . DIRECTORY_SEPARATOR . $file);


        if (!File::exists($path)) {
            abort(404, "요청한 파일이 없습니다");
        }
        return $path;
    }

    protected function replaceLinks(string $content): string
    {
        return str_replace("/docs/{{version}}", "/docs", $content);
    }

    public function etag(string $file): string {
        $lastModified = File::lastModified($this->path($file));
        return md5($file, $lastModified);
    }
}
