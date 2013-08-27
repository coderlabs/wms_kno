<div id="content">
	<h2>Inbound Stock Opname</h2>
	<?php 	echo form_open('incoming/stock_opname_result');?>
    		<!--<div class="input-group col-lg-3">
            <select class="form-control" name="airline">
            	<option value="ga">GARUDA INDONESIA</option>
                <option value="qg">CITILINK</option>
                <option value="jt">LION AIR</option>
                <option value="sj">SRIWIJAYA</option>
                <option value="ri">MANDALA</option>
                <option value="si">SUSY AIR</option>
            </select>
			</div>-->
            <div class="input-group col-lg-3">
            
            <input type="text" class="form-control" id="datepicker" placeholder="select date" name="date" value="<?php echo mdate('%d-%m-%Y', time()); ?>">
			<span class="input-group-btn">
            <input type="submit" value="search" class="btn btn-primary">
            </span>
            </div>
	<?php	echo form_close();?>
</div>	



