<?php
namespace App\Domain\User\Services\Abstraction;

interface IServiceMessage
{
    /**
     * @param $request
     * @author Mohamed Ahmed
     * @return string[]
     */
    public function sendMessage($request);
}
