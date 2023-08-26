<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Barcode extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
		
    }
    public function index()
	{
		$temp = rand(10000, 99999);
		$this->data['barcode']= $this->set_barcode();
		$this->load->view('/welcome',$this->data);
	}
	
	
	function barcode($product_code = NULL) 
	{
        if ($this->input->get('code')) {
            $product_code = $this->input->get('code');
        }

        $data['product_details'] = $this->products_model->getProductByCode($product_code);
        $data['img'] = "<img src='" . base_url() . "index.php?products/gen_barcode&code={$product_code}' alt='{$product_code}' />";
        $this->load->view('barcode', $data);

    }

    function product_barcode($product_code = NULL, $bcs = 'code39', $height = 80) {
        if ($this->input->get('code')) {
            $product_code = $this->input->get('code');
        }
        return "<img src='".base_url()."barcode/gen_barcode/{$product_code}/{$bcs}/{$height}' alt='{$product_code}' />";
    }

    function gen_barcode($product_code = NULL, $bcs = 'code128', $height = 80, $text = 1) {
        $drawText = ($text != 1) ? FALSE : TRUE;
        $this->load->library('zend');
        $this->zend->load('Zend/Barcode');
        $barcodeOptions = array('text' => $product_code, 'barHeight' => $height, 'drawText' => $drawText);
        $rendererOptions = array('imageType' => 'png', 'horizontalPosition' => 'center', 'verticalPosition' => 'middle');
        $imageResource = Zend_Barcode::render($bcs, 'image', $barcodeOptions, $rendererOptions);
        return $imageResource;
    }
	
} 
?>