function approveResource(id) {
  $.ajax({
      method: 'POST'
    , url: '/rest/resource/approval/'+id
    , success: function(data) {
        $('#approveBtn').hide();
        $('#approveSuccess')
          .show(100)
          .delay(1000)
          .fadeOut(2000, function() {
            redirectToLastListPage();
          });
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
          $('#deleteBtn').hide();
          $('#deleteSuccess')
            .show(100)
            .delay(1000)
            .fadeOut(2000, function() {
              redirectToLastListPage();
            });
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

function redirectToLastListPage() {
  var lastListPageVisited = sessionStorage.getItem('listPage');
  if( lastListPageVisited ) {
    var params = '';
    params += sessionStorage.getItem('page')
            ? prefix(params)+'p='+sessionStorage.getItem('page')
            : '';
    params += sessionStorage.getItem('query')
            ? prefix(params)+'q='+sessionStorage.getItem('query')
            : '';
    params += sessionStorage.getItem('topic')
            ? prefix(params)+'cat='+sessionStorage.getItem('topic')
            : '';
    params += '#results'; // jquery.twbsPagination.js requires it oddly
    var url = lastListPageVisited+params;
    window.location.href = url;
  } else {
    var url = '/';
    window.location.href = url;
  }
}

function prefix(params) {
  if( params == '' ) {
    return '?';
  } else {
    return '&';
  }
}