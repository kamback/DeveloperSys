<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function getMenu(){
        $menu = Menu::get();
        return $menu;
    }
}
