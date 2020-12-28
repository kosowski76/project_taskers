<?php

namespace App\Contracts;

/**
 * Interface StaffHostContract
 * @package App\Contracts
 */
interface StaffHostContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listStaffHosts( array $params );

    /**
     * @param int $id
     * @return mixed
     */
    public function findStaffHostById( int $id );

    /**
     * @param array $params
     * @return mixed
     */
    public function createStaffHost( array $params );

    /**
     * @param array $params
     * @return mixed
     */
    public function updateStaffHost( array $params );

    /**
     * @param $id
     * @return bool
     */
    public function deleteStaffHost( $id );

}