<?php

namespace App\Presenters;

use \Identicon\Identicon;

trait CommentsIconPresenter
{
    public function getAuthorIconAttribute ()
    {   
        $name = $this->name;
        $icon = new Identicon();
        return $icon->getImageDataUri($name);
    }
}