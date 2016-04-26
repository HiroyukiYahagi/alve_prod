<?php

namespace App\View\Cell;

use Cake\View\Cell;

class FormCell extends Cell
{
    public function display($type, $data){
        
        switch ($type) {
        	case 'login':
        		$this->set('data', $data);
        		$this->template = 'login';
        		break;
        	default:
        		break;
        }

    }
}