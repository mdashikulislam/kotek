	function getSearchResults(searchType,searchID)
	{ var chkStatus =0;
		
		if(searchType =='make')
		{
			urlStore = siteUrl+"pages/saveSearch/"+searchType+"/"+searchID;
			urlSet = siteUrl+"pages/filterProduct/model/"+searchID;
		}
		if(searchType =='model')
		{
			urlStore = siteUrl+"pages/saveSearch/"+searchType+"/"+searchID;
			urlSet = siteUrl+"pages/filterProduct/year/"+searchID;
		}
                if(searchType =='yearSearch')
		{
			var searchyear = parseInt($("#searchYear").val());
			
			if(isNumericVal(searchyear))
			{
			urlStore = siteUrl+"pages/saveSearch/year/"+searchyear+"-"+searchyear;
			//urlSet = siteUrl+"pages/filterProduct/group/"+searchID;
                        urlSet = siteUrl+"pages/filterProduct/group/"+searchyear+"-"+searchyear;
			}
			else {
				jQuery("#showError").html("<br/>Please enter no more than 4 digits eg. 2011 ");
				
				return false; }
		}
		if(searchType =='year')
		{
			urlStore = siteUrl+"pages/saveSearch/"+searchType+"/"+searchID;
			urlSet = siteUrl+"pages/filterProduct/group/"+searchID;
		}
		if(searchType =='group')
		{
			urlStore = siteUrl+"pages/saveSearch/group/"+searchID;
			urlSet = siteUrl+"pages/searchProductShow";
		}
		chkStatus = 0;
			//alert(searchType);
 		    //alert(urlSet);
				$.ajax({
				url: urlStore,
				context: document.body,
				success: function(){
					if(searchType =='group')
		{  //alert(urlSet);
			window.location =urlSet;
			return false;
			
		}else{
		jQuery.facebox({ ajax: urlSet }) 
		}
					}
				});
				
			
		/*		
		if(searchType =='group')
		{  //alert(urlSet);
			window.location =urlSet;
			return false;
			
		}else{
		jQuery.facebox({ ajax: urlSet }) 
		} */
		return false;
	}
	function goBack(strUrl)
	{
	strUrl = siteUrl+"pages/"+strUrl;
	//alert(strUrl);
	jQuery.facebox({ ajax: strUrl })
	return false;
	}
	function showModel()
	{
		var groups = new Array;
		var selObj = document.getElementById('make');
		var selIndex = selObj.selectedIndex;
		var searchModel = selObj.options[selIndex].value;
		urlStore = siteUrl+"pages/getModelList/"+searchModel;
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
		if(subc == "" || subc== "enter your email address") { 
		jQuery.facebox('<div>&nbsp;</div><div>&nbsp;</div><div><p style="color:#f10;text-align:center;">Please enter email address</p></div><div>&nbsp;</div><div>&nbsp;</div>');
		return false;
		}
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		///var address = subc;
		if(reg.test(subc) == false) { 
		jQuery.facebox('<div>&nbsp;</div><div>&nbsp;</div><div><p style="color:#f10;text-align:center;">Invalid email address</p></div><div>&nbsp;</div><div>&nbsp;</div>');
		return false;
		}else{
		var couponurl = siteUrl+"pages/subscribe/"+subc;
		
		$.ajax({
		url: couponurl,
		context: document.body,
		success: function(data){
		jQuery.facebox(data);
		}
		}); 
		
		}
		}

	// function to check numeric val
		// returns true if the string only contains characters 0-9
		function isNumericVal(str){
		if($("#searchYear").val().length != 4)
			{ return false;
			}
		var re = /[\D]/g
		if (re.test(str)) return false;
		return true;
		}
      
	  
	  
	  function showProduct()
		{
			
			var groups = new Array;
		var selObj = document.getElementById('make');
		var selIndex = selObj.selectedIndex;
		var searchModel = selObj.options[selIndex].value;
		var selObj = document.getElementById('group');
		var selIndex = selObj.selectedIndex;
		var searchGroup = selObj.options[selIndex].value;
		var year = document.getElementById('year').value;
		urlStore = siteUrl+"pages/getQuickSearchProductList/"+searchModel+"/"+searchGroup+"/"+year;
		//alert(urlStore);
		
		jQuery.ajax({
				url: urlStore,
				context: document.body,
				success: function(data){	
				
				jQuery("#showQuickProduct").html(data);
				}
				});
		}