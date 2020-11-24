<?php
namespace App\Domain\Setting\Repositories\Concretion;

use App\Domain\Setting\Repositories\Abstraction\IRepositorySetting;
use App\Infrastructure\Repositories\Concretion\RepositoryAbstract;

final class RepositorySetting extends RepositoryAbstract implements IRepositorySetting
{
    /**
     * @author Mohamed Ahmed
     * @return void
     */
    public function truncate():void{
        $this->model->truncate();
    }

    /**
     * @param array $settings
     * @author Mohamed Ahmed
     * @return void
     */
    public function storeSettings(array $settings):void{
        foreach ($settings as $key => $setting){
            $key = array_key_first($setting);
            $this->model->create(['key' => $key, 'value' => $setting[$key]]);
        }
    }
}
