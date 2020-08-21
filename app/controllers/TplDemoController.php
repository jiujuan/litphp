<?php
namespace app\controllers;

class TplDemoController extends BaseController
{
    public function getTpl() {
        echo view()->render('profile', ['name' =>'John']);
    }
}