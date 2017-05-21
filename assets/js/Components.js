function SNTree(el, elements, mainElement) {
	if (!elements) elements = {};
	var _resultElement = document.createElement(el.tag);
	var keys = Object.keys(el);
	keys.map(function(item, index) {
		_resultElement[item] = el[item];
	});
	if (el.children) {
		if (Array.isArray(el.children)) {
			el.children.map(function(item, index) {
				var element = SNTree(item, elements);
				if (item.name) {
					elements[item.name] = element.render();
				}
				_resultElement.appendChild(element.render());
			});
		} else if (typeof el.children === Object) {
			var element = SNTree(el, elements);
			if (el.name) {
				elements[el.name] = element.render();
			}
			_resultElement.appendChild(element.render());
		} else {

		}
	}

	elements['render'] = function() { return _resultElement; }
	if (mainElement) {
		elements["MAIN"] = _resultElement;
	}
	return elements;
}

function AuthorizationForm() {
	return this.createElement();
}

AuthorizationForm.prototype.createElement = function() {
	var el = SNTree({
		tag: 'div',
		children: [{
			tag: 'form',
			className: 'navbar-form navbar-right',
			name: 'signForm',
			role: 'form',
			children: [{
				tag: 'div',
				className: 'input-group',
				children: [{
					tag: 'span',
					className: 'input-group-addon',
					innerHTML: '<i class="glyphicon glyphicon-user"></i>',
				},{
					tag: 'input',
					name: 'loginInput',
					type: 'text',
					placeholder: 'Login',
					className: 'form-control',
				}]
			},{
				tag: 'span',
				textContent: ' ',
			},{
				tag: 'div',
				className: 'input-group',
				children: [{
					tag: 'span',
					className: 'input-group-addon',
					innerHTML: '<i class="glyphicon glyphicon-lock"></i>',
				},{
					tag: 'input',
					name: 'passwordInput',
					type: 'password',
					placeholder: 'Password',
					className: 'form-control',
				}]
			},{
				tag: 'span',
				textContent: ' ',
			},{
				tag: 'button',
				name: 'loginButton',
				type: 'submit',
				className: 'btn btn-primary',
				textContent: 'Login',
			}],
		}]
	}, false, true);
	
	// el.loginButton.addEventListener('click', function(e) {
	el.loginButton.addEventListener('click', function(e) {
		var login = el.loginInput.value;
		var password = el.passwordInput.value;
		console.log(el.loginInput.value, el.passwordInput.value);
		API('auth', 'login', {login: el.loginInput.value, password: el.passwordInput.value}, function(resp) {
			console.log(resp);
			if (resp.response) {
				el.MAIN.innerHTML = '<a class="navbar-brand navbar-right" href="javascript:clearCookie();location.reload();">' + resp.response.name + '</span>';
				updateCookie(resp.response.access_token, resp.response.name);
				location.reload();
			}
		});
		e.preventDefault();
	});

	return el;
}

function Alert(title, description) {
	var el = document.createElement('div');
	el.className = 'alert alert-success alert-dismissable fade in';
	el.innerHTML = '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> \
					<strong>' + title + '</strong>' + description;
	return el;
}

function SectionController(title) {
	var element = document.createElement('section');
	var section = document.createElement('div');
	element.innerHTML = '<h1>' + title + '</h1>';
	element.appendChild(section);
	document.getElementById('container').appendChild(element);
	return section;
}

function CheckboxController(title, key, value) {
	var self = this;
	this.key = key
	this.enabled = (value == 0 ? false : true);
	var element = document.createElement('div');
	element.className = 'checkbox';
	element.innerHTML = '<label><input type="checkbox" ' + (this.enabled ? 'checked' : '') + ' >' + title + '</label>';

	element.addEventListener('click', function(e) {
		self.enabled = !self.enabled;
		API('bot', self.key, {
			enabled: (self.enabled ? '1' : '0')
		}, console.log);
	});

	return element;
}

function TextInputController(title, key, value) {
	this.key = key
	this.value = value;
	this.title = title;
	
	var self = this;

	this._elem = document.createElement('div');
	this._elem.className = 'input-group';

	this._input = document.createElement('input');
	this._input.className = 'form-control';
	this._input.placeholder = this.title;
	this._input.value = this.value;

	this._span = document.createElement('span');
	this._span.className = 'input-group-btn';

	this._button = document.createElement('button');
	this._button.textContent = 'Save';
	this._button.className = 'btn btn-primary';

	this._button.addEventListener('click', function(e) {
		self.value = self._input.value;
		API('bot', self.key, {
			value: self.value,
		}, function(res) {
			console.log(res);
		});
	});

	this._elem.appendChild(this._input);
	this._elem.appendChild(this._span);
	this._span.appendChild(this._button);

	return this;
}

