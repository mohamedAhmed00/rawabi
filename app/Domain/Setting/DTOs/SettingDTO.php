<?php
namespace App\Domain\Setting\DTOs;

use App\Infrastructure\DTOs\Abstraction\DataTransferObject;

class SettingDTO extends DataTransferObject
{
    /**
     * @var string
     */

    public $settings;

    /**
     * @param $request
     * @return SettingDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromRequest( $request ){
        $settings['settings'] = array(
            ['name' => $request->get('name')],
            ['phone' => $request->get('phone')],
            ['address' => $request->get('address')],
            ['email' => $request->get('email')],
            ['facebook' => $request->get('facebook')],
            ['maroof' => $request->get('maroof')],
            ['instagram' => $request->get('instagram')],
            ['whatsapp' => $request->get('whatsapp')],
            ['twitter' => $request->get('twitter')],
            ['youtube' => $request->get('youtube')],
            ['brief' => $request->get('brief')],
            ['head' => $request->get('head')],
            ['packing' => $request->get('packing')],
            ['order_status' => $request->get('order_status')],
            ['tax_number' => $request->get('tax_number')],
            ['tax' => $request->get('tax')],
        );
        return new self($settings);
    }

    /**
     * @param array $params
     * @return SettingDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromWebHook(array $params)
    {
        return new self();
    }
}
