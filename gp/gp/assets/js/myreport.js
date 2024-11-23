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
});

$(document).ready(function() {
    $.ajax({
        url: "view_report.php",
        method: "GET",
        data: { phoneNumber: phoneNumberCookie },
        success: function(response) {
            displayPrayCount(response);
            //console.log(response)
        }
    });
});

function displayUserData(data) {
    var userName = $("#userName"); // Use jQuery to select the element
    var profilePic= $("#profilePic"); // Use jQuery to select the element
    var uname="";
    var profilePic_data="";
    for (var i = 0; i < data.length; i++) {
        uname= data[i].first_name + " " + data[i].last_name;
        profilePic_data=data[i].userPic;
    }
    userName.html(uname); // Use jQuery to set the HTML content
    profilePic.attr("src","assets/img/user/"+profilePic_data); // Use jQuery to set the HTML content
}

function displayPrayCount(data) {
    var pray_table = $("#pray_table"); // Use jQuery to select the element
    var total_count_text = $("#total_count"); // Use jQuery to select the element
    var counter_data=`<table class="table table-hover table-bordered">
    <thead class="bill-header cs">
        <tr>
            <th id="trs-hd-1" class="col-lg-1" style="background: rgb(255,199,0);">SL. No.</th>
            <th id="trs-hd-2" class="col-lg-2" style="background: rgb(255,199,0);">Date</th>
            <th id="trs-hd-3" class="col-lg-3" style="background: rgb(255,199,0);">Time Stamp</th>
            <th id="trs-hd-4" class="col-lg-2" style="background: rgb(255,199,0);">Count</th>
        </tr>
    </thead>
    <tbody>
        <tr class="warning no-result">
            <td colspan="12"><i class="fa fa-warning"></i>&nbsp; No Result !!!</td>
        </tr>`;
    var serial=0;
    var total_count=0;
    for (var i = 0; i < data.length; i++) {
        serial=i+1;
        counter_data+= "<tr>"+
        "<td>"+serial+"</td>"+
        "<td>"+data[i].cur_date +"</td>"+
        "<td>"+data[i].updated_timestamp +"</td>"+
        "<td>"+data[i].prayCounter +"</td>"+
        "</tr>";
        total_count+=data[i].prayCounter;
    }
    counter_data+=`   </tbody>
    </table>`;
    pray_table.html(counter_data); // Use jQuery to set the HTML content
    total_count_text.html("<b>My Total Pray Count:</b> &nbsp;"+total_count)
}

$(document).ready(function() {
    $("#uploadButton").click(function() {
        const selectedFile = $('#imageUpload')[0].files[0];

        // Check if a file is selected
        if (selectedFile) {
            // Check the file size (in bytes)
            const maxSize = 5 * 1024 * 1024; // 5MB
            if (selectedFile.size <= maxSize) {
                var formData = new FormData();
                formData.append('image', selectedFile);
                var progress_bar=`<div class="progress mt-2" style="">
                <div id="uploadProgress" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">0%</div>
            </div>`;
            $("#uploadProgress1").html(progress_bar);
                $.ajax({
                    url: 'upload.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e) {
                            if (e.lengthComputable) {
                                var percent = Math.round((e.loaded / e.total) * 100);
                                $("#uploadProgress").css("width", percent + "%").attr("aria-valuenow", percent).text(percent + "%");
                            }
                        });
                        return xhr;
                    },
                    success: function(response) {
                        response = JSON.parse(response);
                        if (response.status === 'success') {
                            //alert('Image uploaded successfully!');
                            location.reload();
                            $("#profilePic").attr('src', response.imagePath);
                        } else {
                            alert('Image upload failed.');
                        }
                    }
                });
            } else {
                alert('Selected image exceeds the maximum allowed size of 5MB.');
            }
        } else {
            alert('Please select an image to upload.');
        }
    });
});

function openUploadModal() {
    $('#uploadModal').modal('show'); // This line triggers the modal to show
}

$(document).ready(function() {
    // Handle click event on the close button
    $("#closeModalButton").click(function() {
        // Close the modal using jQuery
        $("#uploadModal").modal("hide");
    });
});