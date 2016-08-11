<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Songs Controller
 *
 * @property \App\Model\Table\SongsTable $Songs
 */
class SongsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $songs = $this->Songs->find()->order(['Reviews.name' => 'asc'])->all();
        $this->set(compact('songs'));
    }

    /**
     * View method
     *
     * @param string|null $id Review id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $songs = $this->Songs->find()->where(['Songs.id' => $id])->all();
        $this->set('songs', $songs);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $data = [
            'title' => 'song1',
            'album' => [
                    'id' => 1
            ]
        ];

        $song = $this->Songs->newEntity($data, [
                        'associated' => ['Albums' => [
                                             'accessibleFields' => ['id' => true]
                        ]]
                ]);
        debug($this->Songs->save($song)); die('end add');
                if($this->request->is('post')){
                   if($this->Songs->save($song)){
                         $this->Flash->success(__('The song has been saved.'));
                          return $this->redirect(['action' => 'index']);
                    }
                    else{
                        $this->Flash->success(__('There was an error while saving the song..'));
                        return $this->redirect(['action' => 'index']);
                    }
                } 
    }

    /**
     * Edit method
     *
     * @param string|null $id Review id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $song = $this->Songs->find()->where(['Songs.id' => $id])->first();
            if (!empty($song) && $this->request->is(['patch', 'post', 'put'])) {
                $song = $this->Songs->patchEntity($song, $this->request->data);
                if ($this->Songs->save($song)) {
                    $this->Flash->success(__('The song has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The song could not be saved. Please, try again.'));
                }
            }
            $this->set(compact('song'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Review id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        //to be reimplemented in ajax.
      $song = $this->Songs->find()->where(['Songs.id'=>$id])->first();
      if(!empty($song) && $this->Songs->delete($song))
      {
                $this->Flash->set('Song deleted successfully.', [
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
