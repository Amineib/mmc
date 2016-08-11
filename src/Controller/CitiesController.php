<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Collection\Collection;

/**
 * Cities Controller
 *
 * @property \App\Model\Table\CitiesTable $Cities
 */
class CitiesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
            $this->paginate = [
                'contain' => ['Countries']
            ];
            $cities = $this->paginate($this->Cities);

            $this->set(compact('cities'));
            $this->set('_serialize', ['cities']);
    }

    /**
     * View method
     *
     * @param string|null $id City id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $city = $this->Cities->find()->where(['Cities.id' => $id])->all();
        $this->set('city', $city);
    }

    public function add(){

    }   

    public function edit(){
        
    }

    public function delete(){

    } 
}
