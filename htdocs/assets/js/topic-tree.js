  $(function () {
//    $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
    
    $('.tree li').hide();
    $('.tree li.parent_li').show();
    
//    $('.tree li.parent_li > span').on('click', function (e) {
    $(document).on('click', '.tree li.parent_li > span', function (e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
            children.hide('fast');
            $(this).attr('title', 'Expand this branch')
                .addClass('glyphicon-plus')
                .removeClass('glyphicon-minus');
        } else {
            children.show('fast');
            $(this).attr('title', 'Collapse this branch')
                .addClass('glyphicon-minus')
                .removeClass('glyphicon-plus');
        }
        e.stopPropagation();
    });
    
    $('#topic-browser-btn').popover({
      html: true,
      content: function() {
        return $('#topic-browser').html();
      }
    });
    
//    $('#topic-browser-btn').popover('show');
  });