<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Countries Controller
 *
 * @property \App\Model\Table\CountriesTable $Countries
 */
class CountriesController extends AppController
{
    public function index($id){
        $countries = $this->Countries->find()->select(['nbr_cities'=>$this->Countries->find()->func()->count('Cities.id')])
        ->leftJoinWith('Cities')->group(['Countries.id'])->all();
        debug($countries);die('end');
    }
   
}


