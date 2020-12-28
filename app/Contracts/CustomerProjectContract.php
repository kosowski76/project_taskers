<?php

namespace App\Contracts;

/**
 * Interface CustomerProjectContract
 * @package App\Contracts
 */
interface CustomerProjectContract
{
    /**
     * @param array $params
     * @return mixed
     */
    public function listCustomerProjects( array $params );

    /**
     * @param array $params
     * @return mixed
     */
//    public function findCustomerProjectById( array $params );
    public function findCustomerProjectBy( array $params );

    /**
     * @param array $params
     * @return mixed
     */
    public function createCustomerProject( array $params );

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCustomerProject( array $params );

    /**
     * @param $id
     * @return bool
     */
    public function deleteCustomerProject( array $params );

}