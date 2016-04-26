<?php

namespace App\View\Cell;

use Cake\View\Cell;

class NavCell extends Cell
{
    public function display($isAuth){
        if($isAuth != null && $isAuth){
        	$this->template = 'registered';
        }else{
        	$this->template = 'noregistered';
        }
    }
}