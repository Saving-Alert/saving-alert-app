<ul id="respMenu" class="ace-responsive-menu text-right" data-menu-style="horizontal">
    <li>
        <a href="<?php echo base_url() ?>"><span class="title">Home</span></a>
        <!-- Level Two-->
    </li>
    <li>
        <a href="<?php echo base_url() ?>/Donations"><span class="title">Donations</span></a>
        <!-- Level Two-->
    </li>

    <li>
        <a href="<?php echo base_url() ?>/Plasma"><span class="title">Plasma</span></a>
        <ul>
            <li><a href="<?php echo base_url(); ?>/Plasma">What is plasma?</a></li>
            <li><a href="#">Who can donate plasma</a>
                <ul>
                    <li><a href="#"><span class="title">Plasma donors and disability</span></a></li>
                </ul>
            </li>
            <li><a href="#">Where to donate plasma</a></li>
            <li><a href="#">How to donate plasma</a></li>
            <li><a href="#">Why we need plasma donors</a></li>

        </ul>
    </li>

    <li>
        <a href="<?php echo base_url() ?>/WhyGiveBlood"><span class="title">Why give blood</span></a>
        <ul>
            <li><a href="#">Demand for different blood types</a></li>
            <li><a href="#">Blood types</a></li>
            <li><a href="#">How blood is used</a></li>
            <li><a href="#">Who you could help</a></li>
        </ul>
    </li>

    <li>
        <a href="<?php echo base_url() ?>/WhoCanGive"><span class="title">Who can give blood</span></a>
        <ul>
            <li><a href="#">Can I give blood?</a></li>
            <li><a href="#">Getting an appointment</a>
            <li><a href="#">Health and Eligibility</a></li>
            <li><a href="#">Travel considerations</a></li>
            <li><a href="#">Occupation considerations</a></li>
            <li><a href="#">Donors and disability</a></li>
        </ul>
    </li>

    <li>
        <a href="<?php echo base_url() ?>/WhoCanGive"><span class="title">The donation process</span></a>
        <ul>
            <li><a href="#">Giving blood for the first time</a></li>
            <li><a href="#">Registering online</a>
            <li><a href="#">Preparing to give blood</a></li>
            <li><a href="#">What happens on the day</a></li>
            <li><a href="#">After your donation</a></li>
            <li><a href="#">About our donation venues</a></li>
            <li><a href="#">Children at donation venues</a></li>
            <li><a href="#">Further information</a></li>
            <li><a href="#">Recognising donors</a></li>
        </ul>
    </li>

    <li>
        <a href="<?php echo base_url() ?>/Requests"><span class="title">Blood Requests</span></a>

    </li>

    <li class="last">
        <a href="<?php echo base_url() ?>/Contact"><span class="title">Contact</span></a>
    </li>

    <?php

    $log_btn = '<li class="list-inline-item list_s"><a href="#" class="btn flaticon-user" data-toggle="modal" data-target=".bd-example-modal-lg"> <span class="dn-lg">Login/Register</span></a></li>';

    if(isset($_SESSION['front_logged_in'])){
        if($_SESSION['front_logged_in']){

            echo '
								<li>
									<a href="'.base_url().'/Account"><span class="title">Account</span></a>
									<ul>
										<li><a href="'.base_url().'/Account">Account</a></li>
										<li><a href="'.base_url().'/Logout">Logout</a></li>
										
									</ul>
								</li>
								';

        }else{
            echo $log_btn;
        }

    }else{
        echo $log_btn;
    }

    ?>

    <!-- <li class="list-inline-item add_listing head_btn_submit_don"><a href="#" id="head_btn_submit_don"><span class="flaticon-plus"></span><span class="dn-lg" > Submit Donation</span></a></li> -->

</ul>