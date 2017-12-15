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

use Dimple\AbstractLazy;
use Psr\Container\ContainerInterface;

/**
 *
 */
class LazyGet implements AbstractLazy{
    
    /**
     * Container.
     * 
     * @var ContainerInterface
     */
    protected $container;
    
    /**
     * Service name.
     * 
     * @var string
     */
    protected $service;
    
    /**
     * Constructor.
     * 
     * @param   ContainerInterface  $container
     *      Service container.
     * @param   string $service
     *      Service name.
     * 
     * @return  void
     */
    public function __construct($container, $service){
        $this->container    = $container;
        $this->service      = $service;
    }
    
    /**
     */
    public function resolve(){
        $container  = $this->resolveNestLazy($this->container);
        $service    = $this->resolveNestLazy($this->service);
        
        if(!($container instanceof ContainerInterface)){
            throw new \LogicException;
        }else if(!is_string($service)){
            throw new \LogicException;
        }
        
        return $container->get($service);
    }
}