<?php

namespace App\Http\Controllers;

use App\Model\Menu;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $withData=[];

    public function __construct(){

    }

    public function common(){
        $user = $this->getCurrentUser();
        $menu = $this->getMenu();
        $this->withData = [
            'username' => $user->name,
            'headimg' => $user->headimg,
            'menu' => $menu,
        ];
    }

    public function getCurrentUser(){
        //获取用户信息
        return $user = Auth()->user();
    }

    public function getMenu(){
        //获取菜单
        $menuModel = new Menu();
        $menu =$menuModel->getMenu()->toArray();
        $menu = array_column($menu, NULL, 'id');
        foreach($menu as $k => &$m){
            if($m['pid'] != 0){
                $menu[$m['pid']]['childmenu'][] = $m;
                unset($menu[$k]);
            }
        }
        return $menu;
    }
}
