    let name = document.getElementById('name');
    let email = document.getElementById('email');
    let password = document.getElementById('password');
    let password2 = document.getElementById('password2');
    let register = document.getElementById('register');
    let notes = document.getElementById('notes');
    let rules = document.getElementById('rules');
    let flag1 = null;
    let flag2 = null;
    let flag3 = null;
    let flag4 = null;

    name.onblur = function () {
      if (4 < name.value.length && name.value.length < 11 ) {
        console.log('ok');
        flag1 = true;
      } else {
        flag1 = false;
        console.log('no 22');
      }
      regAccess();
    }

    email.onblur = function () {
      let reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
      if (reg.test(email.value) == true) {
        console.log('ok');
        flag2 = true;
      } else {
        console.log('no 33');
        flag2 = false;
      }
      regAccess();
    }

    password.onfocus = function () {
      notes.removeAttribute("hidden");
    }

    password.onblur = function () {
      if (5 < password.value.length && password.value.length < 21 ) {
        console.log('ok');
        flag3 = true;
      } else {
        console.log('no');
        flag3 = false;
      }
      notes.setAttribute("hidden", "true");
      regAccess();
    }

    password2.onblur = function () {
      if ((5 < password.value.length && password.value.length < 21) && (5 < password2.value.length && password2.value.length < 21)) {
        console.log('ok');
        flag4 = true;
      } else {
        console.log('no');
        flag4 = false;
      }
      regAccess();
    }

    rules.onfocus = regAccess();

    function regAccess() {
      if (!(flag1 == true && flag2 == true && flag3 == true && flag4 == true)) {
        console.log('setAttribute');
        (!register.hasAttribute("disabled")) ? register.setAttribute("disabled") : false;
      } else {
        console.log('removeAttribute');
        register.removeAttribute("disabled");
      }
    }
