function getCookie(name) {
	var matches = document.cookie.match(new RegExp(
		"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
	));
	return matches ? decodeURIComponent(matches[1]) : undefined;
}

function updateCookie(accessToken, name) {
	var date = new Date(new Date().getTime() + 60 * 60 * 1000);
	document.cookie = "access_token=" + accessToken + "; path=/; expires=" + date.toUTCString();
	document.cookie = "name=" + name + "; path=/; expires=" + date.toUTCString();
}

function clearCookie() {
	var date = new Date(0);
	document.cookie = "access_token=; path=/; expires=" + date.toUTCString();
	document.cookie = "name=; path=/; expires=" + date.toUTCString();
}

function API(type, method, params, callback) {

	var token = getCookie('access_token');

	params['method'] = method;
	params['type'] = type;
	// params['access_token'] = token;
	
	// if (!token) {
	// 	params['method'] = 'auth';
	// 	params['type'] = 'login';		
	// 	params['access_token'] = '';
	// }

	var request = new XMLHttpRequest();
	request.open('POST', 'admin_api.php', true);
	request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
	request.onreadystatechange = function() {
		if (this.readyState === 4) {
			if (this.status >= 200 && this.status < 400) {
				var data = JSON.parse(this.responseText);
				(callback || function(){})(data);
			} else {}
		}
	};

	request.send(JSON.stringify(params));
}