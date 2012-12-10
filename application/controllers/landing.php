<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Landing extends CI_Controller {

	public function index()
	{
		$this->load->view('landing');
	}

	public function show($id = 0)
	{
		$data['doc'] = $this->db->where('id', $id)->get('docs')->row();
		if (! $data['doc'] || $data['doc']->status != 'success')
		{
			$this->session->set_flashdata('msg', '该文档当前不能访问，请稍后重试.');
			redirect();
		}
		$this->load->view('show', $data);
	}

	public function upload()
	{
		$folder = date('Y/m/', time());
		$config['upload_path'] = '../data/'.$folder;
		//判断此文件夹是否存在，不存在则进行创建
		if ( ! is_dir($config['upload_path']))
		{
			mkdir($config['upload_path'], 0755, TRUE);
		}
		$config['allowed_types'] = 'doc|docx|xls|xlsx|ppt|pptx|pdf';
		$config['max_size'] = '2048';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('file'))
		{
			$this->session->set_flashdata('msg', $this->upload->display_errors('', ''));
			redirect();
		} 
		else
		{
			$uploaded = $this->upload->data();
			$doc = array();
			$doc['name'] = str_replace($uploaded['file_ext'], '', $uploaded['orig_name']);;
			$doc['type'] = str_replace('.', '', $uploaded['file_ext']);
			$doc['size'] = $uploaded['file_size'];
			$doc['origin_path'] = $folder.$uploaded['file_name'];
			$doc['path'] = '';
			$doc['status'] = 'pending';
			if ($this->db->insert('docs', $doc) AND $doc_id = $this->db->insert_id())
			{
				$queue_data = json_encode(array(
						'id' => $doc_id,
						'folder' => $folder,
						'raw_name' => str_replace($uploaded['file_ext'], '', $uploaded['file_name']),
						'name' => $uploaded['file_name']
					));
				//将文件入转换队列
				include FCPATH.'../scripts/httpsqs/httpsqs_client.php';
				$httpsqs = new httpsqs('127.0.0.1', 1218);
				if ($doc['type'] === 'pdf')
				{
					$httpsqs->put('pdf2swf', $queue_data);
				}
				else
				{
					$httpsqs->put('office2pdf', $queue_data);
				}
				$this->session->set_flashdata('msg', '文件上传成功.');
				redirect();
			}
			else
			{
				$this->session->set_flashdata('msg', '上传失败');
				redirect();
			}
		}
	}
}

/* End of file landing.php */
/* Location: ./application/controllers/landing.php */