// ;(function() {


	
var auth = new AuthorizationForm();
document.getElementById('navbar-collapse').appendChild(auth.render());
// console.log(auth);

if (getCookie('name') && getCookie('access_token')) {
	auth.MAIN.innerHTML = '<a class="navbar-brand navbar-right" href="javascript:clearCookie();location.reload();">' + getCookie('name') + '</a>';
}

// API('get', 'bot_state', {}, function(res) {
// 	var settingsBlock = new SectionController('Settings');

// 	res.response.map(function(item, index) {
// 		console.log(item);
// 		if (item.type === 'checkbox') {
// 			settingsBlock.appendChild(new CheckboxController(item.title, item.key, item.value));
// 		} else if (item.type === 'text') {
// 			var tInput = new TextInputController(item.title, item.key, item.value);
// 			console.log(tInput._elem);
// 			window.tititi = tInput;
// 			settingsBlock.appendChild(tInput._elem);
// 		}
// 	});

// 	settingsBlock.innerHTML += '<hr>';
// });

// })();