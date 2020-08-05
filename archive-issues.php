<?php get_header(); ?>
<div class="issue-archive-container">
    <div id="issue-archive-header">
        <div id="issue-archive-title">Archives</div>
        <div id="issue-archive-description">
            [Text to Replace]
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In nulla augue, volutpat eu ornare sed,
            fermentum eu neque. Suspendisse pellentesque ac est in sodales. Cras odio lectus, dictum eleifend
            fermentum ut, malesuada at nibh. Proin nisl velit, tempus volutpat sem placerat, mattis suscipit quam.
            Cras fermentum luctus dolor, nec tincidunt orci gravida vel. Vivamus volutpat aliquet orci sit amet
            lacinia. Fusce in cursus odio. Proin ut ultrices neque. Phasellus efficitur neque nunc, a sodales nisl
            scelerisque at. Sed vel velit vitae sem venenatis tempor vel eget orci.
        </div>
    </div>

    <div id="issue-archive-search">
        <div id="search-box">
            <input type="text" class="input-group-text tag-search-input" placeholder="Search a Volume...">
            <button class="button tag-search-button">Search</button>
        </div>
        <div id="issue-search-tags">
            <ul id="tag-list">
                <li class="tag-item tag-selected" id="ALL" onclick="getDataForCategory('ALL')">All Years</li>
                <li class="tag-item" id="CAT1" onclick="getDataForCategory('CAT1')">IJME - New Series (2016 Onwards)</li>
                <li class="tag-item" id="CAT2" onclick="getDataForCategory('CAT2')">IJME - Old Series (2004 - 2015)</li>
                <li class="tag-item" id="CAT3" onclick="getDataForCategory('CAT3')">Issues in Medical Ethics (1996-2003)</li>
                <li class="tag-item" id="CAT4" onclick="getDataForCategory('CAT4')">Medical Ethics (1993-1995)</li>
            </ul>
        </div>
    </div>
    <div class="loader" id="loader"></div>
    <div id="issue-archive-content-container">
        <!--content from ajax-->
    </div>

<?php get_footer(); ?>


<script type="text/javascript">
    jQuery(function($) {
        $(document).ready(function(){
          getData();
        });
    });


    function getData($years) {
      let ajaxUrl = '<?php echo admin_url('admin-ajax.php');?>';
      jQuery(function ($) {
        $.ajax({
          type: "POST",
          url: ajaxUrl,
          data: {
            action: "display_year_issues",
            selected_year: $years
          },
          success: function (data) {
            // hideLoader();
            // removeOldData();
            jQuery("#issue-archive-content-container").html(data);
          },
          error: function (errorThrown) {
            alert(errorThrown);
          }
        });
      });
    }

    function getDataForCategory(category) {
      let yearArray = [];
      setSelected(category);
      switch (category) {
        case 'CAT1':
          let currentYear = new Date().getFullYear();
          for (let i = 2006; i <= currentYear; i++) {
            yearArray.push(i);
          }
          getData(yearArray);
          break;
        case 'CAT2':
          for (let i = 2004; i <= 2015; i++) {
            yearArray.push(i);
          }
          getData(yearArray);
          break;
        case 'CAT3':
          for (let i = 1996; i <= 2003; i++) {
            yearArray.push(i);
          }
          getData(yearArray);
          break;
        case 'CAT4':
          for (let i = 1993; i <= 1995; i++) {
            yearArray.push(i);
          }
          getData(yearArray);
          break;
        default:
          getData();
          break;
      }
    }
    
    function setSelected($id) {
      document.getElementsByClassName('tag-item tag-selected')[0].classList.remove('tag-selected');
      document.getElementById($id).classList.add('tag-selected');
    }
    function removeSelected($id) {
      document.getElementById($id).className = 'tag-item'
    }

    function removeOldData() {
      // jQuery(".issue").remove();
    }

    function showLoader() {
        document.getElementById("loader").style.display = "block";
    }

    function hideLoader() {
        document.getElementById("loader").style.display = "none";
    }
</script>
