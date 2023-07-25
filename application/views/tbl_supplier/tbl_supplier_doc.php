<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Tbl_supplier List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Supplier</th>
		<th>Alamat Supplier</th>
		<th>No Hp</th>
		<th>Email</th>
		
            </tr><?php
            foreach ($tbl_supplier_data as $tbl_supplier)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $tbl_supplier->nama_supplier ?></td>
		      <td><?php echo $tbl_supplier->alamat_supplier ?></td>
		      <td><?php echo $tbl_supplier->no_hp ?></td>
		      <td><?php echo $tbl_supplier->email ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>