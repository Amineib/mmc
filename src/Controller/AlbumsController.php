<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Albums Controller
 *
 * @property \App\Model\Table\AlbumsTable $Albums
 */
class AlbumsController extends AppController
{

    public function index(){
       $albums = $this->Albums->find()->order(['name'=>'asc'])->all();
       $this->set(compact('$albums'));
    }

    public function view($id = null)
    {
        $album = $this->Albums->find()->where(['Album.id' => $id])->all();
        $this->set(compact('$album'));
    }

    public function add(){
    	$data = [
            'name' => 'Evilution',
            'band' => [
                    'id' => 136
            ]
        ];

        $album = $this->Albums->newEntity($data, [
                        'associated' => ['Bands' => [
                                             'accessibleFields' => ['id' => true]
                        ]]
                ]);
        debug($this->Albums->save($album)); die('end add');
                if($this->request->is('post')){
                   if($this->Albums->save($album)){
                         $this->Flash->success(__('The album has been saved.'));
                          return $this->redirect(['action' => 'index']);
                    }
                    else{
                        $this->Flash->success(__('There was an error while saving the album..'));
                        return $this->redirect(['action' => 'index']);
                    }
                } 
    }
    

    public function edit(){
    	$album = $this->Albums->find()->where(['Albums.id' => $id])->first();
            if (!empty($album) && $this->request->is(['patch', 'post', 'put'])) {
                $album = $this->Albums->patchEntity($album, $this->request->data);
                if ($this->Albums->save($album)) {
                    $this->Flash->success(__('The Album has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The Album could not be saved. Please, try again.'));
                }
            }
            $this->set(compact('album'));
    }


    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $album = $this->Albums->get($id);
        if ($this->Albums->delete($album)) {
            $this->Flash->success(__('The album has been deleted.'));
        } else {
            $this->Flash->error(__('The album could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
