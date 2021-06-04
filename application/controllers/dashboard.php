<?php

class Dashboard extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('m_menu');
        $this->load->model('m_order');

        if(!isset($_SESSION['logged_in']['username']) && $_SESSION['logged_in']['aktivasi'] != '1'){                                
            redirect('Login');
        } else {
            if ($_SESSION['logged_in']['role'] == '5') {
                redirect();
            }
        }
    }

    public function index() {
        $array['menuparent'] = $this->m_menu->GetMenuParent();
        $array['menuchild'] = $this->m_menu->GetMenuChild();

        $data['getKategori'] = $this->m_order->getKategori('PHP');
        $this->load->view('templates_backend/v_header', $array);
        $this->load->view('templates_backend/v_main', $data);
        $this->load->view('templates_backend/v_footer');
    }
}