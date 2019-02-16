<?php
 
 
defined('BASEPATH') OR exit('No direct script access allowed');

// Code written by TangleSkills

class SmsController extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		  $this->load->helper('url');
    }
	
	public function index()
	{
		$data['img_url']="";
		if($this->input->post('action') && $this->input->post('action') == "generate_qrcode")
		{
			$this->load->library('ciqrcode');
			$qr_image=rand().'.png';
			$params['data'] = $this->input->post('qr_text');
			$params['level'] = 'H';
			$params['size'] = 8;
			$params['savename'] =FCPATH."uploads/qr_image/".$qr_image;
			if($this->ciqrcode->generate($params))
			{
				$data['img_url']=$qr_image;	
			}
		}
		$this->load->view('qrcode',$data);
	}

	public function sendSms()
	{
 
		$this->load->library('twilio');
		// $sms_sender = trim($this->input->post('sms_sender'));
		// $sms_reciever = $this->input->post('sms_recipient');
		// $sms_message = trim($this->input->post('sms_message'));
		$sms_sender = "918859135266";
		$sms_reciever = "919780979631";
		$sms_message = "hello";

		$from = '+'.$sms_sender; //trial account twilio number
		$to = '+'.$sms_reciever; //sms recipient number
		$response = $this->twilio->sms($from, $to,$sms_message);
		
		echo "<pre>"; print_r($response); 
		if($response->IsError){
		 
		echo 'Sms Has been Not sent';
		}
		else{
			echo 'Sms Has been sent';
		}
	}
}
