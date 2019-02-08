<div class="wptest_box">
	<div class="meta-options wptest_field">
		<label for="wptest_start_date">Start Date</label>
		<input 
			id="wptest_start_date"
			type="date"
			name="wptest_start_date"
			value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'wptest_start_date', true ) ); ?>"
		>
	</div>
	<div class="meta-options wptest_field">
		<label for="wptest_due_date">Due Date</label>
		<input 
			id="wptest_due_date"
			type="date"
			name="wptest_due_date"
			value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'wptest_due_date', true ) ); ?>"
		>
	</div>
	<div class="meta-options wptest_field">
		<label for="wptest_priority">Priority</label>
		<select 
			id="wptest_priority"	  	
			name="wptest_priority"
		>
			<option value="high" <?php selected( get_post_meta( get_the_ID(), 'wptest_priority', true ), 'high' ); ?>>
				High
			</option>
			<option value="low" <?php selected( get_post_meta( get_the_ID(), 'wptest_priority', true ), 'low' ); ?>>
				Low
			</option>
			<option value="normal" <?php selected( get_post_meta( get_the_ID(), 'wptest_priority', true ), 'normal' ); ?>>
				Normal
			</option>      
		</select>
	</div>
</div>