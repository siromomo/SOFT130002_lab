<?php

    function outputOrderRow($file, $title, $quantity, $price) {
        $amount = $quantity * $price;
        $price = sprintf("%.2f",$price);
        $amount = sprintf("%.2f",$amount);
        echo "<tr>";
        echo "<td><img src=\"images/books/tinysquare/$file\"></td>
                      <td class=\"mdl-data-table__cell--non-numeric\">$title</td>
                      <td>$quantity</td>
                      <td>$$price</td>
                      <td>$$amount</td>";
        echo "</tr>";
    }
?>