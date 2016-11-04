jQuery(document).ready(function($){
    try {
        var cart_hash_key = wc_cart_fragments_params.ajax_url.toString() + '-wc_cart_hash';

        if (sessionStorage.getItem( 'woocommerce_cart_hash' ) == '' || actions.is_lang_switched == 1 || actions.is_currency_switched == 1 ) {
            sessionStorage.removeItem( 'wc_fragments' );
        }
    } catch(err){
        //console.log(err.message);
    }
});

