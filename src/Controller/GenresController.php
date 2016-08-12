<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Genres Controller
 *
 * @property \App\Model\Table\GenresTable $Genres
 */
class GenresController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $genres = $this->Genres->find()->all();
        $this->set(compact('genres'));
    }

    /**
     * View method
     *
     * @param string|null $id Genre id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $genre = $this->Genres->find()->where(['Genres.id' => $id])->first();
        $this->set(compact('genre'));
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $data = [
            'name' => 'Xtreme'
        ];

        $genre = $this->Genres->newEntity($data);
        debug($this->Genres->save($genre)); die('end add');
                if($this->request->is('post')){
                   if($this->Genres->save($genre)){
                         $this->Flash->success(__('The genre has been saved.'));
                          return $this->redirect(['action' => 'index']);
                    }
                    else{
                        $this->Flash->success(__('There was an error while saving the genre..'));
                        return $this->redirect(['action' => 'index']);
                    }
                } 
    }

    /**
     * Edit method
     *
     * @param string|null $id Genre id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
            $genre = $this->Genres->find()->where(['Genres.id' => $id])->first();
            if (!empty($genre) && $this->request->is(['patch', 'post', 'put'])) {
                $genre = $this->Genres->patchEntity($genre, $this->request->data);
                if ($this->Genres->save($genre)) {
                    $this->Flash->success(__('The genre has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The genre could not be saved. Please, try again.'));
                }
            }
            $this->set(compact('genre'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Genre id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $genre = $this->Genres->find()->where(['Genres.id' => $id])->first();
        if ($this->Genres->delete($genre)) {
            $this->Flash->success(__('The genre has been deleted.'));
        } else {
            $this->Flash->error(__('The genre could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
