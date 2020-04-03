  $(function(){ 
      //alert(event.timeStamp);
//      $('.new-com-bt').click(function(event){    
      $('.comment').click(function(event){    
          var comments_elm = $(this)
                              .parent() // action-list
                              .parent() // resource
                              .parent() // resource-comment
                              .children('.cmt-container');
          if( $(comments_elm).is(':visible') ) {
            $(comments_elm).hide('slow');
//            $(comments_elm).find('.new-com-cnt').show();            
          } else {
            $(comments_elm).show('slow', function() {
//            $(comments_elm).find('.new-com-cnt').show();
              $(comments_elm).find('.the-new-com').focus();
            });
          }
      });

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

      // on post comment click 
      $('.bt-add-com').click(function(){
        var theCom = $(this).siblings('.the-new-com');
        var comCountElm = $('#comment-count');
        var comCount = parseInt(comCountElm.text());
        var resource_id = $(this).attr('data-resource-id');

        if( !theCom.val()){
          alert('You need to write a comment!'); 
        }else{
          var that = this;
          $.ajax({
              type: "POST",
              url: "/services/add-comment.php",
              data: 'act=add-com'
                    +'&resource_id='+resource_id
                    +'&comment='+theCom.val(),
              success: function(html){
                comCountElm.text(comCount+1);
                
                theCom.val('');
                $(that).css({opacity:0.6});
                
                $(that).parent().after(html);
              },
              error: function(msg) {
                alert(msg.statusText);
              }
          });
        }
      });

    });  