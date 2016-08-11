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

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $countries = $this->paginate($this->Countries);
        $this->set(compact('countries'));
        $this->set('_serialize', ['countries']);
    }

    /**
     * View method
     *
     * @param string|null $id Country id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $country = $this->Countries->find()->contain(['Cities'])->where(['Countries.id'=>$id])->first();
        debug($country); die();

        $this->set('country', $country);
        $this->set('_serialize', ['country']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */     
    public function add()
    {
        $data = [
                    'name' => 'Morocco',
                    'cities' => [
                                    ['name' => 'Meknes'],
                                    ['name' => 'Rabat'],
                                    ['name' => 'Casablanca']
                                ]
                ];
              $country = $this->Countries->newEntity($data, [
                        'associated' => ['Cities']
                ]);
                if($this->request->is('post')){
                   if($this->Countries->save($country)){
                         $this->Flash->success(__('The country has been saved.'));
                          return $this->redirect(['action' => 'index']);
                    }
                    else{
                        $this->Flash->success(__('There was an error while saving the band..'));
                        return $this->redirect(['action' => 'index']);
                    }
                } 
                  
    }

    /**
     * Edit method
     *
     * @param string|null $id Country id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $country = $this->Countries->find()->where(['Countries.id' => $id])->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $country = $this->Countries->patchEntity($country, $this->request->data);
            if ($this->Countries->save($country)) {
                $this->Flash->success(__('The country has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The country could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('country'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Country id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $country = $this->Countries->find()->where(['Countries.id'=>$id])->first();
      if(!empty($country) && $this->Countries->delete($country))
      {
                $this->Flash->set('Country deleted successfully.', [
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
