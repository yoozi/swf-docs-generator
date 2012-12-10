<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Docs extends CI_Controller {

	public function index()
	{
		$docs = $this->db->get('docs')->result();
		echo json_encode($docs);
	}

	private function get($id = 0)
	{
		echo json_encode($this->db->where('id', $id)->get('docs')->row());
	}

	public function _remap($method, $params = array())
	{
		if (preg_match('/^\d+$/', $method))
		{
			$this->get($method);
		}
		else
		{
			$this->index();
		}
	}

}

/* End of file docs.php */
/* Location: ./application/controllers/docs.php */