<?php include('header.php'); ?>
    <!--body part-->
    <div class="row">
        <div class="large-6 columns ">
            <div id="fileContainer" class="containerStyle"></div>
        </div>
        <div class="large-6 columns">
            <div id="selected_file"></div>
            <div id="actionWrap">
                <a class="button radius tiny" id="downloadButton"><span id="numberOfDown">Download file(s)</span> </a>
                <a href="#" data-reveal-id="deleteAskModal" class="button radius tiny secondary" id="deleteBtn"><span>Delete</span></a>
            </div>
        </div>
    </div>
<?php include('footer.php'); ?>