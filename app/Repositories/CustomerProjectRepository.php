<?php

namespace App\Repositories;

use App\Models\Project;
use App\Contracts\CustomerProjectContract;
use App\Http\Controllers\Api\CustomerApiProjectController;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class CustomerProjectRepository
 *
 * @package \App\Repositories
 */
class CustomerProjectRepository extends BaseRepository implements CustomerProjectContract
{
    /**
     * @var Customer
     */
    protected $customer;


    /**
     * ProjectRepository constructor.
     * @param Project $model
     */
    public function __construct( Project $model )
    {
        parent::__construct( $model );        
        $this->model = $model;

        $this->customer = $this->getAuthorizedUser('customer-api');
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
//    public function listCustomerProjects( string $order = 'id', string $sort = 'desc', array $columns = ['*'] )
    public function listCustomerProjects( array $params )
    {   
         return $this->all( $params['columns'], $params['order'], $params['sort'] )->where( 'customer_id', $params['where'] );      
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
//    public function findCustomerProjectById( array $params )
    public function findCustomerProjectBy( array $params )
    {
        $params = array_merge($params, ['customer_id' => $this->customer->id]); /* get current loged customer - owner's project */
        
        return $this->findOneBy( $params );
    } 

    /**
     * @param array $params
     * @return CustomerProject|mixed
     */
    public function createCustomerProject( array $params )
    {
        $project = new Project();
        $project->name = $params['name'];
        $project->host_url = $params['host_url'];
        $project->description = $params['description'];
        $project->status = $params['status'];

    //    $project = auth()->user()->projects()->save( $project );
        $project = $this->customer->projects()->save( $project );

         return $project;    
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCustomerProject( array $params )
    {
        $data = [
            'id' => $params['id'],
            'customer_id' => $this->customer->id  /* get current loged customer - owner's project */
        ];
//        $project = $this->findCustomerProjectById( $data );
        $project = $this->findCustomerProjectBy( $data );

        $project->update( $params );

         return $project;
    } 

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteCustomerProject( array $params )
    {
//        $project = $this->findCustomerProjectById( $params );
        $project = $this->findCustomerProjectBy( $params );

        $project->delete();

        return $project;
    }  

}