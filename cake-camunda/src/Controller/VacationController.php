<?php

namespace App\Controller;

use Cake\Controller\Controller;
use org\camunda\php\sdk\Api;
use org\camunda\php\sdk\entity\request\ProcessDefinitionRequest;
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
     * Create a vacation request.
     */
    public function createAction()
    {
        if (null == $name = $this->request->data['name']) {
            $this->response->statusCode(500);
        } else {
            $processDefinitionRequest = new ProcessDefinitionRequest();
            $processDefinitionRequest->setVariables(['employee' => ['value' => $name]]);
            $instance = $this->api->processDefinition->startInstance('approve-vacation-request:3:2efb8b0b-df30-11e6-9cb8-448a5bf0412c', $processDefinitionRequest);

            $this->response->statusCode(200);
            $this->response->body(json_encode(['id' => $instance->getId()]));
        }
        $this->response->type('application/json');
    }

    /**
     * Approve a vacation request.
     */
    public function approveAction()
    {
        $this->approveOrDenyRequest($this->request->params['id'], true);
        $this->response->type('application/json');
        $this->response->statusCode(200);
    }

    /**
     * Deny a vacation request.
     */
    public function denyAction()
    {
        $this->approveOrDenyRequest($this->request->params['id'], false);
        $this->response->type('application/json');
        $this->response->statusCode(200);
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
