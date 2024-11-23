 // Function to check if a cookie exists
 function checkCookie(cookieName) {
    var cookies = document.cookie.split("; ");
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].split("=");
        if (cookie[0] === cookieName) {
            return cookie[1];
        }
    }
    return null;
}

// Check if the "phone_number" cookie exists
var phoneNumberCookie = checkCookie("phone_number");
//console.log(phoneNumberCookie);
// Check if the current page is index.html
var isIndexPage = window.location.pathname.endsWith("index.html");

if (phoneNumberCookie !== null) {
    // Phone number cookie exists
    //console.log("Phone number cookie exists:", phoneNumberCookie);
    
    if (isIndexPage) {
        // Redirect from index.html to home.html
        console.log("Redirecting from index.html to home.html...");
        window.location.href = "../menu.html";
    }
} else {
    // Phone number cookie doesn't exist
    console.log("Phone number cookie does not exist.");

    if (!isIndexPage) {
        // Redirect from non-index.html pages to index.html
        console.log("Redirecting to index.html...");
        window.location.href = "../index.html";
    }
}