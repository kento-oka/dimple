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

/**
 *
 */
class LazyInclude implements AbstractLazy{
    
    /**
     * File path.
     * 
     * @var string
     */
    protected $path;

    public function __construct($path){
        $this->path = $path;
    }
    
    public function resolve(){
        $path   = $this->resolveNestLazy($this->path);
        
        if(!is_string($path)){
            throw new \LogicException;
        }else if(!is_file($path)){
            throw new \LogicException;
        }
        
        return include($path);
    }
}