var abc = 0; //Declaring and defining global increement variable

$(document).ready(function() {
$("#concerr").hide();
$("#dterr").hide();
$("#relerr").hide();
$("#amterr").hide();
$("#dterr").hide();
$("#dt1err").hide();
$("#typerr").hide();
$("#amterr").hide();
$("#paiderr").hide();
$("#nmerr").hide();
$("#dserr").hide();
$("#trerr").hide();
$("#recerr").hide();
$("#dterr").hide();
$(".popup").hide();
$(".line").attr("height",0);
var hr = ($(".line").parent().height())+"px";
$(".line").css("height",hr);
$(".line1").attr("height",0);
var hr = ($(".line1").parent().height())+"px";
$(".line1").css("height",hr);
$(".img").click(function(){
        $("#fileInput").click();
    });
    
$(".img1").click(function(){
        $("#fileInput1").click();
    });
    
   $(".img2").click(function(){
        $("#fileInput2").click();
    });
	$('.error').fadeOut(5000);
	$('.msg').fadeOut(5000);
//To add new input file field dynamically, on click of "Add More Files" button below function will be executed
    $('#add_more').click(function() {
        $(this).before($("<div/>", {id: 'filediv'}).fadeIn('slow').append(
                $("<input/>", {name: 'file[]', type: 'file', id: 'file'}),        
                $("<br/><br/>")
                )); 
    });



$('.imgmap').click(function(){
	var x = $('.imgmap').position();
	$('#imgZoom').css('left',x.left);
	$('#imgZoom').css('top',x.top);
	var h = $('.main-container').height();
	var w = $('.main-container').width();
	$('.imgBack').css('height',h);
//	$('.imgBack').css('width',w);
	$('.imgBack').fadeIn(2000);
	$('#imgZoom').fadeIn(2000);
	});
	
$('#imgZoom').click(function(){
	$('#imgZoom').fadeOut(2000);
	$('.imgBack').fadeOut(2000);
});

$('.imgBack').click(
function(){
	$('#imgZoom').fadeOut(2000);
	$('.imgBack').fadeOut(2000);
	
	});
//following function will executes on change event of file input to select different file	
$('body').on('change', '#fileInput', function(){



	$("#img").empty();
            if (this.files && this.files[0]) {
                 abc += 1; //increementing global variable by 1
				
				var z = abc - 1;
                var x = $(this).parent().find('#previewimg').remove();
               /* $(this).before("<div id='abcd"+ abc +"' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");*/
			   $("#img").find('#previewimg').remove();
               $("#img").append("<img id='previewimg' src=''/>");
			   
			    var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
               
			  /*  $(this).hide();
                $("#abcd"+ abc).append($("<img/>", {id: 'img', src: 'x.png', alt: 'delete'}).click(function() {
                $(this).parent().parent().remove();
                }));*/
            }
        });
		
		$('body').on('change', '#fileInput1', function(){
            if (this.files && this.files[0]) {
                 abc += 1; //increementing global variable by 1
				
				var z = abc - 1;
                var x = $(this).parent().find('#previewimg1').remove();
               /* $(this).before("<div id='abcd"+ abc +"' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");*/
			   $("#img1").find('#previewimg1').remove();
               $("#img1").append("<img id='previewimg1' src=''/>");
			   $("#imgZoom").append("<img id='previewimg2' src=''/>");
			    var reader = new FileReader();
                reader.onload = imageIsLoaded1;
                reader.readAsDataURL(this.files[0]);
               
			  /*  $(this).hide();
                $("#abcd"+ abc).append($("<img/>", {id: 'img', src: 'x.png', alt: 'delete'}).click(function() {
                $(this).parent().parent().remove();
                }));*/
            }
        });


$('body').on('change', '#fileInput2', function(){
            if (this.files && this.files[0]) {
                 abc += 1; //increementing global variable by 1
				
				var z = abc - 1;
                var x = $(this).parent().find('#previewimg2').remove();
               /* $(this).before("<div id='abcd"+ abc +"' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");*/
			   $("#img2").find('#previewimg2').remove();
               $("#img2").append("<img id='previewimg2' src=''/>");
			   $("#imgZoom").append("<img id='previewimg2' src=''/>");
			    var reader = new FileReader();
                reader.onload = imageIsLoaded2;
                reader.readAsDataURL(this.files[0]);
               
			  /*  $(this).hide();
                $("#abcd"+ abc).append($("<img/>", {id: 'img', src: 'x.png', alt: 'delete'}).click(function() {
                $(this).parent().parent().remove();
                }));*/
            }
        });
        
//To preview image     
    function imageIsLoaded(e) {
       /* $('#previewimg' + abc).attr('src', e.target.result);*/
	   $('#previewimg').attr('src', e.target.result);
	   $('#previewimg').attr('height', '150px');
	   $('#previewimg').attr('width', '150px');
    };
	
	function imageIsLoaded1(e) {
       /* $('#previewimg' + abc).attr('src', e.target.result);*/
	   $('#previewimg1').attr('src', e.target.result);
	   $('#previewimg1').attr('height', '150px');
	   $('#previewimg1').attr('width', '150px');
	/*   $('#previewimg2').attr('src', e.target.result);
	   $('#previewimg2').attr('height', '500px');
	   $('#previewimg2').attr('width', '500px');*/
    };

	function imageIsLoaded2(e) {
       /* $('#previewimg' + abc).attr('src', e.target.result);*/
	   $('#previewimg2').attr('src', e.target.result);
	   $('#previewimg2').attr('height', '150px');
	   $('#previewimg2').attr('width', '150px');
	   
    };
    $('#upload').click(function(e) {
        var name = $(":file").val();
        if (!name)
        {
            alert("First Image Must Be Selected");
            e.preventDefault();
        }
    });
});