// Assuming you've obtained phoneNumberCookie correctly before this code
$(document).ready(function() {
    $.ajax({
        url: "get_info.php",
        method: "GET",
        data: { phoneNumber: phoneNumberCookie },
        success: function(response) {
            displayUserData(response);
            //console.log(response)
        }
    });

    function displayUserData(data) {
        var profilePic= $("#profilePic"); // Use jQuery to select the element
        var profilePic_data="";
        for (var i = 0; i < data.length; i++) {
            profilePic_data=data[i].userPic;
            if( !profilePic_data){
                profilePic_data='default.png';
            }
        }
        profilePic.attr("src","assets/img/user/"+profilePic_data); // Use jQuery to set the HTML content
    }
    
});

$(document).ready(function() {
    $.ajax({
        url: "get_count_data2.php",
        method: "GET",
        success: function(response) {
            displayRankData(response);
            //console.log(response)
        }
    });
});

function displayRankData(data) {
    var pray_table = $("#rank_table"); // Use jQuery to select the element
    var myRank= $("#myRank"); // Use jQuery to select the element
    var counter_data=`<table class="table table-hover table-bordered">
    <thead class="bill-header cs">
        <tr>
            <th id="trs-hd-1" class="col-lg-1" style="background: rgb(254,199,0);">Serial</th>
            <th id="trs-hd-2" class="col-lg-2" style="background: rgb(254,199,0);">Name</th>
            <th id="trs-hd-2" class="col-lg-2" style="background: rgb(254,199,0);">Phone Number</th>
            <th id="trs-hd-3" class="col-lg-3" style="background: rgb(254,199,0);">Count</th>
            <th id="trs-hd-3" class="col-lg-3" style="background: rgb(254,199,0);">Current Date</th>
            <th id="trs-hd-3" class="col-lg-3" style="background: rgb(254,199,0);">Start Date Time</th>
            <th id="trs-hd-3" class="col-lg-3" style="background: rgb(254,199,0);">End Date Time</th>
            <th id="trs-hd-3" class="col-lg-3" style="background: rgb(254,199,0);">Date & Time</th>
            <th id="trs-hd-4" class="col-lg-2" style="background: rgb(254,199,0);">Location</th>
        </tr>
    </thead>
    <tbody>
        <tr class="warning no-result">
            <td colspan="12"><i class="fa fa-warning"></i>&nbsp; No Result !!!</td>
        </tr>`;

        for (var i = 0; i < data.length; i++) {
            counter_data+= "<tr>"+
            "<td class='text-center'>"+(i+1)+"</td>"+
            "<td>"+data[i].first_name +" "+ data[i].last_name+"</td>"+
            "<td class='text-center'>"+data[i].phone_number +"</td>"+
            "<td class='text-center'>"+data[i].prayCounter +"</td>"+
            "<td class='text-center'>"+data[i].cur_date +"</td>"+
            "<td class='text-center'>"+data[i].created_timestamp +"</td>"+
            "<td class='text-center'>"+data[i].updated_timestamp +"</td>"+
            "<td class='text-center'>"+data[i].updated_timestamp +"</td>"+
            "<td>"+data[i].city+","+data[i].state+","+data[i].pin_code+"</td>"+
            "</tr>";
            if(phoneNumberCookie===data[i].phoneNumber){
                myRank.text(data[i].rank) 
            }
        }

    counter_data+=`   </tbody>
    </table>`;
    pray_table.html(counter_data); // Use jQuery to set the HTML content
}
