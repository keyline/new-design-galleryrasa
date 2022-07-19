    $(document).ready(function() {
    	
    var progressbox1     = $('#logoForm .progress');
    var progressbar1     = $('#logoForm .progress-bar');
    var submitbutton1    = $("#SubmitLogoButton");
    var logoform          = $("#logoForm");
    var output1          = $("#outputLogo");
    var logo         = $("#logo");
    var completed1       = '0%';
    progressbox1.hide();
    $(logoform).ajaxForm({
  	
        beforeSend: function() { //brfore sending form
        submitbutton1.attr('disabled', ''); // disable upload button
        progressbox1.show(); //show progressbar
        progressbar1.width(completed1); //initial value 0% of progressbar
              },
        uploadProgress: function(event, position, total, percentComplete) { //on progress
        progressbar1.width(percentComplete + '%') //update progressbar percent complete
        
    },
    complete: function(response) { // on complete
    if(response.responseText.substr(0,1) == '{'){
         obj= $.parseJSON(response.responseText);  
    
	 if(obj.code==1) { 
		logo.html(obj.img); 
		output1.html(obj.msg);
		
	}
	else {
		output1.html(obj.msg);
	}
}
else {
 output1.html(response.responseText);
}
    logoform.resetForm();  // reset form
    submitbutton1.removeAttr('disabled'); //enable submit button
    progressbox1.slideUp(); // hide progressbar
}
}); 

 var progressbox     = $('.progress');
    var progressbar     = $('.progress-bar');
    var submitbutton    = $("#SubmitButton");
    var myform          = $("#UploadForm");
    var output          = $("#output");
    var completed       = '0%';
    progressbox.hide();
    $(myform).ajaxForm({
  	
        beforeSend: function() { //brfore sending form
        submitbutton.attr('disabled', ''); // disable upload button
        progressbox.show(); //show progressbar
        progressbar.width(completed); //initial value 0% of progressbar
              },
        uploadProgress: function(event, position, total, percentComplete) { //on progress
        progressbar.width(percentComplete + '%') //update progressbar percent complete
        
    },
    complete: function(response) {  // on complete
    output.html(response.responseText); //update element with received data
    myform.resetForm();  // reset form
    submitbutton.removeAttr('disabled'); //enable submit button
    progressbox.slideUp(); // hide progressbar
}
}); 
});

