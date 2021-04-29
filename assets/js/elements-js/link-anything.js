
// Container Link JS started

$('body').on('click.onWrapperLink', '[data-exad-element-link]', function() {
    var $wrapper = $(this),
        data     = $wrapper.data('exad-element-link'),
        id       = $wrapper.data('id'),
        anchor   = document.createElement('a'),
        anchorReal,
        timeout;

    anchor.id            = 'exad-link-anything-' + id;
    anchor.href          = data.url;
    anchor.target        = data.is_external ? '_blank' : '_self';
    anchor.rel           = data.nofollow ? 'nofollow noreferer' : '';
    anchor.style.display = 'none';

    document.body.appendChild(anchor);

    anchorReal = document.getElementById(anchor.id);
    anchorReal.click();

    timeout = setTimeout(function() {
        document.body.removeChild(anchorReal);
        clearTimeout(timeout);
    });
});

// Container Link JS end
