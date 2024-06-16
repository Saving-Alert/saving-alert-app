<script>
    $(document).on("click", ".btn_accept", function(){
        approvel_id = $(this).attr("attr_approvel_id");
        app_user_id = $(this).attr("attr_user_id");


        alert(approvel_id);



        $.ajax({

                            

                url: '<?php echo base_url();?>/Tracking/accept_donation',
                type: 'post',
                data: {"user_id": app_user_id, "app_id": approvel_id},
                dataType: "json",
                cache: false,
                processData: true,
                success: function (data) {
                    alert("Approved");
                }

                });

            


    })

$()document.on("click", "#", function(){

    url: '<?php echo base_url();?>/Tracking/reject_donation',
                type: 'post',
                data: {"user_id": app_user_id, "app_id": approvel_id},
                dataType: "json",
                cache: false,
                processData: true,
                success: function (data) {
                    alert("ApRejectedproved");
                }

                });

})

</script>