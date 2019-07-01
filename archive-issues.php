<?php get_header(); ?>

    <div class="container-block">
        <div class="content blocks  ">

            <div class="col-md-9">
                <div class="row">
                    <div class="dropdown pull-right"><span>Please choose the year</span>
                        <button class="btn btn-default dropdown-toggle dropdown-width" type="button" id="year-drop-down-menu"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Choose Year<span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" id="year-dropdown" aria-labelledby="dropdownMenu1">
                            <?php populateDropdown(); ?>
                        </ul>
                    </div>
                </div>
                <!--    <div class="clearfix"></div>-->
                <div class="row">
                    <div class="issues-wrapper">
                        <div class="">
                            <div class="row">
                                <div class="issue-box" id="issue-box">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>


<script type="text/javascript">
    jQuery(function($) {

        $(document).ready(function(){
            $("#current-year").trigger("click");
        });

        $('#year-dropdown li a').on('click', function(e) {
            e.preventDefault();
            let selected_year = $(this).data('value');
            console.log("selected",selected_year);

            let ajaxUrl = '<?php echo admin_url( 'admin-ajax.php' );?>';
            $.ajax({
                type:"POST",
                url: ajaxUrl,
                data: {
                    action: "display_year_issues",
                    selected_year: selected_year
                },
                success:function(data){
                    removeOldData();
                    console.log(data);
                    jQuery("#issue-box").html(data);
                },
                error: function(errorThrown){
                    alert(errorThrown);
                }
            });

        });

        $('#year-dropdown a').click(function(){
            $('#year-drop-down-menu').text($(this).text());
        });


    });
    
    function removeOldData() {
        jQuery(".issue").remove();
    }



</script>

<?php
function populateDropdown() {
    $currentYear = date("Y");
    $lastyear    =   $currentYear-1;

    $dropDownHtml = '<li><a href="#" data-value="'.$currentYear.'" id="current-year">Current Year</a></li>';
    $dropDownHtml .= '<li><a href="#" data-value="'.$lastyear.'" id="current-year">Last Year</a></li>';
    $dropDownHtml .= '<li role="separator" class="divider"></li>';

    $year = $currentYear;
    while ($year>$currentYear-10){
        $dropDownHtml .= '<li><a href="#" data-value="'.$year.'">'.$year.'</a></li>';
        $year--;
    }

    echo $dropDownHtml;
}

?>