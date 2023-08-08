var $ = jQuery;
jQuery(document).ready(function(e) {
    $('#toplevel_page_fvn-sp-manager').removeClass('wp-not-current-submenu');
    $('#toplevel_page_fvn-sp-manager').addClass('wp-has-current-submenu wp-menu-open');

    $('#toplevel_page_fvn-sp-manager > a').removeClass('wp-not-current-submenu');
    $('#toplevel_page_fvn-sp-manager > a').addClass('wp-has-current-submenu wp-menu-open');

    let taxonomy = getURLParameter('taxonomy');
    let postType = getURLParameter('post_type');
    if (postType == 'fvn-product') {
        if (taxonomy == 'fvn-category') {
            $('#toplevel_page_fvn-sp-manager a[href="edit-tags.php?taxonomy=fvn-category&post_type=fvn-product"]').addClass('current');
            $('#toplevel_page_fvn-sp-manager a[href="edit-tags.php?taxonomy=fvn-category&post_type=fvn-product"]').parent().addClass('current');
        }
        if (!taxonomy) {
            $('#toplevel_page_fvn-sp-manager a[href="edit.php?post_type=fvn-product"]').addClass('current');
            $('#toplevel_page_fvn-sp-manager a[href="edit.php?post_type=fvn-product"]').parent().addClass('current');
        }
    }
})

function getURLParameter(sParams) {
    let sPageUrl = window.location.search.substring(1);
    let sURLVariables = sPageUrl.split('&');
    for (let i = 0; i < sURLVariables.length; i++) {
        let sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParams) {
            return sParameterName[1];
        }
    }
}