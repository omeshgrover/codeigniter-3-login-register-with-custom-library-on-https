<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Layout
{
    private $data;
    private $type; // Either user Or admin
    private $js_file;
    private $css_file;
    private $CI;

    public function __construct($params) {
        $this->CI = &get_instance();
        $this->CI->load->helper(array('form','url'));

        $this->type = $params['type'];

        // default CSS and JS that they must be load in any pages
        $this->addCSS( base_url('assets/css/bootstrap.min.css') ); // v3.3.0
        $this->addCSS( base_url('assets/css/font-awesome.min.css') ); // v4.7.0
        $this->addCSS( base_url('assets/css/'.$this->type.'/style.css') ); // custom
        
        $this->addJS( base_url('assets/js/jquery.min.js') ); // v3.3.0
        $this->addJS( base_url('assets/js/bootstrap.min.js') ); // v3.3.0
        $this->addJS( base_url('assets/js/'.$this->type.'/custom.js') ); // custom
    }

    public function show($folder, $file, $data=array(), $menu=true, $sidebar=true) {
        if ( ! file_exists('application/views/files/'.$this->type.'/'.strtolower($folder).'/'.$file.'.php' ) ) {
            show_404();
        } else {            
            $this->load_JS_and_CSS();
            $this->load_header_footer($data, $menu, $sidebar);
            
            $this->data['content'] = $this->CI->load->view('files/'.$this->type.'/'.strtolower($folder).'/'.$file.'.php', $data, true);            
            $this->CI->load->view('layout/'.$this->type.'/'.'template.php', $this->data);
        }
    }

    public function addJS($name) {
        $js = new stdClass();
        $js->file = $name;
        $this->js_file[] = $js;
    }

    public function addCSS($name) {
        $css = new stdClass();
        $css->file = $name;
        $this->css_file[] = $css;
    }

    private function load_JS_and_CSS() {
        $this->data['head'] = '';

        if(!empty($this->css_file)) {
            foreach($this->css_file as $css) {
                $this->data['head'] .= "<link rel='stylesheet' type='text/css' href=".$css->file." />". "\n";
            }
        }

        if(!empty($this->js_file)) {
            foreach($this->js_file as $js) {
                $this->data['head'] .= "<script type='text/javascript' src=".$js->file."></script>". "\n";
            }
        }
    }

    private function load_header_footer($data, $menu, $sidebar) {
        $custom['menu'] = $this->init_menu($data, $menu);
        $custom['sidebar'] = $this->init_sidebar($data, $sidebar);        

        $this->data['header'] = $this->CI->load->view('layout/'.$this->type.'/'.'header.php', $custom, true);
        $this->data['footer'] = $this->CI->load->view('layout/'.$this->type.'/'.'footer.php', '', true);
    }

    private function init_menu($data, $menu) {
        if ($menu) $res = $this->CI->load->view('layout/'.$this->type.'/'.'menu.php', $data, true);
        else $res = '';

        return $res;
    }

    private function init_sidebar($data, $sidebar) {
        if ($sidebar) $res = $this->CI->load->view('layout/'.$this->type.'/'.'sidebar.php', $data, true);
        else $res = '';

        return $res;
    }
}