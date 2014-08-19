<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bunny_test extends CI_Controller{
    
    
    /**
     * Language
     */
    var $language;

    /**
     * Constructor
     */
    public function __construct(){
        parent::__construct();
        
        if($this->input->cookie('language', TRUE)==''){
            $cookie = array(
                'name'   => 'language',
                'value'  => 'spanish',
                'expire' => '1296000'
            );
            $this->input->set_cookie($cookie);
        }
        $this->language = $this->input->cookie('language', TRUE);
        $this->lang->load('common', $this->language);
        $this->load->helper(array('form', 'url'));
    }
    
    /**
     * Does the index
     */
    public function do_index( $page ){

        $this->lang->load('homepage', $this->language);

    }
    
    /**
     * Shows the index page
     */
    public function index(){

        $this->do_index('bus');
    }

/**
 * EJERCICIO VOICE BUNNY BUSCAR UN ARTICULO EN REDDIT
 */
	public function find_trendy() {

// CONSEGUIMOS UN ARTICULO DE REDDIT
		$url = "http://www.reddit.com/search.json?q=ferrari";	

		$ch=curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER,array(		
'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
//'Accept-Encoding:gzip,deflate,sdch',
'Accept-Language:es-ES,es;q=0.8',
'Cache-Control:max-age=0',
'Connection:keep-alive',
'Cookie:__cfduid=d9146544001036a07a30cb7f1eafe98851407767666373; __utma=55650728.12496133.1408457743.1408457743.1408458399.2; __utmb=55650728.5.9.1408458584351; __utmc=55650728; __utmz=55650728.1408458399.2.2.utmcsr=google|utmccn=(organic)|utmcmd=organic|utmctr=(not%20provided)',
'Host:www.reddit.com',
'User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36',
'Query String Parametersview sourceview URL encoded'));
		$result = curl_exec($ch);
		curl_close($ch);

// CARGAMOS CONTENIDO
		$data['trendy'] = str_replace("'", "", $result);
    	$this->load->view('bunny_article_view', $data);
    } 		
    
/**
 * EJERCICIO VOICE BUNNY LEER UN ARTICULO EN REDDIT
 */
	public function read_trendy($title, $script) {

// CREAMOS UN 'SPEEDY' DE VOICE BUNNY
		//$url = "https://34547:53562369207dd6bef379c0fa4d235745@api.voicebunny.com/projects/addSpeedy";
		$voicebunnyUser = '34547';
		$voicebunnyToken = '53562369207dd6bef379c0fa4d235745';
		$url_api = 'https://api.voicebunny.com/projects/addSpeedy';
		$postVars = array(
			'title' => $title,
			'script' => $script,
			'test' => 1
		);
		$vars = http_build_query($postVars);
		$opts = array(
			CURLOPT_URL => $url_api,
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_INFILESIZE => -1,
			CURLOPT_TIMEOUT => 60,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_POST => TRUE,
			CURLOPT_POSTFIELDS => $vars,
			CURLOPT_USERPWD => $voicebunnyUser . ':' . $voicebunnyToken,
		);
		$curl = curl_init();
		curl_setopt_array($curl, $opts);
		$result = curl_exec($curl);
		$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);

// CARGAMOS CONTENIDO
		$data['voice'] = str_replace("'", "", $result);
    	$this->load->view('bunny_voice_view', $data);
    } 		    
}
                   