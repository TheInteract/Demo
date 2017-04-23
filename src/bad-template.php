<div class="content">
    <div class="content-body">
        <div class="signup-wrapper">
            <h1>Registration Form</h1>
            <div class="field">
                  <select interact-click="select-gender" id="gender">
                    <option value="Mr.">Mr.</option>
                    <option value="Ms.">Ms.</option>
                    <option value="Mrs.">Mrs.</option>
                  </select>
                <input class="name" id="firstname" interact-click="input.firstname" type="text" placeholder="First name" tabindex="-1" />
                <input class="name" id="middlename" interact-click="input.middlename" type="text" placeholder="Middle name" tabindex="-1" />
                <input class="name" id="lastname" interact-click="input.lastname" type="text" placeholder="Last name" tabindex="-1" />
            </div>
            <div class="field">
                <input id="email" interact-click="input.email" type="email" placeholder="Email" tabindex="-1" />
            </div>
            <div class="field">
                <input id="email-confirm" interact-click="input.email-confirm" type="email" placeholder="Confirm Email" tabindex="-1" />
            </div>
            <div class="field">
                <input id="password" interact-click="input.password" type="password" placeholder="Password" tabindex="-1" />
            </div>
            <div class="field">
                <input id="password-confirm" interact-click="input.password-confirm" type="password" placeholder="Confirm Password" tabindex="-1" />
            </div>
            <div class="field">
              <textarea id="term" tabindex="-1" interact-click="term.box" readonly="readonly" style="margin: 0px; width: 600px; height: 200px;"><?php include('./src/data/term.php') ?>
              </textarea>
            </div>
            <div class="field">
              <input type="checkbox" interact-click="term.checkbox" id="termCheck" name="termCheck" disabled="disabled" tabindex="-1" />
              <label id="termLabel" for="termCheck">I agree to TERMS and CONDITIONS</label><br>
              <input type="checkbox" id="subscribe" interact-click="subscribe.checkbox" name="subscribe" checked tabindex="-1" />
              <label for="subscribe">Subscribe to newsletter</label>
            </div>
            <input class="submit button" interact-click="button.submit" type="submit" value="Sign up" tabindex="-1" />
        </div>
    </div>
</div>
<script>
    $('#term').scroll(function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            $('#termCheck').prop('disabled', false)
            $('#termLabel').css('color', '#14171a');
        } else {
            $('#termLabel').css('color', '#7e8182');
            $('#termCheck').prop('disabled', true)
            $('#termCheck').prop('checked', false)
        }
    })
    $('.submit').click(function() {
        if (checkNames() && checkEmail() && checkPassword() && checkTerm() && checkGender()) {
          callAPI()
          alert('Successfully registered!')
        }
        resetForm()
    })

    function resetForm () {
        $('#firstname').val('')
        $('#middlename').val('')
        $('#lastname').val('')
        $('#email').val('')
        $('#email-confirm').val('')
        $('#password').val('')
        $('#password-confirm').val('')
        $('#term').scrollTop(0)
        $('#subscribe').prop('checked', true)
        $('.content').scrollTop(0)
    }

    function checkNames () {
      let firstName = $('#firstname').val()
      let middleName = $('#middlename').val()
      let lastName = $('#lastname').val()
      let firstNameMatcher = firstName.match(/\d+/g)
      let middleNameMatcher = middleName.match(/\d+/g)
      let lastNameMatcher = lastName.match(/\d+/g)
      if (!firstName || firstName.length === 0 || firstName.indexOf(' ') > -1 || firstNameMatcher !== null) {
        alert('Please put in valid first name')
        return false
      } else if (!lastName || lastName.length === 0 || lastName.indexOf(' ') > -1 || lastNameMatcher !== null) {
        alert('Please put in valid LAST name')
        return false
      }
      return true
    }

    function isEmail(email) {
      let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return regex.test(email);
    }

    function checkEmail () {
      let isInUse = false
      let email = $('#email').val()
      let emailConfirm = $('#email-confirm').val()
      if (!email || email.length === 0 || email.indexOf(' ') > -1 || !isEmail(email)) {
        alert('Please put in valid email')
        return false
      }
      if (email !== emailConfirm) {
        alert('Email and confirm is not the same')
        return false
      }
      if (email.split('@')[0].length <= 4) {
        alert('Too short email')
        return false
      }
      $.ajax({url: 'api/validate', async: false}).done(function () {
        let hash = email.hashCode()
        if (hash % 5 === 0) {
          alert('Email is already in use')
          isInUse = true
        }
      })
      if (isInUse) {
        return false
      }
      return true
    }

    function checkPassword () {
      let password = $('#password').val()
      let passwordConfirm = $('#password-confirm').val()
      if (!password || password.length === 0 || password.indexOf(' ') > -1) {
        alert('Please put in valid password')
        return false
      }
      if (password.length < 6) {
        alert('Password is too short')
        return false       
      }
      if (password !== passwordConfirm) {
        alert('Password and confirm is not the same')
        return false
      }
      return true
    }

    function checkTerm () {
      let termCheck = $('#termCheck').prop('checked')
      if (!termCheck) {
        alert('Please agree terms and conditions')
        return false
      }
      return true
    }

    function checkGender () {
      let gender = $('#gender').val()
      if (gender === 'Mr.' || gender === 'Ms.' || gender === 'Mrs.') {
        return true
      }
      alert('Invalid gender')
      return false
    }

    function callAPI () {
      $.ajax({url: 'api/submit', async: false})
    }

    String.prototype.hashCode = function(){
      let hash = 0;
      if (this.length == 0) return hash;
      for (i = 0; i < this.length; i++) {
        char = this.charCodeAt(i);
        hash = ((hash<<5)-hash)+char;
        hash = hash & hash; // Convert to 32bit integer
      }
      return hash;
    }
</script>