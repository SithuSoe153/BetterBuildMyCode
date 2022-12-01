<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('connect.php');
include('sheader.php');


?>


<form action="indexstaff.php" method="post" style="margin-top: 168px;">

    <div class="panelhead">
        <h2>Notification panel</h2>
    </div>

    <div class="OR">
        <h3>Order Report</h3>
        <div>
            <table>
                <tr>
                    <th>Order ID </th>
                    <th> Order Date </th>
                </tr>

                <tr>
                    <td> OR - 001 </td>
                    <td> 2022 - 1 - 30 </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="PR"> >
        <h3>Purchase Report</h3>
        <div>
            <table>
                <tr>
                    <th>Purchase ID </th>
                    <th> Purchase Date </th>
                </tr>

                <tr>
                    <td> PUR - 001 </td>
                    <td> 2022 - 1 - 30 </td>
                </tr>
            </table>
        </div>

    </div>

</form>

<?php
include('footer.php');
