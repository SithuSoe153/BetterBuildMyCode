<DIV class="product-item float-clear" style="clear:both;">
    <DIV class="float-left"><input type="checkbox" name="item_index[]" />
        <!-- </DIV> -->
        <!-- <DIV class="float-left"> -->

        <?php

        $conn = mysqli_connect("localhost", "root", "", "posdb");
        $select = "SELECT * FROM raw";
        $query = mysqli_query($conn, $select);
        $count = mysqli_num_rows($query);

        echo "<select name='item_name[]'>";
        for ($i = 0; $i < $count; $i++) {
            $data = mysqli_fetch_array($query);
            $rawtype = $data['rawtype'];
            $rawid = $data['rawid'];
            echo "<option value='$rawid'>$rawtype</option>";
        }
        echo "</select>";


        ?>

        <!-- </DIV> -->
        <!-- <DIV class="float-left"> -->
        <input type="text" name="item_quantity[]" />
    </DIV>
    <br>
</DIV>