<?php
//logic to check whether the user is logged in or not to give him access of this page
if(!isset($_SESSION['user_email'])  && !isset($_SESSION['username']))
{
    echo "<script>window.open('user_login.php','_self')</script>";
}

?>

<?php
    $user_email = $_SESSION['user_email'];
    $user_query = "select * from `user_table` where user_email='$user_email'";
    $user_query_result = mysqli_query($con, $user_query);
    $user_data = mysqli_fetch_assoc($user_query_result);
    $user_id = $user_data['user_id'];

?>
<h3 class="text-center text-success">My orders</h1>
    <table class="table table-bordered  text-center ">
        <thead >
            <tr class="table-primary">
                <th>Sl.no</th>
                <th>Order number</th>
                <th>Amount Due</th>
                <th>Total products</th>
                <th>Invoice Number</th>
                <th>Date</th>
                <th>Complete/Incomplete</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody class="table-secondary ">
            <?php
            $number=1;
            $order_details="select * from `user_orders` where user_id=$user_id";
            $order_details_result=mysqli_query($con,$order_details);
            while($row=mysqli_fetch_assoc($order_details_result))
            {
                $order_id=$row['order_id'];
                $amount_due=$row['amount_due'];
                $total_products=$row['total_products'];
                $invoice_number=$row['invoice_number'];
                $date=$row['order_date'];
                $status=$row['order_status'];
                if($status=='pending')
                {
                    $status='Incomplete';
                }
                else{
                    $status='Complete';
                }
                echo "<tr>
                <td>$number</td>
                <td>$order_id</td>
                <td>$amount_due</td>
                <td>$total_products</td>
                <td>$invoice_number</td>
                <td>$date</td>
                <td>$status</td>";
                if($status=='Complete')
                {
                    echo "<td>Paid</td>";
                }
                else{
                    echo "<td><a href='confirm_payment.php?order_id=$order_id'>Confirm</a></td>

                    </tr>";
                }
            $number++;
            }
            
            ?>
        </tbody>
    </table>