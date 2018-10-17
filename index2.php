<html>
<head>
<script src="jquery.min.js"></script>
 <link rel="stylesheet" href="style.css">
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
</head>
<body>
    <a href="#" id="go">Обратная связь</a>
<div class="wrapper">
    <div id="modal_form">
        <a href="#" id="exit"><i class="fas fa-times-circle"></i></a>
        <form method="post" action="#">
            <div class="sub-block">
                <label id="name-label"for="name">Ваше имя*</label>
                <input type="text" id="name" name="name" class="nameField" required>
            </div>
            <div class="sub-block">
                <label for="phone">Ваш номер телефона*</label>
                <input type="tel" id="phone" name="phone" class="phoneField" required pattern="[0-9]{10}">
            </div>
            <div class="sub-block">
                <label for="comment">Комментарий к заявке</label>
                <input type="text" id="comment" name="comment" class="commentField"> 
            </div>
            <div class="sub-block">
                <div id="cleaner"><i class="fas fa-times"></i> <a href="#" >Очистить</a></div>
                <input type="submit" id="btn-submit" value="Отправить" class="button">
            </div>
        </form>
       
    </div>
    <div id="overlay"></div>
</div>

<table class="rows">

</table>


<script>

$(document).ready(function() {
let clear = () => { 
            jQuery('.nameField').val('');
            jQuery('.phoneField').val('');
            jQuery('.commentField').val('');
}
	$('#go').click( function(event){ 
		event.preventDefault(); 
		$('#overlay').fadeIn(400, 
		 	function(){ 
				$('#modal_form') 
					.css('display', 'block') 
					.animate({opacity: 1, top: '50%'}, 200); 
		});
	});
	function closeForm(){
        
    }
	$('#exit, #overlay').click( function(){ 
		$('#modal_form')
			.animate({opacity: 0, top: '45%'}, 200, 
				function(){
					$(this).css('display', 'none');
					$('#overlay').fadeOut(400);
				}
			);
	});
    var required = ["name", "phone"];
    var required_show = ["Ваше имя", "номер телефона"];
    function sendform () {

    let i, j;

    for(j=0; j<required.length; j++) {
        for (i=0; i<document.forms[0].length; i++) {
            if (document.forms[0].elements[i].name == required[j] && document.forms[0].elements[i].value == "" ) {
            document.forms[0].elements[i].focus();
            document.forms[0].elements[i].style.outlineColor='red';

            return false;
            }
        }
    }if($('.phoneField')!=/^\d+$/){
        document.forms[0].elements[1].focus();
        document.forms[0].elements[1].style.outlineColor='red';
        
    }
    return true;
    }

    jQuery(".button").bind("click", function() {

        var name = jQuery('.nameField').val();
		var phone = jQuery('.phoneField').val();
		var comment = jQuery('.commentField').val()
        sendform();
            jQuery.ajax({
                url: "for_db.php",
                type: "POST",
                data: {name:name, phone:phone, comment: comment},
                dataType: "json",
                success: function(result) {
                    if (result){ 
                        alert("Cообщение об успешной отправке");
                        clear();
                            $('#modal_form')
                                .animate({opacity: 0, top: '45%'}, 200, 
                                    function(){ 
                                        $(this).css('display', 'none');
                                        $('#overlay').fadeOut(400); 
                                    }
                                );
                        
                        console.log(result);
                    }else{
                        alert(result.message);
                    }
                    return false;
                }
            });
        
	return false;
    });
    $('#cleaner').bind('click',()=>clear());
});
</script>
</body>
</html>