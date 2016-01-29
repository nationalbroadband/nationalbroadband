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
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php if(!isset($posts)){?>
												<p><?php echo $row['Description']; ?> <code>#wrap</code> with <code>padding-top: 60px;</code> on the <code>.container</code></p>
										<?php } else { 
											foreach($posts as $row){?>
												<tr class="odd gradeX">
													<td><?php echo $row['FullName']; ?></td>
													<td><a href="clients.php?user=<?php echo $row['Username']; ?>"><?php echo $row['Username']; ?></a></td>
													<td><?php echo $row['CDate']; ?></td>
													<td><?php echo $row['Package']; ?></td>
													<td><?php echo $row['UsrAdd']; ?></td>
													<td><?php if ($row['Active']==1){
															 echo "Active";
															} else if($row['Active']==0){
																echo "Not Active";
															} else {
															 echo "User is Blocked By Managment";
															} ?></td>
													<td class="center"><a href="<?php echo base_url(); ?>clients/edituser/<?php echo $row['ID']; ?>">Edit</a></td>
													<td class="center"><a href="<?php echo base_url(); ?>clients/client/<?php echo $row['ID']; ?>">read more &raquo;</a></td>
												</tr>
										<?php }
										}?>
                                    </tbody>
                                </table>
                            </div>
					<?php echo $page_link; ?>