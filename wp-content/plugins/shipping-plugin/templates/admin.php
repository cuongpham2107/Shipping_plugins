<div class="wrap">
    <h1>Shipping Plugin Test 1223</h1>
    <?php settings_errors(); ?>
    <form method="post" action="options.php">
        <?php 
            settings_fields( 'alecaddd_options_group' );
            do_settings_sections( 'shipping_plugin' );
            submit_button();
        ?>
    </form>
</div>