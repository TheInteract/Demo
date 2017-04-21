<div class="content">
    <div class="content-body">
        <div class="signup-wrapper">
            <h1>Join Twitter today.</h1>
            <div class="field">
                <input id="fullname" interact-click="input.fullname" type="text" placeholder="Full name" />
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
            <div class="field">
                <input id="email" interact-click="input.email" type="text" placeholder="Email" />
                <div class="sidetip">
                    <p class="error blank invalid">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        Please enter a valid email.
                    </p>
                </div>
            </div>
            <div class="field">
                <input id="password" interact-click="input.password" type="password" placeholder="Password" />
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
</div>

<script>
    $(".advanced-options a").click(function() {
        $(".advanced-options .list").slideToggle({
            duration: 500
        });
    });
    $(".submit").click(function() {
        $("")
    });
</script>