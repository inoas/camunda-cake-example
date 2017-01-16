<?php

namespace App\Controller;

use Cake\Controller\Controller;
use org\camunda\php\sdk\Api;
use org\camunda\php\sdk\entity\request\TaskRequest;
use org\camunda\php\sdk\entity\request\VariableInstanceRequest;
use org\camunda\php\sdk\entity\response\Task;
use org\camunda\php\sdk\entity\response\VariableInstance;

class VacationController extends Controller
{

    /**
     * @var Api $api
     */
    private $api;

    /**
     * Constructor.
     */
    public function initialize()
    {
        parent::initialize();
        $this->autoRender = false;
        $this->api = new Api('http://localhost:8080/engine-rest');
    }

    /**
     * Show the list of open vacation requests.
     */
    public function listAction()
    {

        $taskList = [];

        $taskRequest = new TaskRequest();
        $taskRequest->setProcessDefinitionKey('approve-vacation-request');
        $taskRequest->setTaskDefinitionKey('approval-required');

        /** @var Task[] $tasks */
        $tasks = $this->api->task->getTasks($taskRequest);

        foreach ($tasks as $task) {
            $taskList[$task->getId()]['id'] = $task->getId();
            
            $variableInstanceRequest = new VariableInstanceRequest();
            $variableInstanceRequest->setExecutionIdIn($task->getExecutionId());

            /** @var VariableInstance[] $variableInstances */
            $variableInstances = $this->api->variableInstance->getInstances($variableInstanceRequest);
            foreach ($variableInstances as $variable) {
                $taskList[$task->getId()]['employee'] = $variable->getValue();
            }
        }

        $this->set('tasks', $taskList);
        $this->render();
    }

    /**
     * Approve a vacation request.
     */
    public function approveAction()
    {
        $this->approveOrDenyRequest($this->request->params['id'], true);
        $this->redirect('/');
    }

    /**
     * Deny a vacation request.
     */
    public function denyAction()
    {
        $this->approveOrDenyRequest($this->request->params['id'], false);
        $this->redirect('/');
    }

    /**
     * Send an API call to approve or deny vacation request.
     *
     * @param string $taskId The ID of the approval-required UserTask.
     * @param boolean $value TRUE to approve, FALSE to deny vacation request.
     */
    private function approveOrDenyRequest($taskId, $value)
    {
        $taskRequest = new TaskRequest();
        $taskRequest->setVariables(['approved' => ['value' => $value]]);

        $this->api->task->completeTask($taskId, $taskRequest);
    }

}
