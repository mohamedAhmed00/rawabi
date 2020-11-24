<?php
namespace App\Domain\Features\DTOs;

use App\Infrastructure\DTOs\Abstraction\DataTransferObject;

class FeatureDTO extends DataTransferObject
{

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $image;

    /**
     * @param $request
     * @return FeatureDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromRequest( $request ){
        $image = uploadFile('uploads/features',$request->file('image'));
        $response = [
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ];
        if ($image){
            $response['image'] = $image;
        }
        return $response;
    }

    /**
     * @param array $params
     * @return FeatureDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromWebHook(array $params)
    {
        return new self([
            'name' => $params['name'],
            'description' => $params['description'],
            'image' => $params['image']
        ]);

    }
}
