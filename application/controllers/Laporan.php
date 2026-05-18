<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        cek_login();
      

        $this->load->model('M_laporan');
    }

    /*
    |--------------------------------------------------------------------------
    | LAPORAN PENDAPATAN
    |--------------------------------------------------------------------------
    */

    public function pendapatan()
    {

        $tanggal_awal =
            $this->input->get(
                'tanggal_awal'
            );

        $tanggal_akhir =
            $this->input->get(
                'tanggal_akhir'
            );

        if(empty($tanggal_awal)){

            $tanggal_awal =
                date('Y-m-01');

        }

        if(empty($tanggal_akhir)){

            $tanggal_akhir =
                date('Y-m-d');

        }

        $data['title'] =
            'Laporan Pendapatan';

        $data['laporan'] =
            $this->M_laporan->pendapatan(
                $tanggal_awal,
                $tanggal_akhir
            );

        $data['total'] =
            $this->M_laporan
                ->total_pendapatan(
                    $tanggal_awal,
                    $tanggal_akhir
                );

        $data['tanggal_awal'] =
            $tanggal_awal;

        $data['tanggal_akhir'] =
            $tanggal_akhir;

        $this->load->view(
            'laporan/pendapatan',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PAYROLL DOKTER
    |--------------------------------------------------------------------------
    */

    public function jasa_dokter()
    {

        $data['title'] =
            'Jasa Dokter';

        $data['laporan'] =
            $this->M_laporan
                ->jasa_dokter();

        $this->load->view(
            'laporan/jasa_dokter',
            $data
        );
    }

    public function export_pendapatan()
{

    $this->load->library('Spreadsheet');

    $laporan = $this->db
        ->where('status','LUNAS')
        ->get('billing')
        ->result();

    $spreadsheet =
        new \PhpOffice\PhpSpreadsheet\Spreadsheet();

    $sheet =
        $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'Kode Billing');
    $sheet->setCellValue('B1', 'Pasien');
    $sheet->setCellValue('C1', 'Total');
    $sheet->setCellValue('D1', 'Status');

    $row = 2;

    foreach($laporan as $l){

        $sheet->setCellValue(
            'A'.$row,
            $l->kode_billing
        );

        $sheet->setCellValue(
            'B'.$row,
            $l->pasien_id
        );

        $sheet->setCellValue(
            'C'.$row,
            $l->total_bayar
        );

        $sheet->setCellValue(
            'D'.$row,
            $l->status
        );

        $row++;
    }

    $writer =
        new \PhpOffice\PhpSpreadsheet\Writer\Xlsx(
            $spreadsheet
        );

    header(
        'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    );

    header(
        'Content-Disposition: attachment;filename="laporan_pendapatan.xlsx"'
    );

    $writer->save('php://output');
}

}