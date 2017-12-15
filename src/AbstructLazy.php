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
abstract class AbstractLazy implements LazyInterface{
    
    protected function resolveNestLazy($lazy){
        if(is_array($lazy)){
            foreach($lazy as &$val){
                $val    = $this->resolveNestLazy($val);
            }
        }else if($lazy instanceof LazyInterface){
            $lazy   = $lazy();
        }
        
        return $lazy;
    }
}