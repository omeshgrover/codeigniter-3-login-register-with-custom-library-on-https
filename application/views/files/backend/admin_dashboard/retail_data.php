<div class="col-xs-12">
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#retail_data">Retail Data</a></li>
    <li><a data-toggle="tab" href="#turnover">Turnover</a></li>
    <li><a data-toggle="tab" href="#budget_works">Budget and works of art</a></li>
    <li><a data-toggle="tab" href="#retail_personnel">Retail Personnel</a></li>
</ul>

<div class="tab-content">
    <div id="retail_data" class="tab-pane fade in active">
        
    </div>
    <div id="turnover" class="tab-pane fade">
        <div class="sub-tab">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#registration">Registration</a></li>
                <li><a data-toggle="tab" href="#history">History</a></li>
            </ul>

            <div class="tab-content">
                <div id="registration" class="tab-pane fade in active">
                <div class="table-responsive">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Mobile</th>
                        <th>Store Number</th>
                        <th>Image</th>
                        <th>Date created</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach($records as $key => $val) {?>
                            <tr>
                                <td><?=$val['username']?></td>
                                <td><?=$val['email']?></td>
                                <td><?=$val['first_name']?></td>
                                <td><?=$val['last_name']?></td>
                                <td><?=$val['mobile']?></td>
                                <td><?=$val['store_num']?></td>
                                <td><?=$val['image']?></td>
                                <td><?=$val['date_created']?></td>
                                <td>
                                    <a href="#"><i class="fa fa-edit"></i></a>
                                    <a href="#"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
                </div>
                <div id="history" class="tab-pane fade">
                    
                </div>
            </div>
        </div>
    </div>
    <div id="budget_works" class="tab-pane fade">
        
    </div>
    <div id="retail_personnel" class="tab-pane fade">
        
    </div>
</div>
</div>