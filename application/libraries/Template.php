<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Template 
{
    var $ci;
    private $_data = array();
        
    function __construct() 
    {
        $this->ci =& get_instance();
    }

    function load($tpl_view, $body_view = null, $data = null) 
    {
        if ( ! is_null( $body_view ) ) 
        {
            if ( file_exists( APPPATH.'views/'.$tpl_view.'/'.$body_view ) ) 
            {
                $body_view_path = $tpl_view.'/'.$body_view;
            }
            else if ( file_exists( APPPATH.'views/'.$tpl_view.'/'.$body_view.'.php' ) ) 
            {
                $body_view_path = $tpl_view.'/'.$body_view.'.php';
            }
            else if ( file_exists( APPPATH.'views/'.$body_view ) ) 
            {
                $body_view_path = $body_view;
            }
            else if ( file_exists( APPPATH.'views/'.$body_view.'.php' ) ) 
            {
                $body_view_path = $body_view.'.php';
            }
            else
            {
                show_error('Unable to load the requested file: ' . $tpl_name.'/'.$view_name.'.php');
            }
             
            $body = $this->ci->load->view($body_view_path, $data, TRUE);
             
            if ( is_null($data) ) 
            {
                $data = array('body' => $body);
            }
            else if ( is_array($data) )
            {
                $data['body'] = $body;
            }
            else if ( is_object($data) )
            {
                $data->body = $body;
            }
        }
         
        $this->ci->load->view(''.$tpl_view, $data);
    }

    public function set($name, $value = NULL)
    {
        // Lots of things! Set them all
        if (is_array($name) OR is_object($name))
        {
            foreach ($name as $item => $value)
            {
                $this->_data[$item] = $value;
            }
        }

        // Just one thing, set that
        else
        {
            $this->_data[$name] = $value;
        }

        return $this;
    }
}