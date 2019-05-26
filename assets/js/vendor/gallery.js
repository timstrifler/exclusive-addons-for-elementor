// init Isotope
var $grid = $('#exad-gallery-one .exad-gallery-element').isotope({
  itemSelector: '#exad-gallery-one .exad-gallery-item',
  layoutMode: 'fitRows',
  getSortData: {
    name: '.name',
    symbol: '.symbol',
    number: '.number parseInt',
    category: '[data-category]',
    weight: function( itemElem ) {
      var weight = $( itemElem ).find('.weight').text();
      return parseFloat( weight.replace( /[\(\)]/g, '') );
    }
  }
});
// bind filter button click
$('#exad-gallery-one #filters').on( 'click', 'button', function() {
  var filterValue = $( this ).attr('data-filter');
  // use filterFn if matches value
  filterValue = filterFns[ filterValue ] || filterValue;
  $grid.isotope({ filter: filterValue });
});
// change is-checked class on buttons
$('#exad-gallery-one .exad-gallery-menu').each( function( i, buttonGroup ) {
  var $buttonGroup = $( buttonGroup );
  $buttonGroup.on( 'click', 'button', function() {
    $buttonGroup.find('.is-checked').removeClass('is-checked');
    $( this ).addClass('is-checked');
  });
});

var $grid2 = $('#exad-gallery-two .exad-gallery-element').isotope({
  itemSelector: '#exad-gallery-two .exad-gallery-item',
  layoutMode: 'fitRows',
  getSortData: {
    name: '.name',
    symbol: '.symbol',
    number: '.number parseInt',
    category: '[data-category]',
    weight: function( itemElem ) {
      var weight = $( itemElem ).find('.weight').text();
      return parseFloat( weight.replace( /[\(\)]/g, '') );
    }
  }
});
// bind filter button click
$('#exad-gallery-two #filters').on( 'click', 'button', function() {
  var filterValue = $( this ).attr('data-filter');
  // use filterFn if matches value
  filterValue = filterFns[ filterValue ] || filterValue;
  $grid2.isotope({ filter: filterValue });
});
$('#exad-gallery-two .exad-gallery-menu').each( function( i, buttonGroup ) {
  var $buttonGroup = $( buttonGroup );
  $buttonGroup.on( 'click', 'button', function() {
    $buttonGroup.find('.is-checked').removeClass('is-checked');
    $( this ).addClass('is-checked');
  });
});
// filter functions
var filterFns = {
  // show if number is greater than 50
  numberGreaterThan50: function() {
    var number = $(this).find('.number').text();
    return parseInt( number, 10 ) > 50;
  },
  // show if name ends with -ium
  ium: function() {
    var name = $(this).find('.name').text();
    return name.match( /ium$/ );
  }
};


// magnific popup
$('.image-view-one').magnificPopup({
  type: 'image',
  gallery: {
    enabled: true
  },
});
$('.image-view-two').magnificPopup({
  type: 'image',
  gallery: {
    enabled: true
  },
});
$('.image-view-three').magnificPopup({
  type: 'image',
  gallery: {
    enabled: true
  },
});

$('.exad-gallery-carousel-element').slick({
  slidesToShow: 5,
  slidesToScroll: 2,
  arrows: false,
  dots: true,
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 2,
        dots: true
      }
    },
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 2,
        dots: true
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
        dots: true
      }
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 1,
        dots: true
      }
    }
  ]
});

$(".exad-image-gallery-element .exad-image-gallery-item").slice(0, 6).show();
$("#load-more").on('click', function (e) {
  e.preventDefault();
  $(".exad-image-gallery-element .exad-image-gallery-item:hidden").slice(0, 6).fadeIn();
  if ($(".exad-image-gallery-element .exad-image-gallery-item:hidden").length == 0) {
      $("#load").slideDown('slow');
  }
});
$('#instafeed').each(function(){
  var limit = $(this).data('limit');
  var template = $(this).data('template');
  var token = $(this).data('token');
  var userFeed = new Instafeed({
    get: 'user',
    userId: '1940699993',
    limit: limit,
    resolution: 'standard_resolution',
    accessToken: token,
    sortBy: 'most-recent',
    template: template,
  });
  userFeed.run();
});

