<?php
    /*
     * Template Name: Most Read by Topic
     */
?>

<div id="mostread-byCategory" class="mostread-wrapper">
    <div class="gray-background">
        <div class="mostread-title">Most read by Category</div>
        <div class="mostread-switch-wrapper">
            <img class="category-prev" src="<?php echo THEME_URL; ?>/images/switch/switch_left.svg"
                 alt="slide left">
            <img class="category-next" src="<?php echo THEME_URL; ?>/images/switch/switch_right.svg"
                 alt="slide right">
        </div>
    </div>
    <div id="articlesByCategory" class="category-carousel category-card-wrapper">
            <div class="category-card">
                <div class="category-name">ARTICLES</div>
                <div id="Articles-title" class="category-post-title"></div>
                <div id="Articles-authors" class="category-author-name"></div>
                <div id="Articles-abstract" class="category-abstract"></div>
            </div>
            <div class="category-card">
                <div class="category-name">COMMENTS</div>
                <div id="Comments-title" class="category-post-title"></div>
                <div id="Comments-authors" class="category-author-name"></div>
                <div id="Comments-abstract" class="category-abstract"></div>
            </div>
            <div class="category-card">
                <div class="category-name">COVID-19</div>
                <div id="COVID-19-title" class="category-post-title"></div>
                <div id="COVID-19-authors" class="category-author-name"></div>
                <div id="COVID-19-abstract" class="category-abstract"></div>
            </div>
        <div class="category-card">
            <div class="category-name">Editorials</div>
            <div id="Editorials-title" class="category-post-title"></div>
            <div id="Editorials-authors" class="category-author-name"></div>
            <div id="Editorials-abstract" class="category-abstract"></div>
        </div>
        <div class="category-card">
            <div class="category-name">From the Press</div>
            <div id="From-the-Press-title" class="category-post-title"></div>
            <div id="From-the-Press-authors" class="category-author-name"></div>
            <div id="From-the-Press-abstract" class="category-abstract"></div>
        </div>
        <div class="category-card">
            <div class="category-name">Case Studies</div>
            <div id="Case-Studies-title" class="category-post-title"></div>
            <div id="Case-Studies-authors" class="category-author-name"></div>
            <div id="Case-Studies-abstract" class="category-abstract"></div>
        </div>

    </div>
</div>

<script>
  jQuery(document).ready(function ($) {
    // let data = {"Articles":"Gender perspectives in medical education"}
    // let categoryCards = createCards(data);
    let url = "/ArticleCountAPI/get_latest_articles_by_category.php";
    $.get(url, function (response) {
      let data = JSON.parse(response);
      createCards(data);
    });
  });

  function createCards(data) {
    //This list should match what is in the api get_latest_article_by_category.php used for Google analytics
    let categoryList =
      ["COVID-19",
        "Articles",
        "Comments",
        "Editorials",
        "From the Press",
        "Case Studies"];

    for (let i = 0; i < categoryList.length; i++) {
      let category = categoryList[i];
      createCardFor(data[category], category);
    }
  }

  function createCardFor(categoryPostName, category) {
    // let url = "/wp-json/mostreadArticle/v1/"+categoryPostName;
    // let url = "http://ijme.in/wp-json/mostreadArticle/v1/category/?title="+categoryPostName;
    let url = "/wp-json/mostreadArticle/v1/category/?title=" + categoryPostName;
    jQuery().ready(function ($) {
      $.get(url, function (response) {
        let data = JSON.parse(response);
        console.log("restApi", data);
        renderCard(data, category);
      });
    });

    function renderCard(data, category) {
      let formateCategory = category.replace(' ', '-');
      jQuery().ready(function ($) {
        $("#" + formateCategory + "-title").html(data.title);
        $("#" + formateCategory + "-authors").html(data.authors);
        $("#" + formateCategory + "-abstract").html(data.abstract);
      })
    }

  }

</script>
