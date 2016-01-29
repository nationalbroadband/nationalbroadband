<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dealers</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
				<center>
				<?php if($this->session->userdata('user_type')=="author"){?>
					<form action ="<?php echo base_url()?>reports/reports_print" method="post" target="_blank">
				<?php } else {?>
					<form action ="<?php echo base_url()?>reports/dreports" method="post">
				<?php }?>
						<div class="row">
							<div class="col-xs-4">
								<div class="input-group">
								<span class="input-group-addon">Start</span>
									<input type="text" name="DateStart" value="" class="form-control" id="example1" placeholder="select date from">
								</div>
							</div>
							<div class="col-xs-4">
								<div class="input-group">
								<span class="input-group-addon">END</span>
									<input type="text" name="DateEnd" value="" class="form-control" id="example2" placeholder="select date to">
<?php if(!$this->session->userdata('DealerPerm')){?>
												<span class="input-group-btn">
												<button class="btn btn-default" type="submit">Go</button>
												</span>
<?php } ?>
											</div>
										</div>
<?php if($this->session->userdata('DealerPerm')){?>
										<div class="col-xs-4">
											<div class="input-group">
											<span class="input-group-addon">Dealer</span>
												<select class="form-control" name="UsrCre" >
												<option value="" selected="selected">All</option>
															<?php $query = $this->db->query("SELECT Dlrname FROM dealer WHERE creator='".$this->session->userdata('username')."'");
																		foreach ($query->result() as $row) {
																			echo "<option value=" . $row->Dlrname . ">" . $row->Dlrname . "</option>";
																	}?>
												</select>
												<span class="input-group-btn">
												<button class="btn btn-default" type="submit">Go</button>
												</span>
											</div>
										</div>
<?php } ?>
									</div>
								</form>
				</center>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Units Consumption by Packages
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
								<div id="postlist">
									<?php
									$data['posts'] = $posts;
									$data['page_link'] = $page_link;
									$this->load->view('reports/reportslist', $data);
									?>
								</div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->