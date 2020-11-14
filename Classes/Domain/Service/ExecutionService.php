<?php
namespace NeosRulez\Scheduler\Domain\Service;

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @Flow\Scope("singleton")
 */
class ExecutionService {

    /**
     * @Flow\Inject
     * @var \NeosRulez\Scheduler\Domain\Repository\JobRepository
     */
    protected $jobRepository;


    /**
     * @param \NeosRulez\Scheduler\Domain\Model\Job $job
     * @return void
     */
    public function execute($job, $force = false) {
        $now = new \DateTime();
        if($now >= $job->getNext() || $force) {
            $job->setLast($now);
            if(!$job->getRecurring()) {
                $job->setDisabled(true);
            } else {
                $job->setNext($this->jobRepository->nextExecution($now, $job->getExecution()));
            }
            $this->jobRepository->update($job);
            exec($job->getCommand());
        }
    }

}
