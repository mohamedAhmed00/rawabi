<?php
namespace App\Domain\About\DTOs;

use App\Infrastructure\DTOs\Abstraction\DataTransferObject;

class AboutDTO extends DataTransferObject
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
     * @return AboutDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromRequest($request){
        $image = uploadFile('uploads/about',$request->file('image'));
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
     * @return AboutDTO
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
