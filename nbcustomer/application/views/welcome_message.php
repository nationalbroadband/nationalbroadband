       <div id="page-wrapper">
		<br />
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        	<div class="caption" style="margin-bottom:20px;">
								<i class="fa fa-lock"></i> Change Password</div>
                            <div class="dataTable_wrapper"><br>
			<div class="portlet-body form">
	  						<div class="form-body">
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><span class="fa fa-user"></span></span>
														<input type="text" name="name" value="<?php echo $post['FullName'];?>" class="form-control" style="background-color: white;" placeholder="Dealer Name" disabled>
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon" style="color:#e56d13">CNIC</span>
														<input type="text" name="DlrCNIC" value="<?php echo $post['CNIC']; ?>" class="form-control" style="background-color: white;" placeholder="CNIC #" disabled>
													</div>
											  </div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><span class="fa fa-user"></span></span>
														<input type="text" name="username" value="<?php echo $post['Username']; ?>" class="form-control" style="background-color: white;" placeholder="Dealer ID" disabled>
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-user"  ></i></span>
														<input type="text" name="ShortID" value="<?php echo $post['Mobile']; ?>" class="form-control" style="background-color: white;" placeholder="Dealer Short ID" disabled>
													</div>
											  </div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><span class="fa fa-mobile"></span></span>
														<input type="text" name="phone" value="<?php echo $post['Mobile']; ?>" class="form-control" style="background-color: white;" placeholder="Phone #" disabled>
													</div>
											  </div>
											  <div class="col-xs-6">
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-phone"  ></i></span>
														<input type="text" name="mobile" value="<?php echo $post['Phone']; ?>" class="form-control" style="background-color: white;" placeholder="Mobile #" disabled>
													</div>
											  </div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-6">
												<div class="input-group">
													<span class="input-group-addon" style="color:#e56d13">Email</span>
													<input type="text" name="email" value="<?php echo $post['Email']; ?>" class="form-control" placeholder="Email" style="background-color: white;" disabled>
												</div>
											  </div>
											  <div class="col-xs-6">
											  <div class="input-group">
											  <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
											<input type="text" name="status" class="form-control"style="background-color: white; color:<?php if($post['Active']==1) print'green';else print'red'?>" value="<?php if ($post['UStatus']==3){
														if ($post['Active']==1){
															echo "Active";
														} else if($post['Active']==0){
															echo "Expired";
														} else {
															echo "Blocked By Management";
														} 
													} else {
														if ($post['Active']==1){
															echo "Active";
														} else if($post['Active']==0){
															echo "Expired";
														} else {
															echo "Blocked By Management";
														} 
													} ?>" disabled>
													</div>
											  </div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											  <div class="col-xs-12">
													<label style="color:#e56d13">Address</label>
											<textarea type="text" name="DAddress" class="form-control" rows="3" style="background-color: white;" disabled><?php echo $post['UsrAdd']; ?></textarea >
											  </div>
											  </div>
											</div>
										</div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
        <!-- /#page-wrapper -->
