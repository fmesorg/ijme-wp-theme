<?php get_header(); ?>

<div class="row">
    <div class="col-md-9">
        <div id="main" class="last-2">
            <div id="content">
                <h4>Archives</h4>
                
                <div class="table-responsive">
                    
                    <h2>Indian Journal of Medical Ethics (New Series 2016 - onwards)</h2>
                    <?php year_archive_table(array(2016,'','','')); ?>
                    
                    <h2>Indian Journal of Medical Ethics (2004 - present)</h2>
                    <?php year_archive_table(array(2015, 2014, 2013, 2012)); ?>
                    <?php year_archive_table(array(2011, 2010, 2009, 2008)); ?>
                    <?php year_archive_table(array(2007, 2006, 2005, 2004)); ?>
                    
                    <h2>Issues in Medical Ethics (1996 - 2003)</h2>
                    <?php year_archive_table(array(2003, 2002, 2001, 2000)); ?>
                    <?php year_archive_table(array(1998, 1997, 1996)); ?>
                    
                    <h2>Medical Ethics: Journal of Forum for Medical Ethics Society (1993 - 1995)</h2>
                    <?php year_archive_table(array(1995, 1994, 1993)); ?>
                    
                </div>
                
            </div>
        </div>
    </div>
    <div class="clearfix visible-xs visible-sm"></div>
	<div class="col-md-3">
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>