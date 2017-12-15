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

use ReflectionClass;
use ReflectionException;

/**
 * 
 */
class Reflector{
    
    protected $classes = [];
    
    protected $params = [];
    
    protected $traits = [];
    
    /**
     * 
     * 
     * @param   string  $class
     * 
     * @return  ReflectionClass
     */
    public function getClass($class){
        if(!class_exists($class)){
            throw new \LogicException;
        }
        
        if(!isset($this->classes[$class])){
            $this->classes[$class]  = new ReflectionClass($class);
        }
        
        return $this->classes[$class];
    }
    
    /**
     * 
     * 
     * @param   string  $class
     * 
     * @return  ReflectionProperty[]
     */
    public function getParams(string $class){
        if(!class_exists($class)){
            throw new \LogicException;
        }
        
        if(!isset($this->params[$class])){
            $this->params[$class] = [];
            $constructor = $this->getClass($class)->getConstructor();
            if ($constructor) {
                $this->params[$class] = $constructor->getParameters();
            }
        }
        
        return $this->params[$class];
    }


    /**
     * 
     * @param   string  $class
     * 
     * @return  ReflectionClass[]
     */
    public function getTraits($class){
        if(!class_exists($class)){
            throw new \LogicException;
        }
        
        if(!isset($this->traits[$class])){
            $traits = [];
            $classes    = array_merge($class, $this->getParentClasses($class));
            
            foreach($classes as $current){
                $traits = $traits + $current->getTraitNames();
            }
            
            do{
                $traits += class_uses($class);
            } while ($class = get_parent_class($class));

            // get traits from ancestor traits
            $traitsToSearch = $traits;
            while (!empty($traitsToSearch)) {
                $newTraits = class_uses(array_pop($traitsToSearch));
                $traits += $newTraits;
                $traitsToSearch += $newTraits;
            };

            foreach ($traits as $trait) {
                $traits += class_uses($trait);
            }

            $this->traits[$class] = array_unique($traits);
        }

        return $this->traits[$class];
    }
    
    /**
     * 
     * @param   string  $class
     * 
     * @return  ReflectionClass[]
     */
    public function getParentClasses(string $class){
        if(!class_exists($class)){
            throw new \LogicException;
        }
        
        $class      = $this->getClass($class);
        $parents    = [];
        
        while(($parent = $class->getParentClass()) !== false){
            $this->classes[$parent->getName()]  = $parent;
            
            $parents[]  = $parent;
            $class      = $parent;
        }
        
        return $parents;
    }
}
