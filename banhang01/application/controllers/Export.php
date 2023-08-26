<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Export Controller
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Export extends CI_Controller {

    // construct
    public function __construct() {
        parent::__construct();
        // load model
        //$this->load->model('Export_model', 'export');
		$this->load->model('export_model');
    }

    // export xlsx|xls file
    public function index() {
        $data['page'] = 'export-excel';
        $data['title'] = 'Export Excel data | TechArise';
        $data['employeeInfo'] = $this->export_model->ExportSanPham();
        // load view file for output

        //$this->load->view('export/index', $data);
    }

    // create xlsx
    public function createXLS() {
        // create file name
        $fileName = 'SanPham-' . time() . '.xlsx';
        // load excel library
        $this->load->library('excel');
        $spInfo = $this->export_model->ExportSanPham();

        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ID');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Mã');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Tên');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Giá vốn');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Giá thị trường');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Giá bán');
        // set Row
        $rowCount = 2;
        foreach ($spInfo as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['sp_id']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['sp_ma']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['sp_ten']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['sp_gia_von']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['sp_gia_thi_truong']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['sp_gia_ban']);
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save(ROOT_UPLOAD_IMPORT_PATH.$fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(HTTP_UPLOAD_IMPORT_PATH.$fileName);
    }
	// create xlsx
    public function generateXLS() 
	{
        // create file name
        $fileName = 'data-'.time().'.xlsx';  
        // load excel library
        $this->load->library('excel');
        $listInfo = $this->export_model->ExportSanPham();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ID');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Tên');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Giá vốn');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Gía thị trường');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Giá bán');       
        // set Row
        $rowCount = 2;
        foreach ($listInfo as $list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list["sp_id"]);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list["sp_ten"]);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list["sp_gia_von"]);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list["sp_gia_thi_truong"]);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list["sp_gia_ban"]);
            $rowCount++;
        }
		/*
        $filename = "tutsmake". date("Y-m-d-H-i-s").".csv";
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');  
        $objWriter->save('php://output');*/
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="SanPham'.date("Y-m-d-H-i-s").'.xls"');
		header('Cache-Control: max-age=0');
		$objWriter->save('php://output');
 
    }
}
