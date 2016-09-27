<?php

namespace App\View\Cell;

use Cake\View\Cell;

class DateTimeCell extends Cell
{
    public function display($type, $data){
        $this->set('data', $data);
        switch ($type) {
        	case 'date':
        		$this->template = 'date';
        		break;
            case 'date-jp':
                $this->template = 'dateJp';
                break;
            case 'datetime':
                $this->template = 'datetime';
                break;
            case 'year':
                $this->template = 'year';
                break;
        	default:
        		break;
        }
    }
}