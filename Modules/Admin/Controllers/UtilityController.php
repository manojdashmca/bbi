<?php

namespace Modules\Admin\Controllers;

use Modules\Admin\Controllers\AdminController;
use Modules\Admin\Models\UtilityModel;

class UtilityController extends AdminController {

    public function __construct() {
        parent::__construct();
        $this->utilityModel = new UtilityModel();
    }  

    public function galleryList() {
        $this->data['title']="Album List";
        $this->data['js'] = 'validation,flatpickr,datatable,sweetalert';
        $this->data['css'] = 'validation,flatpickr,datatable,sweetalert';
        $this->data['includefile'] = 'utility/galleryList.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\utility\galleryList', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function galleryData() {
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $name = trim($this->request->getPost('name'));
            $email = trim($this->request->getPost('email'));
            $mobile = trim($this->request->getPost('mobile'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];
            //$this->request->getPost('status') != '' ? $status = implode(',', $this->request->getPost('status')) : $status = '';
            $daterange = generateDateFromDateRange($this->request->getPost('daterange'));
            $data = array('name' => $name, 'email' => $email, 'mobile' => $mobile, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
            $userlist = $this->utilityModel->selectAlbums($data, $ordercolumn, $orderdirecttion, $offset, $limit);
            $returndata['data'] = $this->fn_formatedgalleryData($userlist['data'], $offset);
            $returndata['draw'] = $draw;
            $returndata['recordsTotal'] = $userlist['record_count'];
            $returndata['recordsFiltered'] = $userlist['record_count'];
        }
        echo json_encode($returndata);
        die();
    }

    public function fn_formatedgalleryData($data, $offset) {
        $return = array();
        $arraydata = (array) $data;
        for ($x = 0; $x < count($arraydata); $x++) {
            $values = array();
            $action = '';

            $action .= '<a class="blue" target="_blank" title="Album Image"   href="' . ADMINPATH . 'album-image-show/' . base64_encode($data[$x]->album_id) . '"><i class=" fas fa-search"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';

            if ($data[$x]->status == 'Active') {
                $action .= '<a class="blue" title="Block Album" href="#" onclick="return updateStatus(&#39;' . base64_encode($data[$x]->album_id) . '&#39;,2);"><i class="fas fa-lock"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            }if ($data[$x]->status == 'In-Active') {
                $action .= '<a class="blue"  title="Unblock Album" href="#" onclick="return updateStatus(&#39;' . base64_encode($data[$x]->album_id) . '&#39;,1);"><i class="fas fa-lock-open"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            }
            $action .= '<a class="blue"  title="Delete User" href="#" onclick="return updateStatus(&#39;' . base64_encode($data[$x]->album_id) . '&#39;,3);"><i class="fas fa-trash"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            $action .= '<a class="blue"  title="Upload Image" href="uploadto-gallery/' . base64_encode($data[$x]->album_id) . '" target="__blank"><i class="fas fa-cloud-upload-alt"></i></a>';
            $arraydata[$x]->action = $action;
            $values = array_values((array) $arraydata[$x]);
            $values[0] = $offset + $x + 1;
            $return[] = $values;
        }

        return $return;
    }

    public function webcontact() {
        $this->data['title']="Web Contact";
        $this->data['js'] = 'flatpickr,datatable';
        $this->data['css'] = 'flatpickr,datatable';
        $this->data['includefile'] = 'utility/webcontact.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\utility\webcontact', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function webcontactData() {
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $name = trim($this->request->getPost('name'));
            $email = trim($this->request->getPost('email'));
            $mobile = trim($this->request->getPost('mobile'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];
            //$this->request->getPost('status') != '' ? $status = implode(',', $this->request->getPost('status')) : $status = '';
            $daterange = generateDateFromDateRange($this->request->getPost('daterange'));
            $data = array('name' => $name, 'email' => $email, 'mobile' => $mobile, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
            $userlist = $this->utilityModel->selectWebcontact($data, $ordercolumn, $orderdirecttion, $offset, $limit);
            $returndata['data'] = $this->fn_formatedwebcontactData($userlist['data'], $offset);
            $returndata['draw'] = $draw;
            $returndata['recordsTotal'] = $userlist['record_count'];
            $returndata['recordsFiltered'] = $userlist['record_count'];
        }
        echo json_encode($returndata);
        die();
    }

    public function fn_formatedwebcontactData($data, $offset) {
        $return = array();
        $arraydata = (array) $data;
        for ($x = 0; $x < count($arraydata); $x++) {
            $values = array();
            $values = array_values((array) $arraydata[$x]);
            $values[0] = $offset + $x + 1;
            $return[] = $values;
        }

        return $return;
    }

    public function startamodule() {
        $this->data['title']="Start A Module Data";
        $this->data['js'] = 'flatpickr,datatable';
        $this->data['css'] = 'flatpickr,datatable';
        $this->data['includefile'] = 'utility/startamodule.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\utility\startamodule', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function startamoduleData() {
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $name = trim($this->request->getPost('name'));
            $email = trim($this->request->getPost('email'));
            $mobile = trim($this->request->getPost('mobile'));
            $area = trim($this->request->getPost('area'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];
            //$this->request->getPost('status') != '' ? $status = implode(',', $this->request->getPost('status')) : $status = '';
            $daterange = generateDateFromDateRange($this->request->getPost('daterange'));
            $data = array('name' => $name, 'area' => $area, 'mobile' => $mobile, 'email' => $email, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
            $userlist = $this->utilityModel->selectStartamodule($data, $ordercolumn, $orderdirecttion, $offset, $limit);
            $returndata['data'] = $this->fn_formatedstartamoduleData($userlist['data'], $offset);
            $returndata['draw'] = $draw;
            $returndata['recordsTotal'] = $userlist['record_count'];
            $returndata['recordsFiltered'] = $userlist['record_count'];
        }
        echo json_encode($returndata);
        die();
    }

    public function fn_formatedstartamoduleData($data, $offset) {
        $return = array();
        $arraydata = (array) $data;
        for ($x = 0; $x < count($arraydata); $x++) {
            $values = array();
            $values = array_values((array) $arraydata[$x]);
            $values[0] = $offset + $x + 1;
            $return[] = $values;
        }
        return $return;
    }

    public function uploadtogallery($albumid = '') {
        $this->data['title']="Upload Image To Album";
        $this->data['js'] = 'dropzone,validate';
        $this->data['css'] = 'dropzone,validate';
        $album = $this->blankModel->getTableData('album_name', 'album', 'album_id=' . base64_decode($albumid));
        $this->data['albumname'] = $album->album_name;
        $this->data['albumid'] = $albumid;
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\utility\uploadtogallery', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function updateAlbumStatus() {
        $status = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {
            $id = base64_decode($this->request->getPost('encid'));
            $status = $this->request->getPost('status');
            $updarray = array('album_status' => $status);
            if ($status == 1) {
                $message = "Album Activated Successfully";
            }if ($status == 2) {
                $message = "Album Deactivated Successfully";
            }if ($status == 3) {
                $allimage = $this->utilityModel->getAllImagesOfAlbum($id);
                for ($x = 0; $x < count($allimage); $x++) {
                    $imagepath = './uploads/images/gallery/' . $allimage[$x]->photo_path;
                    @unlink($imagepath);
                }
                if (!empty($allimage)) {
                    $updarrayimg = array('photo_status' => 3);
                    $this->blankModel->updateRecordInTable($updarrayimg, 'album_has_photo', 'album_id_album', $id);
                }
                $message = "Album Deleted Successfully";
            }

            $this->adminModel->updateRecordInTable($updarray, 'album', 'album_id', $id);
            $data = array('status' => 'success', 'message' => $message);
        }
        echo json_encode($data);
        exit;
    }

    public function updateImageStatus() {
        $status = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {
            $id = base64_decode($this->request->getPost('encid'));
            $status = $this->request->getPost('status');
            $updarray = array('photo_status' => $status);
            if ($status == 1) {
                $message = "Album Activated Successfully";
            }if ($status == 2) {
                $message = "Album Deactivated Successfully";
            }if ($status == 3) {
                $message = "Album Deleted Successfully";
                $imagedata = $this->blankModel->getTableData('photo_path', 'album_has_photo', 'ahp_id=' . $id);
                $imagepath = './uploads/images/gallery/' . $imagedata->photo_path;
                @unlink($imagepath);
            }

            $this->adminModel->updateRecordInTable($updarray, 'album_has_photo', 'ahp_id', $id);
            $data = array('status' => 'success', 'message' => $message);
        }
        echo json_encode($data);
        exit;
    }

    public function viewAlbum($albumid = '') {
        $this->data['title']="View Album";
        $this->data['js'] = 'lightbox,sweetalert';
        $this->data['css'] = 'lightbox,sweetalert';
        $this->data['includefile'] = 'utility/viewAlbum.php';
        $album = $this->blankModel->getTableData('album_name', 'album', 'album_id=' . base64_decode($albumid));
        $albumimages = $this->utilityModel->getAllImagesOfAlbum(base64_decode($albumid));
        $this->data['albumname'] = $album->album_name;
        $this->data['albumimages'] = $albumimages;
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\utility\viewAlbum', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function addaAlbum() {
        $status = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {
            $albumname = $this->request->getPost('albumname');
            $createarray = array('album_name' => $albumname, 'album_status' => 2);

            $this->adminModel->createRecordInTable($createarray, 'album');
            $status = "success";
            $message = "Album added successfully";
            $data = array('status' => $status, 'message' => $message);
        }
        echo json_encode($data);
        exit;
    }
}
