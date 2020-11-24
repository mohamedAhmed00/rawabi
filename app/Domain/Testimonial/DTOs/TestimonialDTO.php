<?php
namespace App\Domain\Testimonial\DTOs;

use App\Infrastructure\DTOs\Abstraction\DataTransferObject;

class TestimonialDTO extends DataTransferObject
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
    public $location;

    /**
     * @param $request
     * @return TestimonialDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromRequest( $request ){
        return new self([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'location' => $request->get('location')
        ]);
    }

    /**
     * @param array $params
     * @return TestimonialDTO
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public static function fromWebHook(array $params)
    {
        return new self([
            'name' => $params['name'],
            'description' => $params['description'],
            'location' => $params['location']
        ]);

    }
}
