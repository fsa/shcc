<?php

namespace Xiaomi\Devices;

class Unknown extends AbstractDevice {

    private $params;
    
    public function __construct() {
        $this->params=[];
        parent::__construct();
    }

    protected function updateParam($param,$value) {
        $this->actions[$param]=$value;
        if(array_key_exists($param, $this->params)) {
            if(array_search($value, $this->params[$param])===false) {
                array_push($this->params[$param], $value);
            }
        } else {
            $this->params[$param]=[$value];        
        }
    }

    public function getState(): array {
        return [];
    }

    public function getDescription(): string {
        return "Неизвестный тип устройства";
    }

    public function getDeviceIndicators(): array {
        return [];
    }

    public function getDeviceMeters(): array {
        return [];
    }

    public function getStateString(): string {
        return $this->model.'=>'.json_encode($this->params);
    }

}
