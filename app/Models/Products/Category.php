<?php

namespace App\Models\Products;

class Category
{
    public function setData($main, $sub = null)
    {
        if($sub == null):
            $this->id = $main->id;
            $this->main = $main->name;
            $this->sub = '-';
        else:
            $this->id = $sub->id;
            $this->main = $main->name;
            $this->sub = $sub->name;
        endif;
    }

}