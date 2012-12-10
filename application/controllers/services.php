<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Services extends CI_Controller {

	public function index()
	{
		$this->load->library('xmlrpc');
		$this->xmlrpc->server('http://localhost:9001/RPC2', 9001);
		$this->xmlrpc->method('supervisor.getAllProcessInfo');
		$this->xmlrpc->request(array());
		if ( ! $this->xmlrpc->send_request())
		{
		    echo json_encode(array(
		    		'id' => '',
		    		'soffice' => 'Unkown',
		    		'httpsqs' => 'Unkown',
		    		'office2pdf' => 'Unkown',
		    		'pdf2swf' => 'Unkown'
		    	));
		}
		else
		{
			$services = array('id' => '');
			$result = $this->xmlrpc->display_response();
			foreach ($result as $service)
			{
				$services[$service['name']] = $service['statename'];
			}
			echo json_encode($services);
		}
	}

	public function _remap($method, $params = array())
	{
		$this->index();
	}

}

/* End of file services.php */
/* Location: ./application/controllers/services.php */