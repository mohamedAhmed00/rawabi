<?php
namespace App\Domain\Slider\DTOs;

use App\Infrastructure\DTOs\Abstraction\DataTransferObject;

class SliderDTO extends DataTransferObject
{

    /**
     * @var string
     */
    public $name;

    /**
     * @var integer
     */
    public $order;

    /**
     * @var string
     */
    public $image;

    /**
     * @var string
     */
    public $video;

    /**
     * @var integer
     */
    public $status;

    /**
     * @param $request
     * @return SliderDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromRequest( $request ){
        $image = uploadFile('uploads/sliders',$request->file('image'));
        $video = uploadFile('uploads/sliders',$request->file('video'));
        $response = [
            'name' => $request->get('name'),
            'order' => $request->get('order'),
            'status' => $request->get('status'),
        ];
        if ($image){
            $response['image'] = $image;
        }
        if ($video){
            $response['video'] = $video;
        }
        return $response;
    }

    /**
     * @param array $params
     * @return SliderDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromWebHook(array $params)
    {
        return new self([
            'name' => $params['name'],
            'order' => $params['order'],
            'status' => $params['status'],
            'image' => $params['image']
        ]);
    }
}
