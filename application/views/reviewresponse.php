<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<div class="modal-window fade_in">
    <div class="modal-wrapper"><h2>Respond to Review</h2> 
        <div class="modal-body"> 
            <div class="modal-content"> 
                            <div style="background-color:white;">  
                            <h1 id="suc" style="display:none;"><center>Success</center></h1>
                                <form role="form" id="formin" method="post" action="<?=base_url()?>vendor/managereviews/<?=$rid?>/respondToReview"> 
                                    <input type="hidden" name="rid" value="<?=$rid?>">
                                    <input type="hidden" name="reviewid" value="<?=$reviewid?>">
                                    <input type="hidden" name="action" value="respondToReview">
                                    <div class="form-group">
                                        <label for="form-sign-in-email">Your Response:</label>
                                        <textarea id="response" name="response" style="width:100%; height:200px;" required><?=$originalresponse?></textarea>
                                    </div><!-- /.form-group -->
                                    <div class="form-group clearfix">
                                        <a href="#" onClick="submitComment(<?=$reviewid?>,<?=$rid?>)" class="btn btn-default" id="account-submit">Submit Response</a>
                                    </div><!-- /.form-group -->
                                </form>
                            </div> 
            </div>
        </div>
        <div class="modal-close"><img src="<?=base_url()?>resources/img/close.png"></div>
    </div>
    <div class="modal-background fade_in"></div>
</div>

<script>
    function donext(){
        setTimeout(continueExecution, 1000);
    }
    function continueExecution(){
        $('.modal-window').addClass('fade_out');
                        setTimeout(function() {
                            $('.modal-window').remove();
                        }, 300);
    }
    function submitComment(reviewd, ri) {
        var responses = document.getElementById("response").value;
        if (responses == null || responses == "") {
            alert("Cannot submit empty response.");
        } else {
            $.ajax({
                    type: 'POST',
                    url: '<?=base_url()?>vendor/managereviews/<?=$rid?>/respondToReview',
                    data: {rid:ri,reviewid:reviewd,response:responses},
                    success: function (data) {
                        $("#formin").hide();
                        $("#suc").show(); 
                        donext();
                        
                    }
            });
        }
        
    }
    // Remove modal element form DOM

    $('.modal-window .modal-background, .modal-close').live('click',  function(e){
        $('.modal-window').addClass('fade_out');
        setTimeout(function() {
            $('.modal-window').remove();
        }, 300);
    });
</script>

<!--[if lte IE 9]>
<script type="text/javascript" src="<?=base_url()?>resources/js/ie-scripts.js"></script>
<![endif]-->
</body>
</html>