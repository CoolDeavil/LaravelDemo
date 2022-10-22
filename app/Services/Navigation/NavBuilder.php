<?php


namespace App\Services\Navigation;


use Illuminate\Support\Facades\App;

include_once app_path().DIRECTORY_SEPARATOR.'Services'.DIRECTORY_SEPARATOR.'Navigation'.DIRECTORY_SEPARATOR.'includes.php';

class NavBuilder
{
    protected bool $translate;
    private string $currentURL;
    private array $navigation = [];

    private array $rendered = [];
    private array $renderedAuth = [];


    protected bool $langDropDown = MULTI_LANGUAGE;
    protected bool $labelTranslate = TRANSLATE;
    protected string $activeCSS = ACTIVE_CSS_CLASS;

    public function __construct()
    {
        $this->currentURL = (string) rtrim( $_SERVER['REQUEST_URI'],'/');
    }
    public function link($label, $url, $icon, $usage = null ): Link
    {
        return $this->navigation[] = new Link($label, $url, $icon, $usage);
    }
    public function drop($label): Drop
    {
        return $this->navigation[] = new Drop($label);
    }
    public function admin(): Auth
    {
        return $this->navigation[] = new Auth();
    }

    public function render() : string
    {
        $this->navigation = [];
        self::build();
        $templated = '';
        foreach ($this->rendered as $html) {
            $templated .= $html;
        }
        $authTemplated = '';
        foreach ($this->renderedAuth as $html) {
            $authTemplated .= $html;
        }
        $multi_language = $this->langDropDown?view('partials.multiLanguage',[
            'aLang' =>  App::currentLocale()
        ]):'';

        return view('partials.navBarTemplate',[
            'navLinks' => $templated,
            'authLinks' => $authTemplated,
            'multi_language' => $multi_language
        ]);

    }
    private function build(): void
    {
        $nav = $this;
        include_once NAV_CONFIG_PATH.NAV_ENTRIES_FILE;
        $this->rendered = [];
        foreach ($this->navigation as $link) {
            switch (get_class($link)) {
                case 'App\\Services\\Navigation\\Link':
                    $this->rendered[] = self::buildLink($link);
                    break;
                case 'App\\Services\\Navigation\\Drop':
                    $this->rendered[] = self::buildDrop($link);
                    break;
                case 'App\\Services\\Navigation\\Auth':
                    $this->renderedAuth[] = self::buildAuth($link);
                    break;
                default:
                    die('no matching class found....');
            }
        }
    }
    private function buildAuth(Auth $link): string
    {
//        $usage = Session::get('loggedIn') ? 'USER' : 'GUEST';
//        $usage = 'GUEST';
        $usage = 'USER';
        $authLinks = [];
        foreach ($link->getLinks() as $link_) {
            if ($link_->getUsage() === $usage) {
                $authLinks[] = $link_;
            }
        }
        $authLinksTemplate = '';
        for($i=0; $i<count($authLinks); $i++){
            switch (get_class($authLinks[$i])){
                case 'App\\Services\\Navigation\\ALink':
                    $authLinksTemplate .= view('partials.aLink',[
                        'route' =>  route($authLinks[$i]->getURL(),$authLinks[$i]->getParams()),
                        'avatar' => $authLinks[$i]->getAvatar()
                    ]);
                    break;
                case 'App\\Services\\Navigation\\Link':
                    $lData = [
                        'active' => route($authLinks[$i]->getURL(),$authLinks[$i]->getParams()),
                        'route' =>  route($authLinks[$i]->getURL(),$authLinks[$i]->getParams()),
                        'label' =>  $this->labelTranslate?
                            rawurlencode( __("navBar.".$authLinks[$i]->getLabel())):
                            rawurlencode($authLinks[$i]->getLabel()),
                        'icon' => $authLinks[$i]->getIcon(),
                    ];
                    $authLinksTemplate .= view('partials.link',$lData);
                    break;
            }

        }
        return $authLinksTemplate;
    }
    private function buildLink(Link $link): string
    {
        $lData = [
            'active' => self::isActive(route($link->getURL(),$link->getParams())),
            'route' =>  route($link->getURL(),$link->getParams()),
            'label' => $this->labelTranslate?
                rawurlencode( __("navBar.".$link->getLabel())):
                rawurlencode($link->getLabel()),
            'icon' => $link->getIcon(),
        ];
        return view('partials.link',$lData);
    }
    private function buildDrop(Drop $drop): string
    {
        $active = '';
        $separators = $drop->getSeparator();
        $getSeparator = function()  use(&$separators) {
            if(!empty($separators)){
                return array_shift($separators);
            }
            return false;
        };

        $dropLinksArr = $drop->getLinks();
        $sep =$getSeparator();
        $dropLinks = [];
        for($link=0;$link<count($dropLinksArr);$link++){
            $lData = [
                'active' => self::isActive(route($dropLinksArr[$link]->getURL(),$dropLinksArr[$link]->getParams())),
                'route' => route($dropLinksArr[$link]->getURL(),$dropLinksArr[$link]->getParams()),
                'label' => $this->labelTranslate?
                    rawurlencode(__("navBar.".$dropLinksArr[$link]->getLabel())):
                    rawurlencode($dropLinksArr[$link]->getLabel()),
                'icon' => $dropLinksArr[$link]->getIcon()
            ];
            $dropLinks[] = $lData;
            if($lData['active'] === 'active'){
                $active = 'active';
            }
            if($sep){
                if($link === (int)$sep-1){
                    $dropLinks[] = '<a class="dropLnk separator" href=""></a>';
                    $sep =$getSeparator();
                }
            }
        }
        return view('partials.dropDown',[
            'dropLinks' => $dropLinks,
            'active' => $active,
            'label' =>  $this->labelTranslate?
                rawurlencode(__("navBar.".$drop->getLabel())):
                rawurlencode($drop->getLabel())
        ]);
    }
    private function isActive(string $link): string
    {
        if ($link === "http://$_SERVER[HTTP_HOST]".$this->currentURL) {
            return $this->activeCSS;
        }
        return '';
    }
}
