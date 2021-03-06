<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Networks Controller
 *
 * @property \App\Model\Table\NetworksTable $Networks
 */
class NetworksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $networks = $this->Networks->find()->order(['Networks.name' => 'asc'])->all();
        $this->set(compact('networks'));
    }

    /**
     * View method
     *
     * @param string|null $id Network id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $city = $this->Cities->find()->where(['Cities.id' => $id])->all();
        $this->set('city', $city);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $data = [
            'type' => 'facebook',
            'link' => 'some link',
            'band' => [
                    'id' => 136
            ]
        ];

        $network = $this->Networks->newEntity($data, [
                        'associated' => ['Bands' => [
                                             'accessibleFields' => ['id' => true]
                        ]]
                ]);
        debug($this->Networks->save($network)); die('end add');
                if($this->request->is('post')){
                   if($this->Networks->save($network)){
                         $this->Flash->success(__('The network has been saved.'));
                          return $this->redirect(['action' => 'index']);
                    }
                    else{
                        $this->Flash->success(__('There was an error while saving the network..'));
                        return $this->redirect(['action' => 'index']);
                    }
                } 
    }

    /**
     * Edit method
     *
     * @param string|null $id Network id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $network = $this->Networks->find()->where(['Networks.id' => $id])->first();
            if (!empty($network) && $this->request->is(['patch', 'post', 'put'])) {
                $network = $this->Networks->patchEntity($network, $this->request->data);
                if ($this->Networks->save($network)) {
                    $this->Flash->success(__('The network has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The network could not be saved. Please, try again.'));
                }
            }
            $this->set(compact('network'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Network id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        //to be reimplemented in ajax.
      $network = $this->Networks->find()->where(['Networks.id'=>$id])->first();
      if(!empty($network) && $this->Networks->delete($network))
      {
                $this->Flash->set('network deleted successfully.', [
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
      }
    }
}
