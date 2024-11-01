<?php

/**
 * @package YDS Puan Hesaplama
 */

/* Eklenti Menüsü Ekleme */
add_action( 'admin_menu', 'yds_puan_menu' );

/* Menü Kodları */
function yds_puan_menu() {
    add_options_page( __('YDS Puan Hesaplama','yds-puan-hesaplama'),  __('YDS Puan','yds-puan-hesaplama'), 'manage_options', 'yds-puan-hesaplama', 'yds_puan_options' );
}

/* Eklenti Sayfası Kodları */
function yds_puan_options() {
    if ( current_user_can( 'manage_options' ) )  
    {
    ?>
    <div class="wrap">
        <h1><?php echo __( 'YDS Puan Hesaplama Eklentisi','yds-puan-hesaplama');?></h1>
        <p><?php echo __( 'YDS Puan Hesaplama Eklentisi ile YDS puanını ve YDS harf notunu çok kolay bir şekilde hesaplayabilirsiniz.','yds-puan-hesaplama');?></p>
        <hr/>
        <h2><?php echo __( 'Eklentinin Eklenmesi','yds-puan-hesaplama');?></h2>
        <p><?php echo sprintf('Eklentiyi sitenizde göstermek için %s kodunu istediğiniz gönderi veya sayfaya ekleyiniz.','<code>[yds-puan-hesaplama]</code>','yds-puan-hesaplama');?></p>
        <hr/>
        <h2><?php echo __( 'Eklenti Ayarları','yds-puan-hesaplama');?></h2>
    <?php
    // Ayarlar Güncelleniyor
    if(!empty($_POST))
    {
        if (! wp_verify_nonce($_REQUEST['_wpnonce'], 'yds-puan-hesaplama-nonce') )
        {
    ?>
            <div class="notice notice-error is-dismissible"><p><strong><?php echo __('Doğrulama hataları meydana geldi!','yds-puan-hesaplama');?></strong></p></div>
    <?php
        }
        else
        {
            // Veriler Alınıyor
             $yds_form_title     = sanitize_text_field($_POST["yds-form-title"]);
             $yds_form_bottom    = sanitize_text_field($_POST["yds-form-bottom"]);
             update_option("yds-form-title"  , $yds_form_title);
             update_option("yds-form-bottom" , $yds_form_bottom);
    ?>
       <div class="notice notice-success is-dismissible"><p><strong><?php echo __('Ayarlar Kaydedildi.','yds-puan-hesaplama'); ?></strong></p></div>
    <?php
        }
    }
    ?>
        <form method="post" action="">
            <p>
                <label style="font-weight: bold" for="yds-form-title"><?php echo __('YDS Form Başlığı','yds-puan-hesaplama');?></label><br/>
                <input type="text" style="width:100%" class="form-control" id="yds-form-title" name="yds-form-title" value="<?php echo get_option('yds-form-title');?>"/>
            </p>
            <p>
                <label style="font-weight: bold" for="yds-form-bottom"><?php echo __('YDS Form Alt Yazı','yds-puan-hesaplama');?></label><br/>
                <input type="text" style="width:100%" class="form-control" id="yds-form-bottom" name="yds-form-bottom" value="<?php echo get_option('yds-form-bottom');?>"/>
            </p>
            <p>
                <?php wp_nonce_field('yds-puan-hesaplama-nonce'); ?>
                <input type="submit" class="button-primary" id="submit" name="submit" value="<?php echo __('Değişiklikleri Kaydet','yds-puan-hesaplama'); ?>"/>
            </p>
        </form>
        <hr/>
        <h2><?php echo __('Eklenti Hakkında','yds-puan-hesaplama'); ?></h2>
        <p><?php echo sprintf('Eklenti %s tarafından kodlanmış ve yayınlanmıştır. Eklenti tamamen ücretsiz ve sınırsız kullanım izni tanır.','<a href="https://www.sefasungur.com" target="_blank">Sefa Sungur</a>','yds-puan-hesaplama');?></p>
    </div>
<?php
    }
    else
    {
        wp_die( __( 'Bu sayfaya erişmek için yeterli izniniz yok.','yds-puan-hesaplama' ) );
    }
}

/* Form Ekleme Fonksiyonu */
function add_yds_form() {
    return require_once dirname(__DIR__) ."/public/yds-form.php";
}

/* Form Kısa Kodu Olutşrucu */
add_shortcode( 'yds-puan-hesaplama', 'add_yds_form' );