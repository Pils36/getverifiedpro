

<?php

include 'db/conf.php';

?>

<div class="container col-md-8 mt-5 animated fadeIn">
    <table class="table table-responsive table-striped">
        <thead class="bg-dark text-white">
            <tr>
                <th scope="col">S/N</th>
                <th scope="col">Full Name</th>
                <th scope="col">Email Address</th>
                <th scope="col">Date Added</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

        <tbody>
<?php
$stmt = "SELECT * FROM `registration`";

    $result = mysqli_query($conn, $stmt);

    $fetch = mysqli_num_rows($result);

    $fetchAll = mysqli_fetch_all($result);

    $i = 1;
    foreach($fetchAll as $key => $member):
        $j = $i++;
        $fullname = $member[1];
        $email = $member[2];
        $date_added = date("d-M-Y", strtotime($member[4]));

?>

            <tr style="font-size: 14px">
                <th scope="row"><?php echo $j;?></th>
                <td><?php echo $fullname;?></td>
                <td><?php echo $email;?></td>
                <td><?php echo $date_added;?></td>
                <td><a href="#">view</a></td>
            </tr>
       
   <?php endforeach?>
 </tbody>
    </table>
</div>

