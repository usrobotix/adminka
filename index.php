<?php
session_start();
include 'db.php';

$is_logged_in = isset($_SESSION['user_id']); // Проверяем, авторизован ли пользователь

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role_id'] = $user['role_id'];
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Неверное имя пользователя или пароль.";
    }
}?>



   <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
  <?php if ($is_logged_in): ?>
<!DOCTYPE html>
<html lang="zxx">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hospital</title>

    <link rel="icon" href="img/logo.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap1.min.css">
    <!-- themefy CSS -->
    <link rel="stylesheet" href="vendors/themefy_icon/themify-icons.css">
    <!-- swiper slider CSS -->
    <link rel="stylesheet" href="vendors/swiper_slider/css/swiper.min.css">
    <!-- select2 CSS -->
    <link rel="stylesheet" href="vendors/select2/css/select2.min.css">
    <!-- select2 CSS -->
    <link rel="stylesheet" href="vendors/niceselect/css/nice-select.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="vendors/owl_carousel/css/owl.carousel.css">
    <!-- gijgo css -->
    <link rel="stylesheet" href="vendors/gijgo/gijgo.min.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="vendors/font_awesome/css/all.min.css">
    <link rel="stylesheet" href="vendors/tagsinput/tagsinput.css">
    <!-- datatable CSS -->
    <link rel="stylesheet" href="vendors/datatable/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="vendors/datatable/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="vendors/datatable/css/buttons.dataTables.min.css">
    <!-- text editor css -->
    <link rel="stylesheet" href="vendors/text_editor/summernote-bs4.css">
    <!-- morris css -->
    <link rel="stylesheet" href="vendors/morris/morris.css">
    <!-- metarial icon css -->
    <link rel="stylesheet" href="vendors/material_icon/material-icons.css">

    <!-- menu css  -->
    <link rel="stylesheet" href="css/metisMenu.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/colors/default.css" id="colorSkinCSS">
</head>
<body class="crm_body_bg">
    
   <h1>Авторизация</h1>

     
<!-- main content part here -->
 
 <!-- sidebar  -->
 <!-- sidebar part here -->
<nav class="sidebar">
    <div class="logo d-flex justify-content-between">
        <a href="index.html"><img src="img/logo.png" alt=""></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        <li class="side_menu_title">
           <a href="dashboard.php"><img src="img/menu-icon/1.svg" alt=""><span style="padding: 0;">Дашборд</span></a>
          </li>
       
        <li class="side_menu_title">
            <span>Пользователи</span>
          </li>
        <li class="">
          <a class="has-arrow" href="#" aria-expanded="false">
            <img src="img/menu-icon/2.svg" alt="">
            <span>Pages</span>
          </a>
          <ul>
            <li><a href="login.html">Login</a></li>
            <li><a href="resister.html">Register</a></li>
            <li><a href="forgot_pass.html">Forgot Password</a></li>
          </ul>
        </li>

        <li class="">
          <a class="has-arrow" href="#" aria-expanded="false">
            <img src="img/menu-icon/3.svg" alt="">
            <span>Applications</span>
          </a>
          <ul>
            <li><a href="mail_box.html">Mail Box</a></li>
            <li><a href="chat.html">Chat</a></li>
            <li><a href="faq.html">FAQ</a></li>
          </ul>
        </li>
        <li class="side_menu_title">
            <span>Публикации</span>
          </li>
        <li class="">
          <a class="has-arrow" href="#" aria-expanded="false">
            <img src="img/menu-icon/4.svg" alt="">
            <span>UI Component</span>
          </a>
          <ul>
            <li><a href="#">Elements</a>
                <ul>
                    <li><a href="buttons.html">Buttons</a></li>
                    <li><a href="dropdown.html">Dropdowns</a></li>
                    <li><a href="Badges.html">Badges</a></li>
                    <li><a href="Loading_Indicators.html">Loading Indicators</a></li>
                </ul>
            </li>
            <li><a href="#">Components</a>
                <ul>
                    <li><a href="notification.html">Notifications</a></li>
                    <li><a href="progress.html">Progress Bar</a></li>
                    <li><a href="carousel.html">Carousel</a></li>
                    <li><a href="cards.html">cards</a></li>
                    <li><a href="Pagination.html">Pagination</a></li>
                </ul>
            </li>
          </ul>
        </li>

        <li class="">
          <a class="has-arrow" href="#" aria-expanded="false">
            <img src="img/menu-icon/5.svg" alt="">
            <span>Widgets</span>
          </a>
          <ul>
            <li><a href="chart_box_1.html">Chart Boxes 1</a></li>
            <li><a href="profilebox.html">Profile Box</a></li>
          </ul>
        </li>

        <li class="">
          <a class="has-arrow" href="#" aria-expanded="false">
            <img src="img/menu-icon/6.svg" alt="">
            <span>Forms</span>
          </a>
          <ul>
            <li><a href="#">Elements</a>
                <ul>
                    <li><a href="data_table.html">Data Tables</a></li>
                    <li><a href="bootstrap_table.html">Grid Tables</a></li>
                    <li><a href="datepicker.html">Date Picker</a></li>
                </ul>
            </li>
            <li><a href="#">Widgets</a>
                <ul>
                    <li><a href="Input_Selects.html">Input Selects</a></li>
                    <li><a href="Input_Mask.html">Input Mask</a></li>
                </ul>
            </li>
          </ul>
        </li>

        <li class="">
          <a class="has-arrow" href="#" aria-expanded="false">
            <img src="img/menu-icon/7.svg" alt="">
            <span>Charts</span>
          </a>
          <ul>
            <li><a href="chartjs.html">ChartJS</a></li>
            <li><a href="apex_chart.html">Apex Charts</a></li>
            <li><a href="chart_sparkline.html">Chart sparkline</a></li>
          </ul>
        </li>

      </ul>
    
</nav>
<!-- sidebar part end -->
 <!--/ sidebar  -->


<section class="main_content dashboard_part">
        <!-- menu  -->
    <div class="container-fluid g-0">
        <div class="row">
            <div class="col-lg-12 p-0">
                <div class="header_iner d-flex justify-content-between align-items-center">
                    <div class="sidebar_icon d-lg-none">
                        <i class="ti-menu"></i>
                    </div>
                    <div class="serach_field-area">
                            <div class="search_inner">
                                <form action="#">
                                    <div class="search_field">
                                        <input type="text" placeholder="Search here...">
                                    </div>
                                    <button type="submit"> <img src="img/icon/icon_search.svg" alt=""> </button>
                                </form>
                            </div>
                        </div>
                    <div class="header_right d-flex justify-content-between align-items-center">
                        <div class="header_notification_warp d-flex align-items-center">
                            <li>
                                <a href="#"> <img src="img/icon/bell.svg" alt=""> </a>
                            </li>
                            <li>
                                <a href="#"> <img src="img/icon/msg.svg" alt=""> </a>
                            </li>
                        </div> 

<div class="profile_info">
    <img src="<?php echo $photo ? $photo : 'img/client_img.png'; ?>" alt="User  Photo">
    <div class="profile_info_iner">
        <p><?php echo $position; ?></p>
        <h5><?php echo $username; ?></h5>
        <div class="profile_info_details">
            <a href="#">My Profile <i class="ti-user"></i></a>
            <a href="#">Settings <i class="ti-settings"></i></a>
            <a href="logout.php">Log Out <i class="ti-shift-left"></i></a>
        </div>
    </div>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ menu  -->
    <div class="main_content_iner ">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="single_element">
                        <div class="quick_activity">
                            <div class="row">
                                <div class="col-12">
                                    <div class="quick_activity_wrap">
                                    
                                        <div class="single_quick_activity d-flex">
                                            <div class="icon">
                                                <img src="img/icon/man.svg" alt="">
                                            </div>
                                            <div class="count_content">
                                                <h3><span class="counter">520</span> </h3>
                                                <p>Пользователей</p>
                                            </div>
                                        </div>
                                        <div class="single_quick_activity d-flex">
                                            <div class="icon">
                                                <img src="img/icon/cap.svg" alt="">
                                            </div>
                                            <div class="count_content">
                                                <h3><span class="counter">6969</span> </h3>
                                                <p>Всего публикаций</p>
                                            </div>
                                        </div>
                                        <div class="single_quick_activity d-flex">
                                            <div class="icon">
                                                <img src="img/icon/wheel.svg" alt="">
                                            </div>
                                            <div class="count_content">
                                                <h3><span class="counter">7510</span> </h3>
                                                <p>в этом месяце</p>
                                            </div>
                                        </div>
                                        <div class="single_quick_activity d-flex">
                                            <div class="icon">
                                                <img src="img/icon/pharma.svg" alt="">
                                            </div>
                                            <div class="count_content">
                                                <h3><span class="counter">2110</span> </h3>
                                                <p>в этом году</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-12">
                    <div class="white_box mb_30 ">
                        <div class="box_header border_bottom_1px  ">
                            <div class="main-title">
                                <h3 class="mb_25">Hospital Survey</h3>
                            </div>
                        </div>
                        <div class="income_servay">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="count_content">
                                        <h3>$ <span class="counter">305</span> </h3>
                                        <p>Today's Income</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="count_content">
                                        <h3>$ <span class="counter">1005</span> </h3>
                                        <p>This Week's Income</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="count_content">
                                        <h3>$ <span class="counter">5505</span> </h3>
                                        <p>This Month's Income</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="count_content">
                                        <h3>$ <span class="counter">155615</span> </h3>
                                        <p>This Year's Income</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="bar_wev"></div>
                    </div>
                </div>
                <div class="col-xl-7">
                    <div class="white_box QA_section card_height_100">
                        <div class="white_box_tittle list_header m-0 align-items-center">
                            <div class="main-title mb-sm-15">
                                <h3 class="m-0 nowrap">Patients</h3>
                            </div>
                            <div class="box_right d-flex lms_block">
                                <div class="serach_field-area2">
                                    <div class="search_inner">
                                        <form active="#">
                                            <div class="search_field">
                                                <input type="text" placeholder="Search here...">
                                            </div>
                                            <button type="submit"> <i class="ti-search"></i> </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <table class="table lms_table_active2">
                                <thead>
                                    <tr>
                                        <th scope="col">Patients Name</th>
                                        <th scope="col">department</th>
                                        <th scope="col">Appointment Date</th>
                                        <th scope="col">Serial Number</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <div class="patient_thumb d-flex align-items-center">
                                                <div class="student_list_img mr_20">
                                                    <img src="img/patient/pataint.png" alt="" srcset="">
                                                </div>
                                                <p>Jhon Kural</p>
                                            </div>
                                        </th>
                                        <td>Monte Carlo</td>
                                        <td>11/03/2020</td>
                                        <td>MDC65454</td>
                                        <td>
                                            <div class="amoutn_action d-flex align-items-center">
                                                $29,192
                                                <div class="dropdown ms-4">
                                                    <a class=" dropdown-toggle hide_pils" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                  
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                      <a class="dropdown-item" href="#">View</a>
                                                      <a class="dropdown-item" href="#">Edit</a>
                                                      <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                  </div>
                                            </div> </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="patient_thumb d-flex align-items-center">
                                                <div class="student_list_img mr_20">
                                                    <img src="img/patient/2.png" alt="" srcset="">
                                                </div>
                                                <p>Jhon Kural</p>
                                            </div>
                                        </th>
                                        <td>Monte Carlo</td>
                                        <td>11/03/2020</td>
                                        <td>MDC65454</td>
                                        <td>
                                            <div class="amoutn_action d-flex align-items-center">
                                                $29,192
                                                <div class="dropdown ms-4">
                                                    <a class=" dropdown-toggle hide_pils" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                  
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                      <a class="dropdown-item" href="#">View</a>
                                                      <a class="dropdown-item" href="#">Edit</a>
                                                      <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                  </div>
                                            </div> </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="patient_thumb d-flex align-items-center">
                                                <div class="student_list_img mr_20">
                                                    <img src="img/patient/3.png" alt="" srcset="">
                                                </div>
                                                <p>Jhon Kural</p>
                                            </div>
                                        </th>
                                        <td>Monte Carlo</td>
                                        <td>11/03/2020</td>
                                        <td>MDC65454</td>
                                        <td>
                                            <div class="amoutn_action d-flex align-items-center">
                                                $29,192
                                                <div class="dropdown ms-4">
                                                    <a class=" dropdown-toggle hide_pils" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                  
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                      <a class="dropdown-item" href="#">View</a>
                                                      <a class="dropdown-item" href="#">Edit</a>
                                                      <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                  </div>
                                            </div> </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="patient_thumb d-flex align-items-center">
                                                <div class="student_list_img mr_20">
                                                    <img src="img/patient/4.png" alt="" srcset="">
                                                </div>
                                                <p>Jhon Kural</p>
                                            </div>
                                        </th>
                                        <td>Monte Carlo</td>
                                        <td>11/03/2020</td>
                                        <td>MDC65454</td>
                                        <td>
                                            <div class="amoutn_action d-flex align-items-center">
                                                $29,192
                                                <div class="dropdown ms-4">
                                                    <a class=" dropdown-toggle hide_pils" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                  
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                      <a class="dropdown-item" href="#">View</a>
                                                      <a class="dropdown-item" href="#">Edit</a>
                                                      <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                  </div>
                                            </div> </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="patient_thumb d-flex align-items-center">
                                                <div class="student_list_img mr_20">
                                                    <img src="img/patient/5.png" alt="" srcset="">
                                                </div>
                                                <p>Jhon Kural</p>
                                            </div>
                                        </th>
                                        <td>Monte Carlo</td>
                                        <td>11/03/2020</td>
                                        <td>MDC65454</td>
                                        <td>
                                            <div class="amoutn_action d-flex align-items-center">
                                                $29,192
                                                <div class="dropdown ms-4">
                                                    <a class=" dropdown-toggle hide_pils" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                  
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                      <a class="dropdown-item" href="#">View</a>
                                                      <a class="dropdown-item" href="#">Edit</a>
                                                      <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                  </div>
                                            </div> </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="patient_thumb d-flex align-items-center">
                                                <div class="student_list_img mr_20">
                                                    <img src="img/patient/6.png" alt="" srcset="">
                                                </div>
                                                <p>Jhon Kural</p>
                                            </div>
                                        </th>
                                        <td>Monte Carlo</td>
                                        <td>11/03/2020</td>
                                        <td>MDC65454</td>
                                        <td>
                                            <div class="amoutn_action d-flex align-items-center">
                                                $29,192
                                                <div class="dropdown ms-4">
                                                    <a class=" dropdown-toggle hide_pils" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                  
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                      <a class="dropdown-item" href="#">View</a>
                                                      <a class="dropdown-item" href="#">Edit</a>
                                                      <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                  </div>
                                            </div> </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div class="patient_thumb d-flex align-items-center">
                                                <div class="student_list_img mr_20">
                                                    <img src="img/patient/6.png" alt="" srcset="">
                                                </div>
                                                <p>Jhon Kural</p>
                                            </div>
                                        </th>
                                        <td>Monte Carlo</td>
                                        <td>11/03/2020</td>
                                        <td>MDC65454</td>
                                        <td>
                                            <div class="amoutn_action d-flex align-items-center">
                                                $29,192
                                                <div class="dropdown ms-4">
                                                    <a class=" dropdown-toggle hide_pils" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                  
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                      <a class="dropdown-item" href="#">View</a>
                                                      <a class="dropdown-item" href="#">Edit</a>
                                                      <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                  </div>
                                            </div> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 ">
                    <div class="white_box card_height_50 mb_30">
                        <div class="box_header border_bottom_1px  ">
                            <div class="main-title">
                                <h3 class="mb_25">Total Recover Report</h3>
                            </div>
                        </div>
                        <div id="chart-7"></div>
                        <div class="row text-center mt-3">
                            <div class="col-sm-6">
                                <h6 class="heading_6 d-block">Last Month</h6>
                                <p class="m-0">358</p>
                            </div>
                            <div class="col-sm-6">
                                <h6 class="heading_6 d-block">Current Month</h6>
                                <p class="m-0">194</p>
                            </div>
                        </div>
                    </div>
                    <div class="white_box card_height_50 mb_30">
                        <div class="box_header border_bottom_1px  ">
                            <div class="main-title">
                                <h3 class="mb_25">Total Death Report</h3>
                            </div>
                        </div>
                        <div id="chart-8"></div>
                        <div class="row text-center mt-3">
                            <div class="col-sm-6">
                                <h6 class="heading_6 d-block">Last Month</h6>
                                <p class="m-0">358</p>
                            </div>
                            <div class="col-sm-6">
                                <h6 class="heading_6 d-block">Current Month</h6>
                                <p class="m-0">194</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="white_box card_height_100">
                        <div class="box_header border_bottom_1px  ">
                            <div class="main-title">
                                <h3 class="mb_25">Hospital Staff</h3>
                            </div>
                        </div>
                        <div class="staf_list_wrapper sraf_active owl-carousel">
                            <!-- single carousel  -->
                            <div class="single_staf">
                                <div class="staf_thumb">
                                    <img src="img/staf/1.png" alt="">
                                </div>
                                <h4>Dr. Sysla J Smith</h4>
                                <p>Doctor</p>
                            </div>
                            <!-- single carousel  -->
                            <div class="single_staf">
                                <div class="staf_thumb">
                                    <img src="img/staf/2.png" alt="">
                                </div>
                                <h4>Dr. Sysla J Smith</h4>
                                <p>Doctor</p>
                            </div>
                            <!-- single carousel  -->
                            <div class="single_staf">
                                <div class="staf_thumb">
                                    <img src="img/staf/3.png" alt="">
                                </div>
                                <h4>Dr. Sysla J Smith</h4>
                                <p>Doctor</p>
                            </div>
                            <!-- single carousel  -->
                            <div class="single_staf">
                                <div class="staf_thumb">
                                    <img src="img/staf/4.png" alt="">
                                </div>
                                <h4>Dr. Sysla J Smith</h4>
                                <p>Doctor</p>
                            </div>
                            <!-- single carousel  -->
                            <div class="single_staf">
                                <div class="staf_thumb">
                                    <img src="img/staf/5.png" alt="">
                                </div>
                                <h4>Dr. Sysla J Smith</h4>
                                <p>Doctor</p>
                            </div>
                            <!-- single carousel  -->
                            <div class="single_staf">
                                <div class="staf_thumb">
                                    <img src="img/staf/1.png" alt="">
                                </div>
                                <h4>Dr. Sysla J Smith</h4>
                                <p>Doctor</p>
                            </div>
                            <!-- single carousel  -->
                            <div class="single_staf">
                                <div class="staf_thumb">
                                    <img src="img/staf/2.png" alt="">
                                </div>
                                <h4>Dr. Sysla J Smith</h4>
                                <p>Doctor</p>
                            </div>
                            <!-- single carousel  -->
                            <div class="single_staf">
                                <div class="staf_thumb">
                                    <img src="img/staf/3.png" alt="">
                                </div>
                                <h4>Dr. Sysla J Smith</h4>
                                <p>Doctor</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="white_box card_height_100">
                        <div class="box_header border_bottom_1px  ">
                            <div class="main-title">
                                <h3 class="mb_25">Recent Activity</h3>
                            </div>
                        </div>
                        <div class="Activity_timeline">
                            <ul>
                                <li>
                                    <div class="activity_bell"></div>
                                    <div class="activity_wrap">
                                        <h6>5 min ago</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="activity_bell"></div>
                                    <div class="activity_wrap">
                                        <h6>5 min ago</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="activity_bell"></div>
                                    <div class="activity_wrap">
                                        <h6>5 min ago</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="activity_bell"></div>
                                    <div class="activity_wrap">
                                        <h6>5 min ago</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="white_box mb_30">
                        <div class="box_header border_bottom_1px  ">
                            <div class="main-title">
                                <h3 class="mb_25">Recent Activity</h3>
                            </div>
                        </div>
                        <div class="activity_progressbar">
                            <div class="single_progressbar">
                                <h6>USA</h6>
                                <div id="bar1" class="barfiller">
                                    <div class="tipWrap">
                                        <span class="tip"></span>
                                    </div>
                                    <span class="fill" data-percentage="95"></span>
                                </div>
                            </div>
                            <div class="single_progressbar">
                                <h6>AFRICA</h6>
                                <div id="bar2" class="barfiller">
                                    <div class="tipWrap">
                                        <span class="tip"></span>
                                    </div>
                                    <span class="fill" data-percentage="75"></span>
                                </div>
                            </div>
                            <div class="single_progressbar">
                                <h6>UK</h6>
                                <div id="bar3" class="barfiller">
                                    <div class="tipWrap">
                                        <span class="tip"></span>
                                    </div>
                                    <span class="fill" data-percentage="55"></span>
                                </div>
                            </div>
                            <div class="single_progressbar">
                                <h6>CANADA</h6>
                                <div id="bar4" class="barfiller">
                                    <div class="tipWrap">
                                        <span class="tip"></span>
                                    </div>
                                    <span class="fill" data-percentage="25"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer part -->
<div class="footer_part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer_iner text-center">
                    <p>2020 © Influence - Designed by <a href="#"> <i class="ti-heart"></i> </a><a href="#"> Dashboard</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- main content part end -->

<!-- footer  -->
<!-- jquery slim -->
<script src="js/jquery1-3.4.1.min.js"></script>
<!-- popper js -->
<script src="js/popper1.min.js"></script>
<!-- bootstarp js -->
<script src="js/bootstrap1.min.js"></script>
<!-- sidebar menu  -->
<script src="js/metisMenu.js"></script>
<!-- waypoints js -->
<script src="vendors/count_up/jquery.waypoints.min.js"></script>
<!-- waypoints js -->
<script src="vendors/chartlist/Chart.min.js"></script>
<!-- counterup js -->
<script src="vendors/count_up/jquery.counterup.min.js"></script>
<!-- swiper slider js -->
<script src="vendors/swiper_slider/js/swiper.min.js"></script>
<!-- nice select -->
<script src="vendors/niceselect/js/jquery.nice-select.min.js"></script>
<!-- owl carousel -->
<script src="vendors/owl_carousel/js/owl.carousel.min.js"></script>
<!-- gijgo css -->
<script src="vendors/gijgo/gijgo.min.js"></script>
<!-- responsive table -->
<script src="vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="vendors/datatable/js/dataTables.responsive.min.js"></script>
<script src="vendors/datatable/js/dataTables.buttons.min.js"></script>
<script src="vendors/datatable/js/buttons.flash.min.js"></script>
<script src="vendors/datatable/js/jszip.min.js"></script>
<script src="vendors/datatable/js/pdfmake.min.js"></script>
<script src="vendors/datatable/js/vfs_fonts.js"></script>
<script src="vendors/datatable/js/buttons.html5.min.js"></script>
<script src="vendors/datatable/js/buttons.print.min.js"></script>

<script src="js/chart.min.js"></script>
<!-- progressbar js -->
<script src="vendors/progressbar/jquery.barfiller.js"></script>
<!-- tag input -->
<script src="vendors/tagsinput/tagsinput.js"></script>
<!-- text editor js -->
<script src="vendors/text_editor/summernote-bs4.js"></script>

<script src="vendors/apex_chart/apexcharts.js"></script>

<!-- custom js -->
<script src="js/custom.js"></script>

<script src="vendors/apex_chart/bar_active_1.js"></script>
<script src="vendors/apex_chart/apex_chart_list.js"></script>
</body>



</html>


   <?php else: ?>
   <!DOCTYPE html>
<html lang="ru">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Авторизация | Международный юридический клуб</title>

    <link rel="icon" href="img/logo.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap1.min.css">
    <!-- themefy CSS -->
    <link rel="stylesheet" href="vendors/themefy_icon/themify-icons.css">
    <!-- swiper slider CSS -->
    <link rel="stylesheet" href="vendors/swiper_slider/css/swiper.min.css">
    <!-- select2 CSS -->
    <link rel="stylesheet" href="vendors/select2/css/select2.min.css">
    <!-- select2 CSS -->
    <link rel="stylesheet" href="vendors/niceselect/css/nice-select.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="vendors/owl_carousel/css/owl.carousel.css">
    <!-- gijgo css -->
    <link rel="stylesheet" href="vendors/gijgo/gijgo.min.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="vendors/font_awesome/css/all.min.css">
    <link rel="stylesheet" href="vendors/tagsinput/tagsinput.css">
    <!-- datatable CSS -->
    <link rel="stylesheet" href="vendors/datatable/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="vendors/datatable/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="vendors/datatable/css/buttons.dataTables.min.css">
    <!-- text editor css -->
    <link rel="stylesheet" href="vendors/text_editor/summernote-bs4.css">
    <!-- morris css -->
    <link rel="stylesheet" href="vendors/morris/morris.css">
    <!-- metarial icon css -->
    <link rel="stylesheet" href="vendors/material_icon/material-icons.css">

    <!-- menu css  -->
    <link rel="stylesheet" href="css/metisMenu.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/colors/default.css" id="colorSkinCSS">
</head>
<body class="crm_body_bg">
    


<!-- main content part here -->



<section class="main_content dashboard_part" style="padding-left: 0px;">
      
    <div class="main_content_iner ">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_box mb_30">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <!-- sign_in  -->
                                <div class="modal-content cs_modal">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Вход</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="">
                               
                                            <div class="form-group">
                                                <input type="text" id="username" name="username" required class="form-control" placeholder="Имя пользователя">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" id="password" name="password" class="form-control" placeholder="Пароль">
                                            </div>
                                           
                                            <button type="submit" class="btn btn_1 full_width text-center">Войти</button>
                                          
                                            <div class="text-center">
                                                <a href="reset_password.php" class="pass_forget_btn">Забыли пароль?</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>



        </div>
    </div>

<!-- footer part -->
<div class="footer_part" style="padding-left: 0px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer_iner text-center">
                    <p>2025 © Международный юридический клуб - Разработано <a href="https://prodigitalplus.ru"> <i class="ti-heart"></i> </a><a href="#"> Digital+</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</div></section>
<!-- main content part end -->

<!-- footer  -->
<!-- jquery slim -->
<script src="js/jquery1-3.4.1.min.js"></script>
<!-- popper js -->
<script src="js/popper1.min.js"></script>
<!-- bootstarp js -->
<script src="js/bootstrap1.min.js"></script>
<!-- sidebar menu  -->
<script src="js/metisMenu.js"></script>
<!-- waypoints js -->
<script src="vendors/count_up/jquery.waypoints.min.js"></script>
<!-- waypoints js -->
<script src="vendors/chartlist/Chart.min.js"></script>
<!-- counterup js -->
<script src="vendors/count_up/jquery.counterup.min.js"></script>
<!-- swiper slider js -->
<script src="vendors/swiper_slider/js/swiper.min.js"></script>
<!-- nice select -->
<script src="vendors/niceselect/js/jquery.nice-select.min.js"></script>
<!-- owl carousel -->
<script src="vendors/owl_carousel/js/owl.carousel.min.js"></script>
<!-- gijgo css -->
<script src="vendors/gijgo/gijgo.min.js"></script>
<!-- responsive table -->
<script src="vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="vendors/datatable/js/dataTables.responsive.min.js"></script>
<script src="vendors/datatable/js/dataTables.buttons.min.js"></script>
<script src="vendors/datatable/js/buttons.flash.min.js"></script>
<script src="vendors/datatable/js/jszip.min.js"></script>
<script src="vendors/datatable/js/pdfmake.min.js"></script>
<script src="vendors/datatable/js/vfs_fonts.js"></script>
<script src="vendors/datatable/js/buttons.html5.min.js"></script>
<script src="vendors/datatable/js/buttons.print.min.js"></script>

<script src="js/chart.min.js"></script>
<!-- progressbar js -->
<script src="vendors/progressbar/jquery.barfiller.js"></script>
<!-- tag input -->
<script src="vendors/tagsinput/tagsinput.js"></script>
<!-- text editor js -->
<script src="vendors/text_editor/summernote-bs4.js"></script>

<script src="vendors/apex_chart/apexcharts.js"></script>

<!-- custom js -->
<script src="js/custom.js"></script>

</body>

</html>
    
   <?php endif; ?>
