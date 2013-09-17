<div id="content">
	<?php echo form_open('harian/outgoing_result'); ?>
    <h2>Laporan Penjualan Kas Harian Outgoing</h2>
     <div class="container-fluid">
		<div class="row-fluid">
        	<div class="block span2">
            		<form class="form-inline">
					  <div class="control-group">
						<div class="controls">
						<select name="airline">
							<option value="none">select airline</option>
							<?php foreach ( $airline as $item ) : ?>
								<option value="<?php echo $item->airlinecode;?>"><?php echo ucfirst( $item->airlinename ) ?></option>
							<?php endforeach ?> 
						</select>
						&nbsp;&nbsp;
						<input type="text"  id="datepicker_start" placeholder="select date" name="startdate" value="<?php echo mdate('%d-%m-%Y', time()); ?>"> s/d 
						<input type="text"  id="datepicker_end" placeholder="select date" name="enddate" value="<?php echo mdate('%d-%m-%Y', time()); ?>">
						&nbsp;&nbsp;	
						<button type="submit" class="btn btn-primary">Print</button>
						</div>
					  </div>
					</form>
				
			</div>
		</div>
	</div>	
	<?php echo form_close(); ?>
	
	<?php /* ?>
	
	<h2>Laporan Penjualan Kas Harian Outgoing</h2>
      <table>
		
        <tr>
        	<td>Date</td><td><input type="text" name="date" id="datepicker" placeholder="select date"></td>
        </tr>
        
        <tr>
        	<td>Airline</td><td><select name="airline">
						<option value="none">select airline</option>
						<?php foreach ( $airline as $item ) : ?>
							<option value="<?php echo $item->airlinecode	 ?>"><?php echo ucfirst( $item->airlinename ) ?></option>
						<?php endforeach ?>
                    </select></td>
        </tr>
        
        <tr>
        	<td>&nbsp;</td>
            <td><input type='submit' value='Print' class="btn btn-primary"></td>
        </tr>
		
      </table>
      <?php echo form_close(); */ ?>
</div>

