<?php
include('../config.php');
include(ROOT_PATH . '/member/middleware.php');

$export_excel = ReportExcel($_SESSION['report_posit_id'], $_SESSION['report_select_m']);

if (isset($_POST['ExportType'])) {
    if ($_POST['ExportType'] == 'export-to-excel') {
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=exportOT.xls");
    }
}


?>


                    

                                <table border="1" class="table table-bordered">
                                    <thead>
                                        <tr class="info">
                                            <th>ชื่อ-สกุล</th>
                                            <th>วอร์ด</th>
                                            <th>ตำแหน่ง</th>
                                            <?php
                                            for ($x = 1; $x <= 31; $x++) {
                                                echo "<th>$x</th>";
                                            }
                                            ?>
                                            <th>OT</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        foreach ($export_excel as $key => $value) :
                                        ?>
                                            <tr>
                                                <td><?php echo $value['lname']; ?></td>
                                                <td><?php echo $value['ward_name']; ?></td>
                                                <td><?php echo $value['position_name']; ?></td>
                                                <?php
                                                for ($x = 1; $x <= 31; $x++) {
                                                    echo "<td>" . $value["d" . $x] . "</td>";
                                                }
                                                ?>
                                                <td><?php echo $value['total_ot']; ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            