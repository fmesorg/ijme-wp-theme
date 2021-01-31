<?php get_header(); ?>
<div class="issue-archive-container">
    <div id="issue-archive-header">
        <div id="issue-archive-title">Archives</div>
        <div id="issue-archive-description">
            Access all issues of the <i>Indian Journal of Medical Ethics</i> from 1993 onwards.
        </div>
    </div>

    <div id="issue-archive-search">
<!--        Removed Search Box on FMES Team request-->
        <div id="search-box">
            <input id="issue-text-field" type="text" class="input-group-text tag-search-input"
                   placeholder="Search a Volume..." hidden>
<!--            <button class="button tag-search-button" onclick="searchIssueByName()">Search</button>-->
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
    <div style="display: flex; justify-content: center">
        <div class="loader" id="loader"></div>
    </div>
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

    function searchIssueByName() {
      let name = document.getElementById("issue-text-field").value;
      if (name !== '') {
        showLoader();
        resetSelectedFilter();
        removeOldData();
        let ajaxUrl = '<?php echo admin_url('admin-ajax.php');?>';
        jQuery(function ($) {
          $.ajax({
            type: "POST",
            url: ajaxUrl,
            data: {
              action: "search_issue_by_name",
              issueName: name
            },
            success: function (data) {
              hideLoader();
              jQuery("#issue-archive-content-container").html(data);
            },
            error: function (errorThrown) {
              alert(errorThrown);
            }
          });
        });
      }
    }

    function getData($years) {
      clearTextField();
      showLoader();
      removeOldData();
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
            hideLoader();
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
      if(document.getElementsByClassName('tag-item tag-selected').length !==0){
        document.getElementsByClassName('tag-item tag-selected')[0].classList.remove('tag-selected');
      }
      document.getElementById($id).classList.add('tag-selected');
    }

    function resetSelectedFilter() {
      if(document.getElementsByClassName('tag-item tag-selected').length !==0){
        document.getElementsByClassName('tag-item tag-selected')[0].classList.remove('tag-selected');
      }
    }

    function clearTextField() {
      document.getElementById('issue-text-field').value='';
    }

    function removeOldData() {
      jQuery(".issue-archive-year").remove();
    }

    function showLoader() {
        document.getElementById("loader").style.display = "block";
    }

    function hideLoader() {
        document.getElementById("loader").style.display = "none";
    }
</script>
