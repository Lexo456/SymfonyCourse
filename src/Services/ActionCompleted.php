<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ActionCompleted
{
    public function actionCompletedMessage($actionName, Request $request): Response
    {
        $message = "Execution reussite du $actionName";
        $this->bag->addFlash('success', $message);
    }
}
