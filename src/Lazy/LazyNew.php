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
namespace Dimple\Lazy;

use Dimple\InjectionFactory;
use Dimple\AbstractLazy;

/**
 *
 */
class LazyNew extends AbstractLazy{

    /**
     * Injection factory.
     * 
     * @var InjectionFactory
     */
    protected $factory;
    
    /**
     * Class name.
     * 
     * @var string
     */
    protected $class;
    
    /**
     * 
     * 
     * @var mixed[]
     */
    protected $params;
    
    /**
     * 
     * 
     * @var mixed[]
     */
    protected $setters;

    /**
     * 
     * 
     * @var mixed[]
     */
    protected $props;
    
    /**
     * 
     * @param InjectionFactory $factory
     * @param type $class
     * @param array $params
     * @param array $setters
     * @param array $props
     */
    public function __construct(
        InjectionFactory $factory,
        $class,
        array $params = [],
        array $setters = [],
        array $props = []
    ){
        $this->factory  = $factory;
        $this->class    = $class;
        $this->params   = $params;
        $this->setters  = $setters;
        $this->props    = $props;
    }
    
    public function resolve(){
        $class      = $this->resolveNestLazy($this->class);
        $params     = $this->resolveNestLazy($this->params);
        $setters    = $this->resolveNestLazy($this->setters);
        $props      = $this->resolveNestLazy($this->props);
        
        if(!is_string($class)){
            throw new \LogicException;
        }
        
        return $this->factory->newInstance($class, $params, $setters, $props);
    }
}