<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Reviews Controller
 *
 * @property \App\Model\Table\ReviewsTable $Reviews
 */
class ReviewsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $reviews = $this->Reviews->find()->order(['Reviews.created' => 'desc'])->all();
        $this->set(compact('reviews'));
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
        $reviews = $this->Reviews->find()->where(['Reviews.id' => $id])->all();
        $this->set('reviews', $reviews);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $data = [
            'description' => 'Lorem ipsum..',
            'album' => [
                    'id' => 1
            ]
        ];

        $review = $this->Reviews->newEntity($data, [
                        'associated' => ['Albums' => [
                                             'accessibleFields' => ['id' => true]
                        ]]
                ]);
        debug($this->Reviews->save($review)); die('end add');
                if($this->request->is('post')){
                   if($this->Reviews->save($review)){
                         $this->Flash->success(__('The review has been saved.'));
                          return $this->redirect(['action' => 'index']);
                    }
                    else{
                        $this->Flash->success(__('There was an error while saving the review..'));
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
        $review = $this->Reviews->find()->where(['Reviews.id' => $id])->first();
            if (!empty($review) && $this->request->is(['patch', 'post', 'put'])) {
                $review = $this->Reviews->patchEntity($review, $this->request->data);
                if ($this->Networks->save($network)) {
                    $this->Flash->success(__('The review has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The review could not be saved. Please, try again.'));
                }
            }
            $this->set(compact('review'));
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
      $review = $this->Reviews->find()->where(['Reviews.id'=>$id])->first();
      if(!empty($review) && $this->Reviews->delete($review))
      {
                $this->Flash->set('Reviey deleted successfully.', [
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
