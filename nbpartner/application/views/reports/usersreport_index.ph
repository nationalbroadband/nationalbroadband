<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script>
function validateForm() {
    var x = document.forms["userreport"]["username"].value;
    if (x==null || x=="") {
        alert("UserID must be filled out");
        return false;
    }
}
</script>
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
					<form name="userreport" action="<?php echo base_url()?>reports/usersreport" onsubmit="return validateForm()" method="post">
					<?php 
						$dayf=date('Y-m-01', strtotime('+1 day'));
						$dayt=date("Y-m-d", strtotime('+1 day'));
					?>
						<div class="row">
							<div class="col-xs-3">
								<div class="input-group">
									<span class="input-group-addon">User</span>
									<input type="text" name="username" value="" class="form-control" placeholder="User ID">
								</div>
							</div>
							<div class="input-append">
							<div class="col-xs-3">
								<div class="input-group">
								<span class="input-group-addon">Start</span>
									<input type="text" name="DateStart" value="<?php echo $dayf; ?>" class="form-control usrusage" placeholder="select date from">
								</div>
							</div>
							<div class="col-xs-3">
								<div class="input-group">
								<span class="input-group-addon">END</span>
									<input type="text" name="DateEnd" value="<?php echo $dayt; ?>" class="form-control usrusage" placeholder="select date to">
<?php if(!$this->session->userdata('DealerPerm')){?>
									<span class="input-group-btn">
									<button class="btn btn-default" type="submit">Go</button>
									</span>
<?php } ?>
								</div>
							</div>
							</div>
<?php if($this->session->userdata('DealerPerm')){?>
							<div class="col-xs-3">
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
                            Dealers Montly Units Report
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
								<div id="postlist">
									<?php
									$data['posts'] = $posts;
									$data['page_link'] = $page_link;
									$this->load->view('reports/usersreportlist', $data);
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