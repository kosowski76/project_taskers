<?php

namespace App\Repositories;

use App\Models\Host;
use App\Contracts\StaffHostContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class CustomerHostRepository
 *
 * @package \App\Repositories
 */
class StaffHostRepository extends BaseRepository implements StaffHostContract
{

    /**
     * StaffRepository constructor.
     * @param Host $model
     */
    public function __construct( Host $model )
    {
        parent::__construct( $model );
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listStaffHosts( array $params )
    {
         return $this->all( $params['columns'], $params['order'], $params['sort'] );        
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findStaffHostById( int $id )
    { 
        return $this->find( $id );
    }

    /**
     * @param array $params
     * @return StaffHost|mixed
     */
    public function createStaffHost( array $params )
    {
        $host = null;
/*       $host = new Host();
        $host->title = $params['title'];
        $host->host_url = $params['host_url'];
        $host->description = $params['description'];

    //    $host->save();
        $host = auth()->user()->hosts()->save( $host );
*/
         return $host;    
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateStaffHost( array $params )
    {
        
        $host = $this->findStaffHostById( $params['id'] );
        $host->update( $params );
  
         return $host;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteStaffHost( $id )
    {
        $host = $this->findStaffHostById( $id );
        $host->delete();

         return $host;
    }

}