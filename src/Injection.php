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
class Injection{

    /**
     * 
     * 
     * @var Reflector
     */
    private $reflector;
    
    /**
     * Class name.
     *
     * @var string
     */
    private $className;

    /**
     * Constructer injection.
     *
     * @var mixed[]
     */
    private $params     = [];

    /**
     * Setter injection.
     *
     * @var mixed[]
     */
    private $setters    = [];

    /**
     * Property injection.
     *
     * @var mixed[]
     */
    private $props      = [];
    
    public function __construct(string $className){
        if(!class_exists($className)){
            throw new \LogicException;
        }
    }

    public function newInstance(
        array $params = [],
        array $setters = [],
        array $props = []
    ){
    }

    /**
     * Add constructor injection`s parameter.
     * 
     * @param   string  $name
     *      Parameter name.
     * @param   mixed   $value
     *      Value.
     * 
     * @return  $this
     */
    public function param(string $name, $value){
        $this->params[$name]    = $value;
        
        return $this;
    }

    /**
     * Add setter injection`s method.
     * 
     * @param   string  $name
     *      Setter method name.
     * @param   mixed   $value
     *      Value.
     * 
     * @return  $this
     */
    public function setter(string $name, $value){
        $this->setters[$name]   = $value;
        
        return $this;
    }

    /**
     * Add Property injection`s property.
     * 
     * @param   string  $name
     *      Property name.
     * @param   mixed   $value
     *      Value.
     * 
     * @return  $this
     */
    public function prop(string $name, $value){
        $this->props[$name] = $value;
        
        return $this;
    }

    /**
     * 
     * 
     * @param   mixed[] $params
     * 
     * @return  $this
     */
    public function params(array $params){
        foreach($params as $name => $value){
            $this->param($name, $value);
        }
        
        return $this;
    }

    /**
     * 
     * 
     * @param   mixed[] $setters
     * 
     * @return  $this
     */
    public function setters(array $setters){
        foreach($setters as $name => $value){
            $this->setter($name, $value);
        }
        
        return $this;
    }

    /**
     * 
     * 
     * @param   mixed[] $props
     * 
     * @return  $this
     */
    public function props(array $props){
        foreach($props as $name => $value){
            $this->prop($name, $value);
        }
        
        return $this;
    }
}