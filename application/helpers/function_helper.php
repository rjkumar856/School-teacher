<?php
$ci = &get_instance();

if(!isset($error_message)){ $error_message = array(); }

if(!function_exists('errorHandlerCatchUndefinedIndex')){
    function errorHandlerCatchUndefinedIndex($errno='',$errstr='',$errfile='',$errline='') {
        // We are only interested in one kind of error
        $str = '';
        
        if(!isset($error_message)){ $error_message = array(); }
        $error_message[] = array("code"=>$errno,"status"=>"error","message"=>$errstr." in file ".$errfile." at line number ".$errline);
    }
}

if(!function_exists('exceptionHandlerCatchUndefinedIndex')){
    function exceptionHandlerCatchUndefinedIndex($exception) {
        // We are only interested in one kind of error
        $str = '';
        if(!isset($error_message)){ $error_message = array(); }
        $error_message[] = array("code"=>$errno,"status"=>"error","message"=>$exception->getMessage().": file ".$exception->getFile()." at ".$exception->getLine());
    }
}

//Dynamically add Javascript files to header page
if(!function_exists('add_js')){
    function add_js($file='')
    {
        $str = '';
        $header_js = $ci->config->item('header_js');

        if(empty($file)){
            return;
        }

        if(is_array($file)){
            if(!is_array($file) && count($file) <= 0){
                return;
            }
            foreach($file AS $item){
                $header_js[] = $item;
            }
            $ci->config->set_item('header_js',$header_js);
        }else{
            $str = $file;
            $header_js[] = $str;
            $ci->config->set_item('header_js',$header_js);
        }
    }
}

//Dynamically add CSS files to header page
if(!function_exists('add_css')){
    function add_css($file='')
    {
        $str = '';
        $header_css = $ci->config->item('header_css');

        if(empty($file)){
            return;
        }

        if(is_array($file)){
            if(!is_array($file) && count($file) <= 0){
                return;
            }
            foreach($file AS $item){
                $header_css[] = $item;
            }
            $ci->config->set_item('header_css',$header_css);
        }else{
            $str = $file;
            $header_css[] = $str;
            $ci->config->set_item('header_css',$header_css);
        }
    }
}

//Putting our CSS and JS files together
if(!function_exists('put_headers')){
    function put_headers()
    {
        $str = '';
        $header_css = $ci->config->item('header_css');
        $header_js  = $ci->config->item('header_js');

        foreach($header_css AS $item){
            $str .= '<link rel="stylesheet" href="'.base_url().'css/'.$item.'" type="text/css" />'."\n";
        }

        foreach($header_js AS $item){
            if (filter_var($item, FILTER_VALIDATE_URL)) {
                $str .= '<script type="text/javascript" src="'.$item.'"></script>'."\n";
            }else{
                $str .= '<script type="text/javascript" src="'.base_url().'assets/js/'.$item.'"></script>'."\n";
            }
        }

        return $str;
    }
}

//Putting our CSS and JS files together
if(!function_exists('load_js')){
    function load_js(){
        $str = '';
        $header_js  = $ci->config->item('header_js');

        foreach($header_js AS $item){
            if (filter_var($item, FILTER_VALIDATE_URL)) {
                $str .= '<script type="text/javascript" src="'.$item.'"></script>'."\n";
            }else{
                $str .= '<script type="text/javascript" src="'.base_url().'assets/js/'.$item.'"></script>'."\n";
            }
        }

        return $str;
    }
}
