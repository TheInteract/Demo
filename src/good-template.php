<div class="content">
    <form action="" method="POST">
        <div class="content-body">
            <div class="signup-wrapper">
                <h1>Join Twitter today.</h1>
                <div class="field fullname">
                    <input id="fullname" interact-click="input.fullname" type="text" placeholder="Full name" 
                    data-validation="required" />
                    <div class="sidetip">
                        <p class="ok">
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </p>
                        <p class="error blank">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            What's your name?
                        </p>
                    </div>
                </div>
                <div class="field email">
                    <input id="email" interact-click="input.email" type="text" placeholder="Email"
                    data-validation="email_api" />
                    <div class="sidetip">
                        <p class="checking">
                            Validating...
                        </p>
                        <p class="ok">
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </p>
                        <p class="error blank invalid">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            Please enter a valid email.
                        </p>
                        <p class="already">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            This email is already registered.
                             Want to <a href="https://twitter.com/login" target="_blank">login</a>
                              or <a href="https://twitter.com/account/begin_password_reset" target="_blank">recover your password</a>?
                        </p>
                    </div>
                </div>
                <div class="field">
                    <input id="password" interact-click="input.password" type="password" placeholder="Password"
                    data-validation="length" data-validation-length="min6" />
                    <div class="sidetip">
                        <p class="ok">
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </p>
                        <p class="error blank invalid">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            Your password must be at least 6 characters.
                        </p>
                    </div>
                </div>
                <input class="submit button" interact-click="button.submit" type="submit" value="Sign up" />
                <div class="befound">
                    <p>
                        By signing up, you agree to the
                        <a href="https://twitter.com/tos" interact-click="a.tos" target="_bank">Terms of Service</a> and
                        <a href="https://twitter.com/privacy" interact-click="a.privacy" target="_bank">Privacy Policy</a>, 
                        including <a href="https://support.twitter.com/articles/20170514" interact-click="a.cookie" target="_bank">Cookie Use</a>. Others will be able to find you by email or phone number when provided.
                    </p>
                </div>
                <div class="advanced-options" data-collapse>
                    <a class="toggle" interact-click="a.advanced-options">Advanced options</a>
                    <div class="list">
                        <label>
                            <input type="checkbox" interact-click="input.checkbox.1" value="1" checked />Let others find me by my email address
                        </label>
                        <label>
                            <input type="checkbox" interact-click="input.checkbox.2" value="2" checked />Let others find me by my phone number
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
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
    $(".advanced-options a").click(function() {
        $(".advanced-options .list").slideToggle({
            duration: 500
        });
    });
    $.formUtils.addValidator({
        name: 'email_api',
        errorMessage: 'Email is invalid',
        validatorFunction: function(value, $el, config, language, $form) {
            if(!/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(value)) {
                return false
            }
            $($el[0].nextElementSibling).find('.active').removeClass('active')
            $($el[0].nextElementSibling).find('.checking').addClass('active')
            $.ajax({
                url: `/validate`
            })
            .then(() => {
                setTimeout(function() {
                    $($el[0].nextElementSibling).find('.active').removeClass('active')
                    let hash = value.hashCode()
                    if (hash % 5 === 0 ) {
                        $($el[0].nextElementSibling).find('.already').addClass('active')
                    } else {
                        $($el[0].nextElementSibling).find('.ok').addClass('active')
                    }
                }, 2000);
            })
            return true
        }
    })
    $.validate({
        errorElementClass: '_error',
        modules: 'security',
        inlineErrorMessageCallback: function($input, messageStatus, config) {
            if(messageStatus) {
                onError($input)
            } else {
                onSuccess($input)
            }
            return false
        },
        onSuccess: ($form) => {
            alert('Successfully Registered')
            location.reload()
        }
    })
    function onSuccess($input) {
        $($input[0].nextElementSibling).find('.active').removeClass('active')
        $($input[0].nextElementSibling).find('.ok').addClass('active')
    }
    function onError($input) {
        $($input[0].nextElementSibling).find('.active').removeClass('active')
        $($input[0].nextElementSibling).find('.error').addClass('active')
    }
</script>