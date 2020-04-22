
/**
 * Override the main.js categoryClicked function to 
 * add categories to resource
 */
function categoryClicked(id, name) {
  console.log(name);
  if( id ) { // id=0 does not count
    var exists = false;
    $('.category').each(function(i, cat) {
      if( $(cat).attr('data-catid') == id ) {
        exists = true;
      }
    });

    if( !exists ) {
      $('#categoryInput').append('<a class="category" data-catid="'+id+'" onclick="return removeMe(this);">'
                                +'['+name+'] </a>');
    }
  }
}

function removeMe(elm) {
  $(elm).remove();
  return false;
}