<?php
namespace App\Domain\HomeSection\DTOs;

use App\Infrastructure\DTOs\Abstraction\DataTransferObject;

class HomeSectionDTO extends DataTransferObject
{

    /**
     * @var string
     */
    public $title;

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
     * @return HomeSectionDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromRequest( $request ){
        $image = uploadFile('uploads/sections',$request->file('image'));
        $response = [
            'title' => $request->get('title'),
            'description' => $request->get('description'),
        ];
        if ($image){
            $response['image'] = $image;
        }
        return $response;
    }

    /**
     * @param array $params
     * @return HomeSectionDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromWebHook(array $params)
    {
        return new self([
            'title' => $params['title'],
            'description' => $params['description'],
            'image' => $params['image']
        ]);

    }
}
