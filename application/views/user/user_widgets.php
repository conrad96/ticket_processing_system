<div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
        <div class="inner">
            <h3><?php echo $this->_tickets->count_tickets(); ?></h3>

            <p>Logged tickets</p>
        </div>
        <div class="icon">
            <i class="fa fa-files-o"></i>
        </div>
        <a href="<?php echo base_url(); ?>index.php/user/index" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
        </a>
        </div>
</div>
<div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
        <div class="inner">
            <h3><?php echo $this->_tickets->count_tickets('open'); ?></h3>

            <p>Open tickets</p>
        </div>
        <div class="icon">
            <i class="fa fa-files-o"></i>
        </div>
        <a href="<?php echo base_url(); ?>index.php/user/index" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
        </a>
        </div>
</div>
<div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
        <div class="inner">
            <h3><?php echo $this->_tickets->count_tickets('closed'); ?></h3>

            <p>Closed tickets</p>
        </div>
        <div class="icon">
            <i class="fa fa-files-o"></i>
        </div>
        <a href="<?php echo base_url(); ?>index.php/user/index" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
        </a>
        </div>
</div>