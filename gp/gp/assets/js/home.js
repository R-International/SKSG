function get_home()
{
    var welcome=document.getElementById("welcome");
    var agenda=document.getElementById("agenda");
    var notice=document.getElementById("notice");
   
    $(document).ready(function() {
    $.ajax({
        url: "view_home.php",
        method: "GET",
        dataType: "json",
        success: function(data) {
            console.log(data)
            welcome.innerHTML=data.welcome;
            agenda.innerHTML=data.agenda;
            notice.innerHTML=data.notice;
        }
    });
});
}
get_home();