<?php

namespace App\Controller;

use Cake\Controller\Controller;
use org\camunda\php\sdk\Api;
use org\camunda\php\sdk\entity\request\TaskRequest;
use org\camunda\php\sdk\entity\response\Task;

class VacationController extends Controller
{

    public function initialize()
    {
        parent::initialize();
    }

    public function listAction()
    {
        $api = new Api('http://localhost:8080/engine-rest');

        $taskRequest = new TaskRequest();
        $taskRequest->setProcessDefinitionKey('approve-vacation-request');
        $taskRequest->setTaskDefinitionKey('approval-required');

        /** @var Task[] $tasks */
        $tasks = $api->task->getTasks($taskRequest);

        $this->set('tasks', $tasks);
    }

}