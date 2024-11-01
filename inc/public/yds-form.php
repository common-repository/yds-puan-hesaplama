<?php
/**
 * @package YDS Puan Hesaplama
 */
?>
<div id="yds-puan-hesaplama-eklentisi">
    <h2><?php echo get_option('yds-form-title');?></h2>
    <div id="yds-puan-hesaplama-form">
        <form method="post" action="">
            <p>
                <label for="yds-dogru"><?php echo __('YDS Doğru Sayısını Giriniz','yds-puan-hesaplama');?></label><br/>
                <input type="text" name="yds-dogru" id="yds-dogru" required />
            </p>
            <p>
                <?php wp_nonce_field('yds-puan-hesaplama-form-nonce'); ?>
                <input type="submit" value="<?php echo __('Hesapla','yds-puan-hesaplama');?>"/>
            </p>
        </form>
    </div>
    <?php
        if(!empty($_POST)) {
            if (! wp_verify_nonce($_REQUEST['_wpnonce'], 'yds-puan-hesaplama-form-nonce') )
            {
                echo '<p><strong>'.__('Doğrulama Hataları Meydana Geldi!').'</strong></p>';
            }
            else
            {
                $yds_dogru = $_POST["yds-dogru"];
                if($yds_dogru != "")
                {
                    if($yds_dogru > 80)
                    {
                        $yds_error = 1;
                        $yds_error_text = __('Doğru sayısı 80\'den fazla olamaz.','yds-puan-hesaplama');
                    }
                    else
                    {
                        $yds_error = 0;
                        $yds_puani = $yds_dogru * 1.25;

                        if($yds_puani > 89)
                        {
                            $yds_harf_notu = "A";
                        }
                        else if($yds_puani > 79 and $yds_puani < 89)
                        {
                            $yds_harf_notu = "B";
                        }
                        else if($yds_puani > 69 and $yds_puani < 79)
                        {
                            $yds_harf_notu = "C";
                        }
                        else if($yds_puani > 59 and $yds_puani < 69)
                        {
                            $yds_harf_notu = "D";
                        }
                        else if($yds_puani > 49 and $yds_puani < 59)
                        {
                            $yds_harf_notu = "E";
                        }
                        else
                        {
                            $yds_harf_notu = __('Harf Notu Hesaplanamaz.','yds-puan-hesaplama');
                        }
                    }
                }
                else
                {
                    $yds_error = 1;
                    $yds_error_text = __('Doğru sayısını boş bırakmayınız.','yds-puan-hesaplama');
                }

                if($yds_error == 1)
                {
                    echo '<p><strong>'.$yds_error_text.'</strong></p>';
                }
                else
                {
        ?>
        <div id="yds-puan-hesaplama-result">
            <h3><?php  echo __('Hesaplama Sonuçları','yds-puan-hesaplama');?></h3>
            <p><strong><?php  echo __('YDS Net Sayısı','yds-puan-hesaplama');?>: </strong><?php echo $yds_dogru;?></p>
            <p><strong><?php  echo __('YDS Puanı','yds-puan-hesaplama');?>: </strong><?php echo $yds_puani;?></p>
            <p><strong><?php  echo __('YDS Harf Notu','yds-puan-hesaplama');?>: </strong><?php echo $yds_harf_notu;?></p>
        </div>
        <?php
                }
            }
        }
    ?>
    <hr/>
    <p><?php echo get_option('yds-form-bottom');?></p>
</div>