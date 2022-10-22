<?php

namespace App\Services\Navigation;

class Drop {

    public string $label = '' ;
    public string $class = '';
    public string $icon = '';
    public array $links = [];
    public array $separators = [];


    public function __construct( $label)
    {
        $this->label = $label;
    }
    public function entry($label, $url, $icon,  $params = null) : self
    {
        $link = new Link($label, $url, $icon,  $params);
        if(isset($params)){
            foreach ($params as $k=>$v ){
                $link->param($k,$v);
            }
        }
        $this->links[] = $link;
        return $this;
    }


    public function separator(): self
    {
        $this->separators[] = count($this->links);
        return $this;
    }
    public function getLabel() : string
    {
        return $this->label;
    }
    public function getClass(): string
    {
        return $this->class;
    }
    public function getIcon(): string
    {
        return $this->icon;
    }
    /**
     * @return array
     */
    public function getLinks(): array
    {
        return $this->links;
    }
    public function getSeparator(): array
    {
        return $this->separators;
    }

}
