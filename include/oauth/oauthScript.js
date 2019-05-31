var jQueryScript = document.createElement('script');
jQueryScript.setAttribute('src','https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
// jQueryScript.setAttribute('src2', 'https://apis.google.com/js/platform.js');
document.head.appendChild(jQueryScript);

function googleOnSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();

    /* profile.getXXXX() have content only if user is logged in
     * store profile's content to php session
     */
     if (profile.getEmail()) {
         /* google Oauth 2.0 success
          * set session variable
          */
         $.post(
             "./login_finish.php",
             {"token": googleUser.getAuthResponse().id_token, "email": profile.getEmail(), "mode": "goauth"}, function(data) {
                 if (data.code == 0) {
                     window.location = "./home.php";
                 }
                 else {
                     alert("User not found in ThinkSync-Coding.\nPlease register to continue.");
                     googleOnSignOut();
                     window.location = "./register.php";
                 }
         }, "json");
     }
}

function googleOnSignUp(googleUser) {
    var profile = googleUser.getBasicProfile();

    if (profile.getEmail()) {
        $.post(
            "./register_finish.php",
            {"token": googleUser.getAuthResponse().id_token, "email": profile.getEmail(), "mode": "goauth"}, function(data) {
                if (data.code == 0) {
                    window.location = "./home.php";
                }
            }, "json");
    }
}

function googleOnSignOut(callback) {
    gapi.load('auth2', function() {
        gapi.auth2.init().then(function() {
            var client = gapi.auth2.getAuthInstance();
            client.signOut().then(function() {
                // loaded
                callback();
            }, function() {
                // failed
                alert("Sign out failed.");
            });
        });
    });
}
