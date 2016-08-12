<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Bands Controller
 *
 * @property \App\Model\Table\BandsTable $Bands
 */
class BandsController extends AppController
{
   /* 
    * Index action: shows all the bands available.
    */
   public function index(){
        $bands = $this->Bands->find()->all();
        $this->set(compact('$bands'));
   }

  /* viewGenre: view bands by genres
   */
  public function viewGenre($genre){
    $options['genre'] = $genre;
    $bands = $this->Bands->find('genre',$options);
    $this->set(compact('$bands'));
  }

  
   /*
    * View action: view details of an article for a given id
      Called method : get
    */
   public function view(){
              if( isset($this->request->query['id']) ) {
                $band = $this->Bands->find()->contain(['Genres','Albums','Networks','Cities'])
                        ->where(['Bands.id'=>$this->request->query['id']])
                        ->first();
                if(empty($band)){
                      die('not found');
                } 
                else{
                  $this->set(compact('band'));
                }               
               
              }
              else{
                //no params found, handle error
                $this->redirect(['action'=>'index']);
              }
   }
   /*
    * Add action : add a new band  
    */
   public function add(){
        
         // We assume data type is like this:
          $data = [
                      'name' => 'Thrillogy',
                      'active' => '0',
                      'formed' => '2013',
                      'description' => 'lorem ipsum..',
                      'artists' => [
                          [
                            'name' => 'Wassim Ahenjir', //we create a new record {artist}
                            'description' => 'lorem ipsum..',
                            '_joinData' => [
                                'instrument' => 'vocals',
                                'joined' => '2011'
                            ]
                          ],
                          [
                            'name' => 'Smail TP', //existing record
                            '_joinData' => [
                                  'instrument' => 'Guitars',
                                  'joined' => '2011'
                              ]
                          ]
                      ],
                      'city' => [
                          'id' => 30
                      ],
                      'networks' => [
                          [
                          'type' => 'facebook',
                          'link' => ''
                          ],
                          [
                          'type' => 'twitter',
                          'link' => ''
                          ]
                      ],
                      'genres' => [ //problem with multiple record, to check later
                        [
                          'id' => 12; 
                        ]
                      ]
                  ];
                   $band = $this->Bands->newEntity($data, [
                        'associated' => ['Artists._joinData','Cities','Networks','Genres']
              ]);
                   debug($this->Bands->save($band)); die('ok');
        if ($this->request->is('post')) {
            $band = $this->Bands->newEntity($data, [
                        'associated' => ['Artists._joinData','Cities','Networks','Genres']
              ]);
            if ($this->Bands->save($band)) {
                $this->Flash->success(__('The band has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add the band.'));
        }
        $this->set('band', $band);
   }

   /*
    * Update action : update a band
    */

   public function edit($id = null)
   {
        //assuming we update only basic band info
              $band = $this->Bands->find()->where(['id'=>$id])->first();
              if ($this->request->is(['post', 'put'])) {
                  $this->Bands->patchEntity($band, $this->request->data);
                  if ($this->Bands->save($band)) {
                      $this->Flash->success(__('the band has been updated.'));
                      return $this->redirect(['action' => 'index']);
                  }
                  $this->Flash->error(__('Unable to update the band.'));
              }

              $this->set('band', $band);
   }

   /*
    * Delete action: to delete a band
      @param : id of the band
      redirects to the refered page in case of success
    */

   public function delete($id){
      //to be reimplemented in ajax.
      $band = $this->Bands->find()->where(['Bands.id'=>$id])->first();
      if(!empty($band) && $this->Bands->delete($band))
      {
                $this->Flash->set('Band deleted successfully.', [
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


   /*
      Multi criteria search for a bands
      @param city, genre or band calling post method
      @return Query object
   */
   public function search(){
      //action should be called using Post method only
      //to add Get method logic eventually
      if($this->request->is('get'))
      {
          $bands = $this->Bands->find();

          if($this->request->data('city')){
            $bands = $bands->matching(
                            'Cities' , function($q){
                                return $q->where(['Cities.name' => $this->request->data('city')]);
                              });
          }

          if($this->request->data('genre')){
            $bands = $bands->matching(
                            'Genres' , function($q){
                                return $q->where(['Cities.name' => $this->request->data('genre')]);
                              });
          }

          if($this->request->data('band')){
            $bands = $bands->where(['Bands.name'=>$this->request->data('band')]);
          }
      }
      else
      {
        return $this->redirect(['controller'=>'posts', 'action'=>'index']);
      }
      return $bands;
   }

   //delete the relation between a given band, and an artist
   public function unlinkArtist($band, $artistid){
        $band = $this->Bands->find()->where(['Bands.id' => $band])->first();
        $artist = $this->Bands->Artists->find()->where(['Artists.id' => $artistid])->toArray();
        $this->Bands->Artists->unlink($band,$artist);
        die();
   }

   public function unlinkGenre($band, $genreid){
        $band = $this->Bands->find()->where(['Bands.id' => $band])->first();
        $genre = $this->Bands->Genres->find()->where(['Genres.id' => $genreid])->toArray();
        $this->Bands->Genres->unlink($band,$genre);
        die();
   }
}
