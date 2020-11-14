<?php
namespace NeosRulez\Scheduler\Controller;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;

use Neos\Fusion\View\FusionView;

class JobController extends ActionController {

    protected $defaultViewObjectName = FusionView::class;

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
     * @var array
     */
    protected $settings;

    /**
     * @param array $settings
     * @return void
     */
    public function injectSettings(array $settings) {
        $this->settings = $settings;
    }


    /**
     * @return void
     */
    public function indexAction() {
        $jobs = $this->jobRepository->findAll();
        $this->view->assign('jobs',$jobs);
    }

    /**
     * @return void
     */
    public function newAction() {

    }

    /**
     * @param \NeosRulez\Scheduler\Domain\Model\Job $job
     * @return void
     */
    public function editAction($job) {
        $this->view->assign('job',$job);
    }

    /**
     * @param \NeosRulez\Scheduler\Domain\Model\Job $job
     * @return void
     */
    public function createAction($job) {

        $next = new \DateTime();
        $this->jobRepository->nextExecution($next, $job->getExecution());
        $job->setNext($next);

        $this->jobRepository->add($job);
        $this->redirect('index');
    }

    /**
     * @param \NeosRulez\Scheduler\Domain\Model\Job $job
     * @return void
     */
    public function executeCommandAction($job) {
        $this->executionService->execute($job);
        $this->redirect('index');
    }

    /**
     * @param \NeosRulez\Scheduler\Domain\Model\Job $job
     * @return void
     */
    public function changeStatusAction($job) {
        $status = true;
        if($job->getDisabled()) {
            $status = false;
        }
        $job->setDisabled($status);
        $this->jobRepository->update($job);
        $this->redirect('index');
    }

    /**
     * @param \NeosRulez\Scheduler\Domain\Model\Job $job
     * @return void
     */
    public function updateAction($job) {

        $next = $job->getNext();
        $this->jobRepository->nextExecution($next, $job->getExecution());
        $job->setNext($next);

        $this->jobRepository->update($job);
        $this->redirect('index');
    }

    /**
     * @param \NeosRulez\Scheduler\Domain\Model\Job $job
     * @return void
     */
    public function deleteAction($job) {
        $this->jobRepository->remove($job);
        $this->redirect('index');
    }

}
