<?php

namespace App\View\Cell;

use Cake\View\Cell;

class NavCell extends Cell
{
    public function display($isAuth, $authedId = null){
    	if(isset($authedId)){
    		$this->loadModel('Companies');
    		$authedCompany = $this->Companies->get($authedId);
    		$this->set('authedCompany', $authedCompany);
    	}
        if($isAuth != null && $isAuth){
        	$this->template = 'registered';
        }else{
        	$this->template = 'noregistered';
        }
    }
}