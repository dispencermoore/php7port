

      /* when start writing the comment activate the "add" button */
      $('.the-new-com').bind('input propertychange', function() {
         $(this).siblings(".bt-add-com").css({opacity:0.6});
         var checklength = $(this).val().length;
         if(checklength){ $(this).siblings(".bt-add-com").css({opacity:1}); }
      });

      /* on clic  on the cancel button */
      $('.bt-cancel-com').click(function(){
          $(this).siblings('.the-new-com').val('');
//          $(this).parent('.new-com-cnt').fadeOut('fast', function(){
//              $('.new-com-bt').fadeIn('fast');
//          });
      });
var getNAME;
//if (PcomCount !== "undefined"){
//PcomCount = 5;
//}
  /*    // on post comment click 
      $('.bt-sign-in').click(function(){
        var sign_name = document.getElementById('name-area').value;
          var that = this;
          alert(sign_name);
          $.ajax({
              type: "POST",
              url: "/sign-in.php", 
              data: 'act=user-sign-in'
                    +'&name='+sign_name,

              success: function(html){
                comCountElm.text(comCount+1);
                alert(sign_name + ", you have logged in successfully");
              },
              error: function(msg) {
                alert(msg.statusText);
              }
          });
        });