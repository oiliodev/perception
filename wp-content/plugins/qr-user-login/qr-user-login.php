<?php

/*
Plugin Name: QR User Login
Plugin URI: https://github.com/acasado86/qr-user-login
Description: Allow users to login using a link (or QR code).
Version: 1.0.0
Author: acasado
Author URI: https://github.com/acasado86
License: GPLv2
*/

/* 
Copyright (C) 2016 acasado

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
*/

class QR_User_Login {
    static $instance = null;
    var $role = 'qr_login';
    var $capability = 'qr_login';
    var $user_meta = 'qr_code';
    
    static function & get_instance() {
        if (null == QR_User_Login::$instance) {
            QR_User_Login::$instance = new QR_User_Login();
        }
        return QR_User_Login::$instance;
    }
    
    function QR_User_Login(){
        //ACTION AND FILTERS HOOKS
        add_action( 'edit_user_profile', array($this, 'edit_user_profile') );
        add_action( 'show_user_profile', array($this, 'edit_user_profile') );
        add_action( 'login_head', array($this, 'check_qr_login') );
        add_action('admin_menu', array($this, 'admin_menu') );
    }
    
    function admin_menu(){
        add_submenu_page('users.php', 'QR Login Capability', 'QR Login Capability', 'manage_options', 'qr-login-capability', array($this, 'manage_qr_login_capability'));
    }
    
    function manage_qr_login_capability(){
        $nonce = filter_input(INPUT_POST, '_wpnonce');
        if ( $nonce && wp_verify_nonce($nonce, 'manage_qr_login_capability') ){
            //Remove Capability
            foreach (wp_roles()->role_objects as $role => $role_object){
                if ($role != $this->role){
                    $role_object->remove_cap($this->capability);
                }
            }
            //Add Capability
            $qr_login_roles = filter_input(INPUT_POST, 'qr_login_roles', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
            if ($qr_login_roles){
                foreach ($qr_login_roles as $role_name){
                    get_role($role_name)->add_cap($this->capability);
                }
            }
        }
        include_once( 'templates/qr-login-capability.php' );
    }
    
    function can_user_login($user_id){
        if (!is_super_admin($user_id)){
            return user_can($user_id, $this->capability);
        }
        
        $role_capabilities = get_user_by('ID', $user_id)->get_role_caps();
        return array_key_exists($this->capability, $role_capabilities) ? $role_capabilities[$this->capability] : false;
    }
    
    function check_qr_login(){
        $user_id = filter_input(INPUT_GET, 'user_id');
        $qr_code = filter_input(INPUT_GET, 'qr_code');
        if ( $user_id && $qr_code && $this->can_user_login($user_id) && $qr_code == get_user_meta($user_id, $this->user_meta, true)){
            wp_set_auth_cookie($user_id, true);
            wp_redirect(home_url());
        }
    }
    
    function edit_user_profile($profileuser){
        if ($this->can_user_login($profileuser->ID)){
            include_once( 'templates/edit_user_profile.php' );
        }
        
    }
    
    function get_user_qr_image($user_id){
        $qr_api_url = 'https://chart.googleapis.com/chart';
        $query_params = array(
            'cht' => 'qr',
            'chs' => '200x200'
        );

        $query_params ['chl'] = $this->get_user_qr_login_url($user_id);

        return $qr_api_url . '?' . http_build_query($query_params);
    }
    
    function generate_random_user_qr_code($user_id){
        if (! $this->can_user_login($user_id))
                return false;
        
        $bytes = random_bytes(10);
        $value = bin2hex($bytes);
        update_user_meta($user_id, $this->user_meta, $value);
        return $value;
    }
    
    function get_user_qr_code($user_id){
        $qr_login_code = get_user_meta($user_id, $this->user_meta, true);
        
        if (empty($qr_login_code) && $this->can_user_login($user_id)){
            $qr_login_code = $this->generate_random_user_qr_code($user_id);
        }
        
        return $qr_login_code;
    }
    
    function get_user_qr_login_url($user_id){
        $params = array (
            'user_id' => $user_id,
            'qr_code' => $this->get_user_qr_code($user_id)
        );
        $url_login = wp_login_url();
        $separator = strstr('?', $url_login) ? '&' : '?';
        return $url_login . $separator . http_build_query($params);
    }
    
    function activate_plugin() {
        add_role( $this->role, 'QR Login', array( 'read' => true, $this->capability => true ) );
    }
    
    function desactivate_plugin() {
        remove_role( $this->role );
        delete_metadata('user', null, $this->user_meta, '', true);
    }
}
$QRUL_instance = QR_User_Login::get_instance();
register_activation_hook(__FILE__, array($QRUL_instance, 'activate_plugin'));
register_deactivation_hook(__FILE__, array($QRUL_instance, 'desactivate_plugin'));