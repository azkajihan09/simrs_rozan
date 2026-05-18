function log_activity($aktivitas)
{
    $CI =& get_instance();

    $CI->db->insert('activity_log',[

        'user_id' => $CI->session->userdata('id'),

        'aktivitas' => $aktivitas,

        'ip_address' => $_SERVER['REMOTE_ADDR']
    ]);
}