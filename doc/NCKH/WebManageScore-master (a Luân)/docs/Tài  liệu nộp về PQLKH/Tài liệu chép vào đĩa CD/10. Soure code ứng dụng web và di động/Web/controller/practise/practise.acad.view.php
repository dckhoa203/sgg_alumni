<?php
/**
 * Created by PhpStorm.
 * User: TanPhat
 * Date: 16/10/2017
 * Time: 3:20 PM
 */

if (!defined("IN_PT_MAN"))
    die("Bad request!!!");

if (!getInfo("permission") == "Quản lý khoa")
    redirect("main.php");

if (isSubmit("acadViewScore")) {
    $studentId = getPOSTValue("stdId");
    $md = new AccountMod();
    $student = $md->getAccount($studentId);
    if (empty($student->getAccountName()))
        redirect("practise.manage.php");
    echo
    "<h4 class='text-center text-primary'>
            Xem danh sách điểm rèn luyện của:
            <strong><i>{$student->getAccountName()}</i></strong>
        </h4>";
    require_once '../controller/practise/practise.detail.view.php';
    return;
}

$acaMod = new AcademyMod();
$acaAdminId = $acaMod->getAcademyIdOfAccount(getLoggedAccountId());
$listStudent = $acaMod->getListStudentInAcademy($acaAdminId);
?>
<div class="container">
    <h4 class="text-center text-primary">Danh sách sinh viên của khoa</h4>
    <div class="table-view">
        <table id="table-view-student-scores-by-acad" class="table table-condensed table-bordered table-striped">
            <thead>
            <tr>
                <th>STT</th>
                <th>MSSV</th>
                <th>Họ tên</th>
                <th>Chấm điểm</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($listStudent as $order => $student) { ?>
                <tr>
                    <td><?php echo $order + 1; ?></td>
                    <td><?php echo $student->getIdAccount(); ?></td>
                    <td><?php echo $student->getAccountName(); ?></td>
                    <td>
                        <form method="post" style="margin: 0; padding: 0;">
                            <input type="hidden" name="stdId" value="<?php echo $student->getIdAccount(); ?>">
                            <input type="hidden" name="requestName" value="acadViewScore">
                            <button class="btn btn-primary btn-sm">
                                <span class="glyphicon glyphicon-list"></span>
                                Xem
                            </button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $('#table-view-student-scores-by-acad').dataTable();
</script>