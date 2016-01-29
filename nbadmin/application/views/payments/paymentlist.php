                            <div class="table-responsive">
								 <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Dealer Name</th>
                                            <th>Total Amount</th>
                                            <th>Receipt</th>
                                            <th>Total Paid</th>
                                            <th>Discount</th>
                                            <th>Balance</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php if(!isset($posts)){?>
												<p><code>#wrap</code> with <code>padding-top: 60px;</code> on the <code>.container</code></p>
										<?php } else { 
											foreach($posts as $row){?>
												<tr class="odd gradeX">
													<td><a href="<?php echo base_url(); ?>payments/index/?Dlr=<?php echo $row['customer']; ?>"><?php echo $row['customer']; ?></a></td>
													<td><?php echo $row['Amount']; ?></td>
													<td><?php echo $row['Receipt']; ?></td>
													<td><?php echo $row['paid']; ?></td>
													<td><?php echo $row['Discount']; ?></td>
													<td><?php echo $row['Balance']; ?></td>
													<td><?php echo $row['payment_date']; ?></td>
										<?php if($this->session->userdata('user_type')=="user"){ ?>
													<td><center><a href="<?php echo base_url(); ?>payments/pview/<?php echo $row['id']; ?>"><i class="glyphicon glyphicon-search"></i></a></center></td>
										<?php } else {?>
													<td><center><a href="<?php echo base_url(); ?>payments/pedit/<?php echo $row['id']; ?>"><i class="glyphicon glyphicon-pencil"></i></a> | <a href="<?php echo base_url(); ?>payments/pview/<?php echo $row['id']; ?>"><i class="glyphicon glyphicon-search"></i></a> | <a href="<?php echo base_url(); ?>payments/payments_print/<?php echo $row['id']; ?>"><i class="glyphicon glyphicon-print"></i></a></center></td>
										<?php }?>
												</tr>
										<?php }
										}?>
                                    </tbody>
                                </table>
                            </div>
					<?php echo $page_link; ?>