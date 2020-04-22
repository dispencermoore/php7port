if (!window.location.origin)
	window.location.origin = window.location.protocol+"//"+window.location.host;

var loaded = false;
function categoryClicked(id, name) {
	$urlAdd = "";
	if(window.location.pathname.indexOf("/pending.php") == 0) {
		$urlAdd = window.location.pathname;
	}

	if(cat != id && loaded) {
		window.location.href = window.location.origin + $urlAdd + "?cat="+id;
	}
	else if (loaded && id == '0' && window.location.href.indexOf("cat=0") == -1 ) {
		window.location.href = window.location.origin + $urlAdd +"?cat="+id;
	}
	loaded = true;
}

function attachEvents() {
  $('.like').on('click', function() {
    var resource_id = $(this).attr('data-resource-id');
    if( resource_id ) {
      var numLikes = parseInt($(this).text());
//      console.log(resource_id + ': ' + numLikes);
      
      var that = this;
      $.ajax({
        url: '/services/increment-like-count.php?resource_id='+resource_id,
        type: 'GET',
        statusCode: {
          200: function() {
//            console.log('submitted Like');
            numLikes++;
            $(that).text(' '+numLikes);
            $(that).addClass('liked');
          },
          304: function() {
            // do nothing when Like already submitted by this user
            alert('You already Liked this resource before');
          },
          400: function() {
            // Something went terribly wrong
            alert('Sorry, could not submit your Like. Please contact Admin.');
          },
          401: function() {
            alert('You must be Signed In to Like a resource');
          }
        }
      });    
    }
  });
  
  $('.resource-container').hover(
    function(evt) {
      $(this).css('background-color','rgb(228, 234, 245)');
//      $(this).find('.hover-show').show();
    },
    function(evt) {
      $(this).css('background-color','');
//      $(this).find('.hover-show').hide();
    }
  );
  
//  $('.editor-initial').each(function(index) {
//    var bgColor = $(this).attr('data-bgcolor').slice(1);
//    var fontColor = invertHexColor(bgColor);
//    console.log(bgColor+' : '+fontColor);
//    $(this).css('color','#'+fontColor);
//  });
  
  $('.editor-name').hover(
    function(evt) {
      $(this).children('.editor-name-partial').show(500);
    },
    function(evt) {
      $(this).children('.editor-name-partial').hide(500);
    }
  );

}

function initialize() {
  if( typeof category_json !== 'undefined' ) {
	$("#catbrowser").jstree(category_json).bind("select_node.jstree",
      function (e, data) {
        categoryClicked(data.rslt.obj.data("id"),
                        data.rslt.obj.data("name"));
    });  
  }
}

$(document).ready(function(){
  initialize();
  
  attachEvents();
});


function getParameterByName(name) {
  name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
  var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
      results = regex.exec(location.search);
  return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function invertHexColor(hexnum){
  if(hexnum.length != 6) {
    alert("Hex color must be six hex numbers in length.");
    return false;
  }
	
  hexnum = hexnum.toUpperCase();
  var splitnum = hexnum.split("");
  var resultnum = "";
  var simplenum = "FEDCBA9876".split("");
  var complexnum = new Array();
  complexnum.A = "5";
  complexnum.B = "4";
  complexnum.C = "3";
  complexnum.D = "2";
  complexnum.E = "1";
  complexnum.F = "0";
	
  for(i=0; i<6; i++){
    if(!isNaN(splitnum[i])) {
      resultnum += simplenum[splitnum[i]]; 
    } else if(complexnum[splitnum[i]]){
      resultnum += complexnum[splitnum[i]]; 
    } else {
      alert("Hex colors must only include hex numbers 0-9, and A-F");
      return false;
    }
  }
	
  return resultnum;
}
