<?php
/**
 * Dimple
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.
 * Redistributions of files must retain the above copyright notice.
 *
 * @author      Kento Oka <oka.kento0311@gmail.com>
 * @copyright   (c) Kento Oka
 * @license     MIT
 * @since       1.0.0
 */
namespace Dimple;

/**
 *
 */
class Container implements Psr\Container\ContainerInterface{

    public static function build(){
        return new static();
    }

    public static function configuredBuild(){
        return new static();
    }

    public function newInstance(
        string $className,
        array $params = [],
        array $setters = [],
        array $props = []
    ){
    }

    /**
     * @inheritdoc
     */
    public function get($serviceName){
    }

    /**
     * @inheritdoc
     */
    public function has($serviceName){
    }

    /**
     *
     *
     * @param   string  $id
     * @param   mixed   $value
     */
    public function set($serviceName, $service){
    }

    /**
     *
     *
     * @param   string  $id
     */
    public function remove($serviceName){
    }


    public function injection(string $className){
    }

    public function lazyNew(string $className){
    }

    public function lazyGet(string $serviceName){
    }
}