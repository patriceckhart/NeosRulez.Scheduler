<?php
namespace NeosRulez\Scheduler\Domain\Repository;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Repository;

/**
 * @Flow\Scope("singleton")
 */
class JobRepository extends Repository {

    public function nextExecution($next, $execution) {

        if($execution == '1min') {
            $next = $next->modify('+1 minute');
        }

        if($execution == '15min') {
            $next = $next->modify('+15 minutes');
        }

        if($execution == 'hourly') {
            $next = $next->modify('+1 hour');
        }

        if($execution == 'daily') {
            $next = $next->modify('+1 day');
        }

        if($execution == 'weekly') {
            $next = $next->modify('+1 week');
        }

        if($execution == 'monthly') {
            $next = $next->modify('+1 month');
        }

        return $next;

    }

}
