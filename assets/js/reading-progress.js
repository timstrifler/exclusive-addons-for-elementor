jQuery(document).ready(function () {
    jQuery(window).scroll(function () {
        var e = ((document.body.scrollTop || document.documentElement.scrollTop) / (document.documentElement.scrollHeight - document.documentElement.clientHeight)) * 100;
        jQuery(".exad-reading-progress-fill").css({ width: e + "%" });
    });
});
