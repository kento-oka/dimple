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

use Psr\Container\ContainerInterface;

/**
 *
 */
class Container implements ContainerInterface{

    /**
     * 
     * 
     * @var InjectionFactory
     */
    private $injectionFactory;
    
    /**
     * Delegate container.
     * 
     * @var ContainerInterface|null
     */
    private $delegateContainer;
    
    /**
     * Locked.
     * 
     * @var bool
     */
    private $locked = false;
    
    
    /**
     * 
     * 
     * @var mixed[]
     */
    protected $services = [];
    
    /**
     * 
     * 
     * @var mixed[]
     */
    protected $fixed    = [];
    
    
    /**
     * 
     * 
     * @return  static
     */
    public static function build(){
        return new static();
    }

    /**
     * 
     * 
     * @param   mixed[] $config
     * 
     * @return  static
     */
    public static function configuredBuild(array $config){
        return new static();
    }
    
    public function __construct(
        InjectionFactory $injectionFactory,
        ContainerInterface $delegateContainer = null
    ){
        $this->injectionFactory    = $injectionFactory;
        $this->delegateContainer    = $delegateContainer;
    }
    
    public function lock(){
        $this->locked   = true;
    }
    
    public function isLocked(){
        return $this->locked;
    }
    

    /**
     * 
     * 
     * @param   string  $service
     *      Service name.
     * 
     * @return  mixed
     */
    public function get($service){
        $this->lock();
        
        if(!$this->has($service)){
            throw new \LogicException;
        }
        
        if(!isset($this->fixed[$service])){
            $this->fixed[$service]  = $this->getFixedService($service);
        }
        
        return $this->fixed[$service];
    }
    
    /**
     * 
     * 
     * @param   string  $service
     *      Service name.
     * 
     * @return  mixed
     */
    protected function getFixedService(string $service){
        if(!$this->has($service)){
            throw new \LogicException;
        }

        if(!isset($this->services[$service])){
            return $this->delegateContainer->get($service);
        }
        
        if($this->services[$service] instanceof LazyInterface){
            return $this->services[$service]->generate();
        }
        
        return $this->services[$service];
    }

    /**
     * 
     * 
     * @param   string  $service
     *      Service name.
     * 
     * @return  bool
     */
    public function has($service){
        if(array_key_exists($service, $this->services)){
            return true;
        }
        
        return isset($this->delegateContainer)
            && $this->delegateContainer($service);
    }

    /**
     *
     *
     * @param   string  $id
     * @param   mixed   $value
     */
    public function set(string $service, $value){
        if($this->locked){
            throw new \LogicException;
        }else if(!is_object($value)){
            throw new \LogicException;
        }
        
        if($value instanceof \Closure){
            $value  = $this->injectionFactory->newLazy($value);
        }
        
        $this->services[$service]   = $value;
    }

    public function injection(string $class){
        return $this->injectionFactory->getInjection($class);
    }
    
    public function newInstance(
        string $class,
        array $params = [],
        array $setters = [],
        array $props = []
    ){
        $this->lock();
        
        return $this->injectionFactory->newInstance($class, $params, $setters, $props);
    }

    public function lazy($callback, $params){
        return $this->injectionFactory->newLazy($callback, $params);
    }
    
    public function lazyNew(
        $class,
        $params = [],
        $setters = [],
        $props = []
    ){
        return $this->injectionFactory->newLazyNew($class, $params, $setters, $props);
    }

    public function lazyGet($service){
        return $this->injectionFactory->newLazyGet($this, $service);
    }
    
    public function lazyInclude($path){
        return $this->injectionFactory->newLazyInclude($path);
    }
}