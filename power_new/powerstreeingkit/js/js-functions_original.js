	function getSearchResults(searchType,searchID)
	{
		if(searchType =='make')
		{
			urlStore = siteUrl+"index.php/pages/saveSearch/"+searchType+"/"+searchID;
			urlSet = siteUrl+"index.php/pages/filterProduct/model/"+searchID;
		}
		if(searchType =='model')
		{
			urlStore = siteUrl+"index.php/pages/saveSearch/"+searchType+"/"+searchID;
			urlSet = siteUrl+"index.php/pages/filterProduct/year/"+searchID;
		}
		if(searchType =='group')
		{
			urlStore = siteUrl+"index.php/pages/saveSearch/group/"+searchID;
			urlSet = siteUrl+"index.php/pages/searchProductShow";
		}
			//alert(searchType);
 		    //alert(urlStore);
				$.ajax({
				url: urlStore,
				context: document.body,
				success: function(){}
				});
				
			
				
		if(searchType =='group')
		{  
		    //alert(urlSet);
			window.location =urlSet;
			return false;
		}
		jQuery.facebox({ ajax: urlSet }) 
		return false;
	}
	function showModel()
	{
		var groups = new Array;
		var selObj = document.getElementById('make');
		var selIndex = selObj.selectedIndex;
		var searchModel = selObj.options[selIndex].value;
		urlStore = siteUrl+"index.php/pages/getModelList/"+searchModel;
		//alert(urlStore);
		$.ajax({
				url: urlStore,
				context: document.body,
				success: function(data){
				$("#showModel").html(data);
				}
				});
		
	}
	
		function subscribe(){
		var subc = $("#subscribe_email").val();
		validate(subc);	
		return false;
		}
    	function validate(subc) {
		
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		///var address = subc;
		if(reg.test(subc) == false) { 
		jQuery.facebox('<div>&nbsp;</div><div>&nbsp;</div><div><p style="color:#f10;text-align:center;">Invalid email address</p></div><div>&nbsp;</div><div>&nbsp;</div>');
		return false;
		}else{
		var couponurl = siteUrl+"index.php/pages/subscribe/"+subc;
		
		$.ajax({
		url: couponurl,
		context: document.body,
		success: function(data){
		jQuery.facebox(data);
		}
		}); 
		
		}
		}