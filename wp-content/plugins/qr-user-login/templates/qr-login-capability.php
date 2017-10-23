<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h2>QR Login Capability</h2>
<form method="post" action="<?php echo admin_url('users.php?page=qr-login-capability') ?>">
    <?php foreach (wp_roles()->role_objects as $role => $role_object):?>
    <p><label for="<?php echo $role ?>"><input type="checkbox" id="<?php echo $role ?>" name="qr_login_roles[]" value="<?php echo $role ?>" <?php checked($role_object->has_cap('qr_login')) ?> <?php disabled($role == 'qr_login') ?>/><?php echo $role ?></label></p>
    <?php endforeach; ?>
    <?php wp_nonce_field('manage_qr_login_capability'); ?>
    <input type="submit" class="button primary" value="Save" />
</form>
