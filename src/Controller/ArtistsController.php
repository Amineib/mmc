<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Artists Controller
 *
 * @property \App\Model\Table\ArtistsTable $Artists
 */
class ArtistsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $artists = $this->paginate($this->Artists);

        $this->set(compact('artists'));
        $this->set('_serialize', ['artists']);
    }

    /**
     * View method
     *
     * @param string|null $id Artist id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $artist = $this->Artists->find()->contain(['Bands'])->where(['Artists.id'=>$id])->first();
        $this->set('artist', $artist);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
         $data = [
                      'name' => 'Soufiane El Haloui',
                      'description' => '0',
                      'bands' => 
                      [
                          [
                            'name' => 'MuhBand', //we create a new record {artist}
                            'active' => 1,
                            'formed' => 2010,
                            '_joinData' => [
                                'instrument' => 'vocals',
                                'joined' => '2011'
                            ]
                          ],
                          [
                            'id' => 118, //existing record
                            '_joinData' => [
                                  'instrument' => 'vocals',
                                  'joined' => '2011'
                              ]
                          ]
                      ]
                  ];
                   $artist = $this->Artists->newEntity($data, [
                        'associated' => ['Bands._joinData']
              ]);
                   debug($this->Artists->save($artist)); die('ok');
        if ($this->request->is('post')) {
            $artist = $this->Artists->newEntity($data, [
                        'associated' => ['Bands._joinData']
              ]);
            if ($this->Artists->save($artist)) {
                $this->Flash->success(__('The artist has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add the artist.'));
        }
        $this->set('artist', $artist);
    }

    /**
     * Edit method
     *
     * @param string|null $id Artist id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $artist = $this->Artists->get($id, [
            'contain' => ['Bands']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $artist = $this->Artists->patchEntity($artist, $this->request->data);
            if ($this->Artists->save($artist)) {
                $this->Flash->success(__('The artist has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The artist could not be saved. Please, try again.'));
            }
        }
        $bands = $this->Artists->Bands->find('list', ['limit' => 200]);
        $this->set(compact('artist', 'bands'));
        $this->set('_serialize', ['artist']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Artist id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $artist = $this->Artists->get($id);
        if ($this->Artists->delete($artist)) {
            $this->Flash->success(__('The artist has been deleted.'));
        } else {
            $this->Flash->error(__('The artist could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function unlink($idArtist, $idBand){
        $artist = $this->Artists->find()->where(['Artists.id' => $idArtist])->first();
        $band = $this->Artists->Bands->find()->where(['Bands.id' => $idBand])->toArray();

        $this->Artists->Bands->unlink($artist,$band);
        die();
    }
}
