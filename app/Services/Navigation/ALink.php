<?php


namespace App\Services\Navigation;

class ALink
{
    public string $avatar ;
    public string $url;
    public array $params = [];
    public string $usage;

    public function __construct( $avatar, $url, $params = null,  $usage=''){
        $this->avatar = $avatar;
        $this->url = $url;
        if($params){
            $this->params = $params;
        }else {
            $this->params = [];
        }
        $this->usage = $usage;
    }
    public function getParams(): array
    {
        return $this->params;
    }
    public function param($name,$value): static
    {
        $this->params[$name] = $value;
        return $this;
    }
    public function getAvatar(): string
    {
        return $this->avatar;
    }
    public function getURL(): string
    {
        return $this->url;
    }
    public function getUsage()
    {
        return $this->usage;
    }


}
