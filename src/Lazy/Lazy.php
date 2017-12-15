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
class Lazy extends AbstractLazy{
    
    /**
     * Callback.
     * 
     * @var callable
     */
    protected $callback;

    /**
     * Callbacl paramerters.
     * 
     * @var mixed[]
     */
    protected $params;

    public function __construct($callback, $params = []){
        $this->callback = $callback;
        $this->params   = $params;
    }
    
    public function resolve(){
        $callback   = $this->resolveNestLazy($this->callback);
        $params     = $this->resolveNestLazy($this->params);
        
        if(!is_callable($callback)){
            throw new \LogicException;
        }
        
        return call_user_func_array($callback, $params);
    }
}