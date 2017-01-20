<?php

namespace BadHospitals;

use BadHospitals\DatabaseStorage;

class HospitalRepo
{
    private $db;

    public function __construct(DatabaseStorage $db)
    {
        $this->db = $db;
    }

    public function get_hospitals(string $state, string $payment_reduction)
    {
        $sql = 'select distinct
                p.provider_id,
                p.payment_reduction,
                h.hospital_name as hospital_name,
                h.address as address,
                h.city as city,
                h.state as state,
                h.zip_code as zip_code,
                h.phone_number as phone_number
              from problems as p
              join hospitals as h on (p.provider_id = h.provider_id)
              where h.state = ?
              and p.payment_reduction = ?'; 

        return $this->db->get()->safeQuery($sql, [$state, $payment_reduction]);
    }
}
