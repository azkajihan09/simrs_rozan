<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

class Pdf extends Dompdf {

    public function __construct()
    {
        parent::__construct();

        
    }
    public function cetak($billing_id)
{

    $data['billing'] =
        $this->M_billing->detail(
            $billing_id
        );

    $data['detail'] =
        $this->M_billing->detail_item(
            $billing_id
        );

    $this->load->library('pdf');

    $html = $this->load->view(
        'billing/cetak',
        $data,
        true
    );

    $this->pdf->loadHtml($html);

    $this->pdf->setPaper(
        'A4',
        'portrait'
    );

    $this->pdf->render();

    $this->pdf->stream(
        'billing-'.$billing_id.'.pdf',
        ['Attachment' => false]
    );
}

    

    

}