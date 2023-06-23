<?php

namespace Modules\Admin\Controllers;

use Modules\Admin\Controllers\AdminController;
use Modules\Admin\Models\IboModel;

class TreeController extends AdminController {

    public function __construct() {
        parent::__construct();
        $this->iboModel = new IboModel();
    }

    public function sponsorview() {
        $this->data['title'] = 'Referred Member View';
        $this->data['js'] = 'datatable';
        $this->data['css'] = 'datatable';
        $this->data['includefile'] = 'tree/sponsorshipview.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\tree\sponsorshipview', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function sponshorshipdata() {
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $code = trim($this->request->getPost('code'));
            $level = trim($this->request->getPost('level'));
            $data = array('code' => $code, 'level' => $level);
            $treedata = $this->iboModel->selectSponsorship($data, $offset, $limit);
            $returndata['data'] = $this->fn_formatedAddSlNo($treedata['data'], $offset);
            $returndata['draw'] = $draw;

            $returndata['recordsTotal'] = $treedata['record_count'];
            $returndata['recordsFiltered'] = $treedata['record_count'];
        }
        echo json_encode($returndata);
        die();
    }
}
