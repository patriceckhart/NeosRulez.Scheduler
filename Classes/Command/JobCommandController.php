<?php
namespace NeosRulez\Scheduler\Command;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;

/**
 * @Flow\Scope("singleton")
 */
class JobCommandController extends CommandController {

    /**
     * @Flow\Inject
     * @var \NeosRulez\Scheduler\Domain\Repository\JobRepository
     */
    protected $jobRepository;

    /**
     * @Flow\Inject
     * @var \NeosRulez\Scheduler\Domain\Service\ExecutionService
     */
    protected $executionService;

    /**
     * Run cron jobs
     *
     * @return void
     */
    public function runCommand() {
        $jobs = $this->jobRepository->findAll();
        foreach ($jobs as $job) {
            if(!$job->getDisabled()) {
                $this->executionService->execute($job);
                $this->outputLine('Job: "' . $job->getName() . '" executed. Cmd: '. $job->getCommand());
            }
        }
    }

}
