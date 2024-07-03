<?php
  require '../../config.php';
  if (isset($_POST["del_cate"])) {
    $cateId = $_POST["req1"];
    $result = mysqli_query($conn, "SELECT cate_status FROM category WHERE cate_id='$cateId'");
    $row = mysqli_fetch_assoc($result);
    $_SESSION['cateDeleteType'] = $row["cate_status"];

    $query = "DELETE FROM category WHERE cate_id='$cateId'";
    mysqli_query($conn,$query);

    if (($_SESSION['cateDeleteType']) == 'Visible') {
      echo "<script>
      let url = 'http://localhost/files/CanteenFCT/admin/category/adCategory.php#';
      url += 'Visible';
      window.location= url;
    </script>";
    } else {
      echo "<script>
      let url = 'http://localhost/files/CanteenFCT/admin/category/adCategory.php#';
      url += 'Hidden';
      window.location= url;
      </script>";
    }
  }