<?php

namespace App\Criteria;

use Fluent\Repository\Contracts\CriterionInterface;

class TiketCriteria implements CriterionInterface
{
    public function apply($entity)
    {
        return $entity->join('status', 'tiket.status_id = status.id');
    }
}
