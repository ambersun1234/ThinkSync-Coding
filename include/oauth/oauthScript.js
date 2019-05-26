var jQueryScript = document.createElement('script');
jQueryScript.setAttribute('src','https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
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
         }, "json");
     }
}

function googleSignOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
        alert("Sign out");
    });
}
