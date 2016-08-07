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
   public function view($id = null){
            //code..
            $band = $this->Bands->get($id,['contain'=>['Cities.Countries','Artists','Networks']]);
            $this->set(compact('band'));
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

   }
}
