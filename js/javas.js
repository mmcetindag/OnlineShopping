	function hk_email(email){
			if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
				return true;
			}else{
				return false;
			}
	}
	function hk_phoneNo(phoneno){
		if (/^(\+91-|\+91|0)?\d{10}$/.test(phoneno)) {
			return true;
		}else{
			return false;
		}
	}
	function hk_inArray(needle, haystack){
		if ($.inArray(needle, haystack) != -1) {
			return true;
		}else{
			return false;
		}
	}
	function hk_validateUrl(urlToValidate){
		var myRegExp = /^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/[^\s]*)?$/i;
		if (myRegExp.test(urlToValidate)) {
			return true;
		}else{
			return false;
		}
	}

	function hk_update_cart_cout(id){
		var recent = parseInt($(id).text());
		var update = recent + 1;
		console.log(update);
		$(id).html(update);
	}
