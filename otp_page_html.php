<?php
header("Access-Control-Allow-Origin: *");
?>
var jQScriptOutputted = false;
function js_initJQuery() {
    js_included = true;
    if (typeof (jQuery) == 'undefined') {
        if (!jQScriptOutputted) { 
            jQScriptOutputted = true;
            var jq_script = document.createElement('script');
            jq_script.setAttribute('type','text/javascript');
            jq_script.setAttribute('src','https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js');
            document.head.appendChild(jq_script);
        }
        setTimeout("js_initJQuery()", 50);
    } else {
            var site_url="https://apps.adexlabs.com/app/billing_upgrade_test/order_csv";
            var jq_css = document.createElement("link");
            jq_css.rel = "stylesheet";
            jq_css.type = "text/css";
            jq_css.href = "https://tato.club/order_page_style.css";
            document.getElementsByTagName("head")[0].appendChild(jq_css);

            $('.content-box:first').after('<div class="content-box extra_div">\n\
                                        <div class="div-img" style="display: none;"><img class="loader_ord" src="'+site_url+'/ajax-loader.gif"></div>\n\
                                        <h2 class="ord_h2">Send me reminders to use the products regularly</h2>\n\
                                          <label class="ord_container">Send me reminders<input type="checkbox" id="send_remd"><span class="ord_checkmark"></span></label>\n\
                                          <input type="button" class="btn send_remind" value="Remind me">\n\
                                        </div>'); 
            setTimeout(function(){
                 $('html, body').animate({
                    scrollTop: $(".extra_div").offset().top
                }, 1000);
            },1000);

            $(document).on('click','.send_remind',function(){
                var chk_box=($('#send_remd').is(':checked')?"1":"0");
                if(chk_box =='0'){
                    alert("Please select box.");
                    return false;
                }
                $('.div-img').show();
                $(this).prop('disabled',true).addClass('dsl_btn');
                $.ajax({
                    type: 'POST',
                    url: site_url+"/ord_ajax.php", 
                    data: {action:'get_style',chk_box:chk_box,ord_id:ord_id},
                    dataType: 'json', 
                    success: function (data) { 
                        if(data['status'] == 'success'){ 
                            $('.div-img').hide();
                        }else{
                            console.log("Sorry! something wrong");
                        }
                    }
                });
            })
    }
}

if (js_included == undefined) {
    var js_included = false;
    if (js_included == false) {
        js_initJQuery();
    }
}
