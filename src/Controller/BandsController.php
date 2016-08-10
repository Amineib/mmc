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

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Flash'); // Include the FlashComponent
    }


   /* 
    * Index page for bands controller, shows latest bands added, and relative informations
    * about them
    */
   public function index(){
        $bands = $this->Bands->find()->all();
        $this->set(compact('$bands'));
   }

  /* viewGenre: view bands by genres
   */
  public function viewGenre($genre){
    $bands = $this->Bands->find()->contain('Genres', function($q) use ($genre){
        return $q->where(['Genres.name'=>$genre])->all();
    });

    $this->set(compact('$bands'));
  }

  
   /*
    * View action: view details of an article for a given id
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
                      'name' => 'lastBand',
                      'active' => '1',
                      'formed' => '2011',
                      'description' => 'lorem ipsum..',
                      'artists' => [
                          [
                            'name' => 'MehdiJardani', //we create a new record {artist}
                            'description' => 'lorem ipsum..',
                            '_joinData' => [
                                'instrument' => 'vocals',
                                'joined' => '2011'
                            ]
                          ],
                          [
                            'id' => 14, //existing record
                            '_joinData' => [
                                  'instrument' => 'bass',
                                  'joined' => '2011'
                              ]
                          ]
                      ],
                      'city' => [
                          'id' => 17
                      ]
                  ];
        

              
              /* test save
              if($this->Bands->save($band)){

                die ('ok');
              }
              else{
                debug($band);
                die('ko');
              }
              */


        if ($this->request->is('post')) {
            $band = $this->Bands->newEntity($data, [
                        'associated' => ['Artists._joinData','Cities._joinData']
              ]);
            if ($this->Articles->save($band)) {
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
              $band = $this->Bands->find()->where(['id'=>$id]);
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
      if(!empty($band) && $this->Bands->delete($band)){
                $this->Flash->set('Band deleted successfully.', [
            'element' => 'success'
        ]);
                die('not empty');
                //$this->redirect($this->refer());
      }
      else{
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
}
