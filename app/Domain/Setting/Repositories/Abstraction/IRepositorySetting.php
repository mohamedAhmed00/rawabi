<?php
namespace App\Domain\Setting\Repositories\Abstraction;

interface IRepositorySetting
{
    /**
     * @author Mohamed Ahmed
     * @return void
     */
    public function truncate():void;

    /**
     * @param array $settings
     */
    public function storeSettings(array $settings):void;
}
