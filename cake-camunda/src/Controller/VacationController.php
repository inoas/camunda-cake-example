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

    public function initialize()
    {
        parent::initialize();
    }

    public function listAction()
    {

        $taskList = [];

        $api = new Api('http://localhost:8080/engine-rest');

        $taskRequest = new TaskRequest();
        $taskRequest->setProcessDefinitionKey('approve-vacation-request');
        $taskRequest->setTaskDefinitionKey('approval-required');

        /** @var Task[] $tasks */
        $tasks = $api->task->getTasks($taskRequest);

        foreach ($tasks as $task) {
            $variableInstanceRequest = new VariableInstanceRequest();
            $variableInstanceRequest->setExecutionIdIn($task->getExecutionId());

            $taskList[$task->getId()]['id'] = $task->getId();

            /** @var VariableInstance[] $variableInstances */
            $variableInstances = $api->variableInstance->getInstances($variableInstanceRequest);
            foreach ($variableInstances as $variable) {
                $taskList[$task->getId()]['employee'] = $variable->getValue();
            }

        }

        $this->set('tasks', $taskList);
    }

}