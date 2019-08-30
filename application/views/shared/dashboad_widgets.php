<div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
        <div class="inner">
            <h3><?php echo !empty($widgets['tickets_count'])? count($widgets['widgets_counters']) : 0; ?></h3>

            <p>Logged tickets</p>
        </div>
        <div class="icon">
            <i class="ion ion-pie-graph"></i>
        </div>
        <a href="<?php echo base_url(); ?>index.php/<?php echo $this->session->role; ?>/tickets" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
        </a>
        </div>
</div>