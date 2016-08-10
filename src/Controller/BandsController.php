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
    * Index page for bands controller, shows latest bands added, and relative informations
    * about them
    */
   public function index($genre){
        
        //$bands = $this->Bands->find('genre',['genre'=>'Black'])->all();
       // debug($bands); die();

        

        die();

        /* to uncomment after tests
        $recent = $this->Bands->find('recent')->all();
        debug($recent);die('end');
        $this->set(compact('recent'));
        */
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
                      //handle not found exception
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
            //code..
   }

   /*
    * Update action : update a band
    */

   public function update($id){
            //code
   }

   /*
    * Delete action: to delete a band
    */

   public function delete($id){
      $band = $this->Bands->get($id);
      $res = $this->Bands->delete($band);
      debug($res); die();
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
