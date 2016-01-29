                            <div class="table-responsive">
								 <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Dealer</th>
                                            <th>UserID</th>
                                            <th>Package</th>
                                            <th>Units</th>
                                            <th>Price P/U</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php if(empty($posts)){?>
												<p> <code>#wrap</code> with <code>padding-top: 60px;</code> on the <code>.container</code></p>
										<?php } else { 
											foreach($posts as $row){?>
												<tr class="odd gradeX">
													<td><a href="<?php echo base_url(); ?>clients/client/<?php echo $row['DUcustomer']; ?>"><?php echo $row['DUcustomer']; ?></a></td>
													<td><?php echo $row['DUserID']; ?></td>
													<td><?php echo $row['DUpakage']; ?></td>
													<td><?php echo $row['DUcount']; ?></td>
													<td><?php echo $row['DUprice']; ?></td>
													<td><?php echo $row['DUAmount']; ?></td>
													<td><?php echo $row['DUdate']; ?></td>
													<td><center><a href="<?php echo base_url(); ?>reports/addnew"><i class="glyphicon glyphicon-save"></i></a> | <a href="<?php echo base_url(); ?>reports/redit/<?php echo $row['DUid']; ?>"><i class="glyphicon glyphicon-pencil"></i></a> | <a href="<?php echo base_url(); ?>reports/rview/<?php echo $row['DUid']; ?>"><i class="glyphicon glyphicon-search"></i></a></center></td>
												</tr>
										<?php }
										}?>
                                    </tbody>
                                </table>
                            </div>
					<?php echo $page_link; ?>