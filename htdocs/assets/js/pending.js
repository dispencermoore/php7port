function approveResource(id) {
  $.ajax({
      method: 'POST'
    , url: '/rest/resource/approval/'+id
    , success: function(data) {
        $('#resource-'+id).addClass('approveSuccess');
        $('#edit-btns-'+id).hide();
        location.reload();
      }
    , error: function(err) {
        alert('Approval failed');
      }
  });
  return false;
}

function deleteResource(id) {
  var r=confirm("Are you sure you want to delete this resource?");
  if (r==true) {
    $.ajax({
        method: 'DELETE'
      , url: '/rest/resource/'+id
      , success: function(data) {
          $('#resource-'+id).addClass('deleteSuccess');
          $('#edit-btns-'+id).hide();
          location.reload();
        }
      , error: function(err) {
          alert('Deletion failed');
        }
    });
    return false;
    
  } else {
    return false;
  }
}
