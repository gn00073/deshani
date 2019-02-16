<?php
defined('BASEPATH') OR exit('');

/**
 * Description of Reports
 *
 * @author Amir <amirsanni@gmail.com>
 * @date 20th Rab. Awwal, 1437AH
 * @date 1st Jan, 2016
 */
class Reports extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        // error_reporting(0);
        $this->genlib->checkLogin();
        $this->load->model(['item', 'transaction', 'analytic']);
        $this->genlib->superOnly();
    }
    
    
    /*
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    ********************************************************************************************************************************
    */
    
    public function index(){

       
        $data['totalItems'] = $this->db->count_all('items');
        $data['totalSalesToday'] = (int)$this->analytic->totalSalesToday();
        $data['totalTransactions'] = $this->transaction->totalTransactions();
        $data['dailyTransactions'] = $this->analytic->getDailyTrans();
        $data['transByDays'] = $this->analytic->getTransByDays();
        $data['transByMonths'] = $this->analytic->getTransByMonths();
        $data['transByYears'] = $this->analytic->getTransByYears();

        $data['pageContent'] = $this->load->view('reports', $data, TRUE);
        $data['pageTitle'] = "Reports";
        
        $this->load->view('main', $data);
    }
}