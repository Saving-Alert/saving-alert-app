<?php



?>


<html>

<head>
    <title>Accept Blood Request</title>
</head>


<body>

<h1 id="acc_dis"></h1>
<button id="blood_accept">Accept</button>


</body>

</html>

<script
    src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous"></script>

<script>


    $(document).on("click", "#blood_accept", function(){

        $(this).prop("disabled",true);


        req_id = "<?php echo $request_id ?>";
        get_uuid = "<?php echo $get_uuid ?>";

        $.ajax({



            url: '<?php echo base_url();?>/Mobile/Mobile/approve_sms',
            type: 'post',
            data: {"reqid": req_id, "get_uuid": get_uuid},
            dataType: "json",
            cache: false,
            processData: true,
            success: function (data) {
                $("#acc_dis").html("");
                $("#acc_dis").html("Accepted");
            }

        });

    });



    var l_lat = "";
    var l_long = "";


    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {

        }
    }

    function showPosition(position) {
        l_lat = position.coords.latitude;
        l_long = position.coords.longitude;



    }


    setInterval(function () {

        getLocation();

        get_uuid = "<?php echo $get_uuid ?>";

        $.ajax({


            url: '<?php echo base_url();?>/Location/submit_location_nologin',
            type: 'post',
            data: {"loc_lat": l_lat, "loc_long": l_long, "get_uuid" : get_uuid},
            dataType: "json",
            cache: false,
            processData: true,
            success: function (data) {

            }

        });


    }, 3000);





</script>