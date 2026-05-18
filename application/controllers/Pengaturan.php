<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        cek_login();

        $this->load->model('M_pengaturan');

        $this->load->library([
            'form_validation',
            'upload'
        ]);

        $this->load->helper([
            'url',
            'form',
            'download'
        ]);

        $this->load->dbutil();
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data['title'] = 'Pengaturan SIMRS';

        $data['setting'] =
        $this->M_pengaturan->get_all();

        $this->load->view(
            'pengaturan/index',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL
    |--------------------------------------------------------------------------
    */

    public function detail($id)
    {
        $data['title'] =
        'Detail Pengaturan';

        $data['detail'] =
        $this->M_pengaturan
        ->detail($id);

        if(!$data['detail']){

            show_404();
        }

        $this->load->view(
            'pengaturan/detail',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAH
    |--------------------------------------------------------------------------
    */

    public function tambah()
    {
        $data['title'] =
        'Tambah Pengaturan';

        $this->form_validation->set_rules(
            'nama_klinik',
            'Nama Klinik',
            'required'
        );

        if(
            $this->form_validation->run()
            == FALSE
        ){

            $this->load->view(
                'pengaturan/tambah',
                $data
            );

        }else{

            /*
            |--------------------------------------------------------------------------
            | CREATE FOLDER
            |--------------------------------------------------------------------------
            */

            if(!is_dir('./upload/logo')){

                mkdir(
                    './upload/logo',
                    0777,
                    true
                );
            }

            if(!is_dir('./upload/favicon')){

                mkdir(
                    './upload/favicon',
                    0777,
                    true
                );
            }

            /*
            |--------------------------------------------------------------------------
            | UPLOAD LOGO
            |--------------------------------------------------------------------------
            */

            $logo = '';

            if(
                !empty($_FILES['logo']['name'])
            ){

                $config['upload_path'] =
                './upload/logo/';

                $config['allowed_types'] =
                'jpg|jpeg|png';

                $config['encrypt_name'] =
                TRUE;

                $this->upload->initialize(
                    $config
                );

                if(
                    $this->upload
                    ->do_upload('logo')
                ){

                    $logo =

                    $this->upload
                    ->data('file_name');
                }
            }

            /*
            |--------------------------------------------------------------------------
            | UPLOAD FAVICON
            |--------------------------------------------------------------------------
            */

            $favicon = '';

            if(
                !empty($_FILES['favicon']['name'])
            ){

                $config2['upload_path'] =
                './upload/favicon/';

                $config2['allowed_types'] =
                'png|ico';

                $config2['encrypt_name'] =
                TRUE;

                $this->upload->initialize(
                    $config2
                );

                if(
                    $this->upload
                    ->do_upload('favicon')
                ){

                    $favicon =

                    $this->upload
                    ->data('file_name');
                }
            }

            /*
            |--------------------------------------------------------------------------
            | INSERT
            |--------------------------------------------------------------------------
            */

            $simpan = [

                'nama_klinik' =>

                $this->input->post(
                    'nama_klinik',
                    TRUE
                ),

                'alamat' =>

                $this->input->post(
                    'alamat',
                    TRUE
                ),

                'telepon' =>

                $this->input->post(
                    'telepon',
                    TRUE
                ),

                'email' =>

                $this->input->post(
                    'email',
                    TRUE
                ),

                'tema' =>

                $this->input->post(
                    'tema',
                    TRUE
                ),

                'dark_mode' =>

                $this->input->post(
                    'dark_mode',
                    TRUE
                ),

                'sidebar' =>

                $this->input->post(
                    'sidebar',
                    TRUE
                ),

                'nomor_rm_prefix' =>

                $this->input->post(
                    'nomor_rm_prefix',
                    TRUE
                ),

                'nomor_antrian_prefix' =>

                $this->input->post(
                    'nomor_antrian_prefix',
                    TRUE
                ),

                'logo' => $logo,

                'favicon' => $favicon,

                'created_at' =>

                date('Y-m-d H:i:s')
            ];

            $this->M_pengaturan
            ->simpan($simpan);

            $this->session->set_flashdata(

                'success',

                'Pengaturan berhasil ditambahkan'
            );

            redirect('pengaturan');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $data['title'] =
        'Edit Pengaturan';

        $data['detail'] =
        $this->M_pengaturan
        ->detail($id);

        if(!$data['detail']){

            show_404();
        }

        $this->load->view(
            'pengaturan/edit',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update($id = null)
    {
        if($id == null){

            show_404();
        }

        $detail =
        $this->M_pengaturan
        ->detail($id);

        if(!$detail){

            show_404();
        }

        $logo =
        $detail->logo;

        $favicon =
        $detail->favicon;

        /*
        |--------------------------------------------------------------------------
        | UPLOAD LOGO
        |--------------------------------------------------------------------------
        */

        if(
            !empty($_FILES['logo']['name'])
        ){

            $config['upload_path'] =
            './upload/logo/';

            $config['allowed_types'] =
            'jpg|jpeg|png';

            $config['encrypt_name'] =
            TRUE;

            $this->upload->initialize(
                $config
            );

            if(
                $this->upload
                ->do_upload('logo')
            ){

                if(
                    $detail->logo != ''
                    &&
                    file_exists(
                        './upload/logo/' .
                        $detail->logo
                    )
                ){

                    unlink(
                        './upload/logo/' .
                        $detail->logo
                    );
                }

                $logo =

                $this->upload
                ->data('file_name');
            }
        }

        /*
        |--------------------------------------------------------------------------
        | UPLOAD FAVICON
        |--------------------------------------------------------------------------
        */

        if(
            !empty($_FILES['favicon']['name'])
        ){

            $config2['upload_path'] =
            './upload/favicon/';

            $config2['allowed_types'] =
            'png|ico';

            $config2['encrypt_name'] =
            TRUE;

            $this->upload->initialize(
                $config2
            );

            if(
                $this->upload
                ->do_upload('favicon')
            ){

                if(
                    $detail->favicon != ''
                    &&
                    file_exists(
                        './upload/favicon/' .
                        $detail->favicon
                    )
                ){

                    unlink(
                        './upload/favicon/' .
                        $detail->favicon
                    );
                }

                $favicon =

                $this->upload
                ->data('file_name');
            }
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE DATA
        |--------------------------------------------------------------------------
        */

        $update = [

            'nama_klinik' =>

            $this->input->post(
                'nama_klinik',
                TRUE
            ),

            'alamat' =>

            $this->input->post(
                'alamat',
                TRUE
            ),

            'telepon' =>

            $this->input->post(
                'telepon',
                TRUE
            ),

            'email' =>

            $this->input->post(
                'email',
                TRUE
            ),

            'tema' =>

            $this->input->post(
                'tema',
                TRUE
            ),

            'dark_mode' =>

            $this->input->post(
                'dark_mode',
                TRUE
            ),

            'sidebar' =>

            $this->input->post(
                'sidebar',
                TRUE
            ),

            'nomor_rm_prefix' =>

            $this->input->post(
                'nomor_rm_prefix',
                TRUE
            ),

            'nomor_antrian_prefix' =>

            $this->input->post(
                'nomor_antrian_prefix',
                TRUE
            ),

            'logo' => $logo,

            'favicon' => $favicon
        ];

        $this->M_pengaturan
        ->update(
            $id,
            $update
        );

        $this->session->set_flashdata(

            'success',

            'Pengaturan berhasil diupdate'
        );

        redirect('pengaturan');
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS
    |--------------------------------------------------------------------------
    */

    public function hapus($id)
    {
        $detail =
        $this->M_pengaturan
        ->detail($id);

        if(!$detail){

            show_404();
        }

        if(
            $detail->logo != ''
            &&
            file_exists(
                './upload/logo/' .
                $detail->logo
            )
        ){

            unlink(
                './upload/logo/' .
                $detail->logo
            );
        }

        if(
            $detail->favicon != ''
            &&
            file_exists(
                './upload/favicon/' .
                $detail->favicon
            )
        ){

            unlink(
                './upload/favicon/' .
                $detail->favicon
            );
        }

        $this->M_pengaturan
        ->hapus($id);

        $this->session->set_flashdata(

            'success',

            'Pengaturan berhasil dihapus'
        );

        redirect('pengaturan');
    }

    /*
    |--------------------------------------------------------------------------
    | BACKUP DATABASE
    |--------------------------------------------------------------------------
    */

    public function backup_database()
    {
        $prefs = [

            'format' => 'zip',

            'filename' =>

            'simrs_rozan.sql'
        ];

        $backup =&
        $this->dbutil
        ->backup($prefs);

        $nama_file =

        'backup-simrs-' .

        date('Y-m-d-H-i-s')

        . '.zip';

        force_download(
            $nama_file,
            $backup
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CLEAR CACHE
    |--------------------------------------------------------------------------
    */

    public function clear_cache()
    {
        $this->output->delete_cache();

        $this->session->set_flashdata(

            'success',

            'Cache berhasil dibersihkan'
        );

        redirect('pengaturan');
    }

    /*
    |--------------------------------------------------------------------------
    | SERVER INFO
    |--------------------------------------------------------------------------
    */

    public function server_info()
    {
        phpinfo();
    }
}