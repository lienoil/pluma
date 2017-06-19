<?php

namespace Pluma\Frontier\Support\View;

use Symfony\Component\Config\Definition\Exception\Exception;

trait CheckView
{
    public function view($slug, $hintpath = "")
    {
        if (! view()->exists("{$hintpath}{$slug}")) {
            $slug = $this->fromStatic($slug);
        }

        if ($slug) {
            return view("{$hintpath}{$slug}");
        }

        return abort(404);
    }

    public function fromStatic($slug)
    {
        return view()->exists("Static::$slug") ? view("Static::$slug") : false;
    }
}
