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

        }



        $this->className    = $className;
    }

    public function newInstance(
        array $params = [],
        array $setters = [],
        array $props = []
    ){
    }

    public function param(string $name, $value){

    }

    public function setter(string $name, $value){
    }

    public function prop(string $name, $value){
    }

    public function params(array $params){
    }

    public function setters(array $setters){
    }

    public function props(array $props){
    }
}