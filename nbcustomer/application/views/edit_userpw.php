        <div id="page-wrapper">
		<br />
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        	<div class="caption" style="margin-bottom:20px;">
								<i class="fa fa-lock"></i> Change Password</div>
                            <div class="dataTable_wrapper">
			<?php if(empty($post)){?>
						<p><code><b>Something wrong: </b>Verify User ID And Pass <b>... :( </code></p>
			<?php } else {
					if(!empty($success)) {
						echo $success;
					}
      $attributes = array('role' => 'form');
      echo form_open('billpanel/PWChange', $attributes);?>
										<input type="hidden" name="Author" value="<?=$this->session->userdata('username');?>" />
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><span class="fa fa-link"></span></span>
                                            <input type="password" name="curpassword" value="" class="form-control" placeholder="Current Password" autocomplete="off">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><span class="fa fa-key"></span></span>
                                            <input type="password" name="password" value="" class="form-control" placeholder="New Password" autocomplete="off">
                                        </div>

                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><span class="fa fa-key"></span></span>
                                            <input type="password" name="repassword" value="" class="form-control" placeholder="Retype Password" autocomplete="off">
                                        </div>

                                        <button type="submit" class="btn btn-default">Change</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </form>
			<?php } ?>
                            </div>
                            <!-- /.table-responsive -->
							
							<br />
                            <div class="well">
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
