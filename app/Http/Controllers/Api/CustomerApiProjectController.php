<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Contracts\CustomerProjectContract;
use Illuminate\Http\Request;
use App\Http\Requests\Project\Request as CustomerProjectRequest;

class CustomerApiProjectController extends BaseController
{
    /**
     * @var CustomerProjectContract
     */
    protected $customerProjectRepository;

    /**
     * @var Customer
     */
    protected $customer;

    /**
     * CustomerProjectController constructor.
     * @param CustomerProjectContract $customerProjectRepository
     */
    public function __construct(CustomerProjectContract $customerProjectRepository)
    {
        $this->customerProjectRepository = $customerProjectRepository;
       // $this->customer = auth('customer-api')->user();
        $this->customer = $this->getAuthorizedUser('customer-api');
    }

    public function dashboard(Request $request) 
    {
        $params = [
            'columns' => ['*'],
            'order' => 'id',
            'sort'  => 'desc',
            'where' => $this->customer->id           
        ];
        $projects = $this->customerProjectRepository->listCustomerProjects($params);
     
        return response()->json([
            'success' => true,
            'data' => 'dashboard',
            'user' => $this->customer,
            'projects' => $projects,
        ], 200 ); 
    }

    public function show($id)
    {
        $params = [
            'id' => $id,
        //    'customer_id' => $this->customer->id,
        ];
       
        $project = $this->customerProjectRepository->findCustomerProjectBy($params);
        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => $project
            ], 400 );
        }
 
        return response()->json([
            'success' => true,
            'data' => $project->toArray()
        ], 200 );
    }

    public function store(CustomerProjectRequest $request)
    {
     /*   $project = $this->getAuthorizedUser()->projects()->save(
            new Project($request->validated())
        );  */ 
    
        // must check Authorization 

        $params = $request->validated();
        $project = $this->customerProjectRepository->createCustomerProject($params);

        if ($project)
            return response()->json([
                'success' => true,
                'data' => $project->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Project not added'
            ], 500);
    }
  
    public function update(CustomerProjectRequest $request, $id)
    {
        $params = [
            'id' => $id,
          // 'customer_id' => $this->customer->id,
        ];

        $project = $this->customerProjectRepository->findCustomerProjectBy($params); 

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found'
            ], 400 );
        }

        $data = $request->validated();
        $merged = array_merge( $params, $data );

        $updated = $this->customerProjectRepository->updateCustomerProject($merged);
        if ($updated) {
            return response()->json([
                'success' => true,
                'message' => 'Project was updated'
                ]);
        }
        else {
            return response()->json([
                'success' => false,
                'message' => 'Project can not be updated'
                ], 500 );
        }      
    }
 
    public function destroy($id)
    {
        $params = [
            'id' => $id,
        //    'customer_id' => $this->customer->id,
        ];
 
        $project = $this->customerProjectRepository->findCustomerProjectBy($params); 
        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found'
            ], 400 );
        }

        $deleted = $this->customerProjectRepository->deleteCustomerProject($params); 
        if ($deleted) {
            return response()->json([
                'success' => true,
                'message' => 'Project was deleted'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Project can not be deleted'
            ], 500 );
        }
    }

}
