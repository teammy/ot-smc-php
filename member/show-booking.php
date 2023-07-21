<?php
include('../config.php');
include(ROOT_PATH . '/member/middleware.php');

$get_all_booking = BookingCreateSuccess();

?>


<?php foreach ($get_all_booking as $key => $value) : ?>
    <tr>

        <td><?php echo $value['booking_id_random'] . ' ' . $value['user_phone']; ?></td>
        <td><?php echo $value['position_id']; ?></td>
        <td><?php echo $value['ward_id']; ?></td>
        <td class="text-end">
            <a href="<?php echo BASE_URL . 'member/user-profile.php?user_id=' . $value['id']; ?>" class="btn btn-primary"><i class="bi bi-list-ul me-1e"></i> ข้อมูลผู้ใช้</a>

        </td>
    </tr>
<?php endforeach ?>

<a href="../member/booking.php">กลับหน้าแรก</a>