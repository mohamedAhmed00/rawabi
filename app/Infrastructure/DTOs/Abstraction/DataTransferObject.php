<?php
namespace App\Infrastructure\DTOs\Abstraction;

abstract class DataTransferObject
{
    /**
     * DataTransferObject constructor.
     * @param array $parameters
     * @author Mohamed Ahmed
     * @throws \ReflectionException
     */
    public function __construct(array $parameters = [])
    {
        $class = new \ReflectionClass(static::class);
        foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $reflectionProperty){
            $property = $reflectionProperty->getName();
            $this->{$property} = $parameters[$property];
        }
    }

    /**
     * @param $request
     * @author Mohamed Ahmed
     * @return Mixed
     * @throws \ReflectionException
     */
    public abstract static function fromRequest( $request );

    /**
     * @param array $params
     * @author Mohamed Ahmed
     * @return Mixed
     * @throws \ReflectionException
     */
    public abstract static function fromWebHook(array $params);
}
