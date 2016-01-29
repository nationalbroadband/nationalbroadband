<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
                            <div class="table-responsive">
								 <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Dealer</th>
                                            <th>Package</th>
                                            <th>Units</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>    
                                    <tbody>
										<?php if(empty($posts)){?>
												<p> <code>#wrap</code> with <code>padding-top: 60px;</code> on the <code>.container</code></p>
										<?php } else { 
											foreach($posts as $row){
											if (!empty($DateStart)) {
													$date = $DateStart ." TO ". $DateEnd;
												} else {
													$date = $row['order_date'];
												}
											?>
												<tr class="odd gradeX">
													<td><a href="<?php echo base_url(); ?>clients/client/<?php echo $row['user_id']; ?>"><?php echo $row['user_id']; ?></a></td>
													<td><a href="<?php echo base_url(); ?>dealers/dealer/<?php echo $row['customer_id']; ?>"><?php echo $row['customer_id']; ?></a></td>
													<td><?php echo $row['product_id']; ?></td>
													<td><?php echo $row['quantity']; ?></td>
													<td><?php echo $date; ?></td>
													<td><center><a href="<?php echo base_url(); ?>clients/client/<?php echo $row['customer_id']; ?>"><i class="fa fa-search"></i></a> | <a href="<?php echo base_url(); ?>clients/clientedit/<?php echo $row['id']; ?>"><i class="fa fa-pencil"></i></a></center></td>
												</tr>
										<?php }
										}?>
                                    </tbody>
                                </table>
                            </div>
					<?php echo $page_link; ?>