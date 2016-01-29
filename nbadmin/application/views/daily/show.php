                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="daily" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											 <th>Dealer Name</th>
											 <th>Package</th>
											 <th>Amount</th>
											 <th>Edit</th>
											 <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									 <?php
									 $i=0;
									 foreach ($query as $row){
									 $i++;
									 echo "<tr class=\"record\">";
									 echo    "<td>$i</td>";
									 echo    "<td>$row->dealername</td>";
									 echo    "<td>$row->listname</td>";
									 echo    "<td>$row->price</td>";
									 echo    "<td><a href=\"#\" class=\"edit\" id=\"$row->id\" date=\"$row->dealername\" name=\"$row->listname\" amount=\"$row->price\">Edit</a></td>";
									 echo    "<td><a class=\"delbutton\" id=\"$row->id\" href=\"#\" >Delete</a></td>";
									 echo  "</tr>";
									 }
									 ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
