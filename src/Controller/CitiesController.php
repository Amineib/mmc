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

    public function add()
    {
        $data = [
            'name' => 'Salamika',
            'country' => [
                    'id' => 48
            ]
        ];

        $city = $this->Cities->newEntity($data, [
                        'associated' => ['Countries' => [
                                             'accessibleFields' => ['id' => true]
                        ]]
                ]);
        //debug($this->Cities->save($city)); die('end add');
                if($this->request->is('post')){
                   if($this->Cities->save($city)){
                         $this->Flash->success(__('The city has been saved.'));
                          return $this->redirect(['action' => 'index']);
                    }
                    else{
                        $this->Flash->success(__('There was an error while saving the city..'));
                        return $this->redirect(['action' => 'index']);
                    }
                } 
    }   

    public function edit(){
            $city = $this->Cities->find()->where(['Cities.id' => $id])->first();
            if (!empty($city) && $this->request->is(['patch', 'post', 'put'])) {
                $city = $this->Cities->patchEntity($city, $this->request->data);
                if ($this->Cities->save($city)) {
                    $this->Flash->success(__('The city has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The city could not be saved. Please, try again.'));
                }
            }
            $this->set(compact('city'));
    }

    public function delete(){
       $city = $this->Cities->find()->where(['Cities.id'=>$id])->first();
      if(!empty($city) && $this->Cities->delete($city))
      {
                $this->Flash->set('City deleted successfully.', [
            'element' => 'success'
        ]);
                die('not empty');
                //$this->redirect($this->refer());
      }
      else
      {
              $this->Flash->set('There was an unexpected error..', [
                'element' => 'error'
            ]);
              die('empty');
              //$this->redirect($this->refer());
      }
    } 
}
