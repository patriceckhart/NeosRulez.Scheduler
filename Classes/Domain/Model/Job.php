<?php
namespace NeosRulez\Scheduler\Domain\Model;

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Job {

    /**
     * @var string
     */
    protected $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * @var string
     */
    protected $command;

    /**
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @param string $command
     * @return void
     */
    public function setCommand($command)
    {
        $this->command = $command;
    }

    /**
     * @var string
     */
    protected $execution;

    /**
     * @return string
     */
    public function getExecution()
    {
        return $this->execution;
    }

    /**
     * @param string $execution
     * @return void
     */
    public function setExecution($execution)
    {
        $this->execution = $execution;
    }

    /**
     * @var boolean
     */
    protected $recurring = 1;

    /**
     * @return boolean
     */
    public function getRecurring()
    {
        return $this->recurring;
    }

    /**
     * @param boolean $recurring
     * @return void
     */
    public function setRecurring($recurring)
    {
        $this->recurring = $recurring;
    }

    /**
     * @var \DateTime
     */
    protected $last;

    /**
     * @return \DateTime
     */
    public function getLast()
    {
        return $this->last;
    }

    /**
     * @param \DateTime $last
     * @return void
     */
    public function setLast($last)
    {
        $this->last = $last;
    }

    /**
     * @var \DateTime
     */
    protected $next;

    /**
     * @return \DateTime
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * @param \DateTime $next
     * @return void
     */
    public function setNext($next)
    {
        $this->next = $next;
    }

    /**
     * @var boolean
     */
    protected $disabled = 0;

    /**
     * @return boolean
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * @param boolean $disabled
     * @return void
     */
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;
    }

    /**
     * @var \DateTime
     */
    protected $created;


    public function __construct() {
        $this->created = new \DateTime();
        $this->last = new \DateTime();
    }

    /**
     * @return string
     */
    public function getCreated() {
        return $this->created;
    }

}
