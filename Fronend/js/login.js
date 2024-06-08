function toggleForms() {
    switchForms('.from-login', '.from-register');
}

function returnToLogin() {
    switchForms('.from-register', '.from-login');
}

function switchForms(fromFormSelector, toFormSelector) {
    var fromForm = document.querySelector(fromFormSelector);
    var toForm = document.querySelector(toFormSelector);

    fromForm.classList.add('hidden');
    toForm.classList.remove('hidden');
}
