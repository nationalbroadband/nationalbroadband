<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
                            <div class="table-responsive">
								 <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>User ID</th>
                                            <th>Reg Date</th>
                                            <th>Package</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php if(empty($posts)){?>
												<tr class="odd gradeX">
													<td><code> - No -</code></td>
													<td><code> - Data -</code></td>
													<td><code> - Found -</code></td>
													<td><code> - - -</code></td>
													<td><code> - Try -</code></td>
													<td><code> - Again -</code></td>
													<td><code> - - -</code></td>
												</tr>
										<?php } else { 
											foreach($posts as $row){?>
												<tr class="odd gradeX">
													<td><?php echo $row['FullName']; ?></td>
													<td><a href="<?php echo base_url(); ?>clients/client/<?php echo $row['Username']; ?>"><?php echo $row['Username']; ?></a></td>
													<td><?php echo $row['CDate']; ?></td>
													<td><?php echo $row['Package']; ?></td>
													<td><?php echo $row['UsrAdd']; ?></td>
													<td><?php 
															if ($row['Active']==1){
																echo "Active";
															} else if($row['Active']==0){
																echo "<code>DeActive</code>";
															} else {
																echo "User is Blocked By Managment";
														} ?></td>
													<td><center><a href="<?php echo base_url(); ?>clients/client/<?php echo $row['Username']; ?>"><i class="fa fa-search"></i></a> | <a href="<?php echo base_url(); ?>clients/clientedit/<?php echo $row['Username']; ?>"><i class="fa fa-pencil"></i></a></center></td>
												</tr>
										<?php }
										}?>
                                    </tbody>
                                </table>
								Total Users: 
						<?php echo $TotalUsers; ?>
                            </div>
					<?php echo $page_link; ?>