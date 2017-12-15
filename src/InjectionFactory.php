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
class InjectionFactory{
    
    /**
     * 
     * 
     * @var Injection[]
     */
    private $injection  = [];

    public function newInstance(
        string $class,
        array $params = [],
        array $setters = [],
        array $props = []
    ){
        
    }

    public function getInjection(string $class){
        if(!isset($this->injection[$class])){
            $this->injection[$class]    = new Injection($class);
        }
        
        return $this->injection[$class];
    }
    
    public function newLazy($callback, $params){
        return new Lazy\Lazy($callback, $params);
    }
    
    public function newLazyNew($class, $params, $setters, $props){
        return new Lazy\LazyNew($this, $class, $params, $setters, $props);
    }
    
    public function newLazyGet($container, $service){
        return new Lazy\LazyGet($container, $service);
    }
    
    public function newLazyInclude($path){
        return new Lazy\LazyInclude($path);
    }
}