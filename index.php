<?php
/*
    *   spin - Quiz generating script
    *   Developer: Pintu Kumar Gupta
    *   Contact: youtube.com/TechnicalMixGyan
    *   https://www.technicalmixgyan.in/
*/
// Include Config files of the quiz
require_once 'config/config.php';
session_name('quiz_'.$config['quiz_number']);
session_start();

// Count Total Number Questions
$total_questions = count($questions);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
<!-- Global site tag (gtag.js) - Google Analytics -->
      
      
      
      

 <title><?php echo $config['TITLE'];?> | <?php echo $config['DOMAINNAME'];?></title>
        <meta http-equiv="Content-Type" content="text/php; charset=utf-8" />
        <meta name='subtitle' content='<?php echo $config['SUBTITLE'];?>'/>
        <meta name='subject' content='<?php echo $config['SUBJECT'];?>'/>
        <meta name="description" content="<?php echo $config['DESCRIPTION'];?>"/>
        <meta name="keywords" content="<?php echo $config['KEYWORDS'];?>"/>
        <meta name='target' content='all'/>
        <meta name='HandheldFriendly' content='True'/>
        <meta name='MobileOptimized' content='320'/>
        <meta name="robots" content="index, follow"/>
        <meta name="revisit-after" content="30 days"/>
        <meta name="copyright" content="<?php echo $config['DOMAINNAME'];?>"/>
        <meta name="distribution" content="global"/>
        <meta name="language" content="english"/> 
        <meta name="rating" content="safe for kids"/>
        <meta http-equiv="Cache-control" content="public"/>
        <meta name='Classification' content='Business'/>
        <meta http-equiv='Expires' content='0'/>
        <meta http-equiv='Pragma' content='no-cache'/>
        <meta http-equiv='Cache-Control' content='no-cache'/>
        <meta http-equiv='imagetoolbar' content='no'/>
        <meta http-equiv='x-dns-prefetch-control' content='off'/>
        <meta name="viewport" content="initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="../common_pages/images/favicon.ico"/>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="../common_pages/style.css" type="text/css" media="screen" />
        <style type="text/css">
            .adslot_1 { display:inline-block; width: 320px; height: 50px; }
            @media (max-width: 400px) 
            {
             //.adslot_1 { display: none; } 
             #left-side-bar{display: none;}
             #right-side-bar{display: none;}
             #hidden-bottom{display: block; clear: both;} 
             #break-overloadded{display: none;}
            }
            @media (min-width:500px) 
            { 
                .adslot_1 { width: 468px; height: 60px; } 
                #hidden-bottom{display: none;}
                #break-overloadded{display: block; clear: both;}
            }
            @media (min-width:800px) 
            { 
                .adslot_1 { width: 728px; height: 90px; } 
                #hidden-bottom{display: none;}
                #break-overloadded{display: none;}
            }
            img.quiz-image
            {
                width: 100%;
            }

        </style>
        
    </head>
    <body>
        <div class="container-fluid">
            <div class="row" >
                <!--Header-->
                <div class="col-md-12 gray">
                   <?php include '../common_pages/header.php'; ?>
                </div>
                <!--Header-->
            </div>
            <div class="row-fluid">
                <div class="col-md-3 gray" id="left-side-bar" >
                    <?php include '../common_pages/sidebar_left.php'; ?>
                </div>
                <div class="col-md-6">
                    <div class="main" style="padding:20px">
                        <h3><?php echo $config['quiz_name']; ?></h3>
                        <?php
                        // Get next question 
                        if (isset($_REQUEST['q']) && !empty($_REQUEST['q']) && is_numeric($_REQUEST['q']))
                        {

                            // Get question number
                            $q = $_REQUEST['q'];

                            // If previous question is present
                            // (if User have answered some questions)
                            $previous = ($q >= 1) ? $q - 1 : false;

                            // Get Next Question Number
                            $next = ($q < $total_questions) ? $q + 1 : false;

                            // Temporary session name
                            $s_temp = '';

                            // If next is required
                            if ($_REQUEST['a'] == "next")
                            {
                                if ($q == 1)
                                {
                                    $s_temp = 'q' . $q; // if 1 is required (no addition or subtraction).
                                } else
                                {
                                    $s_temp = 'q' . ($q - 1); // next-1 is current question
                                }
                            } elseif ($_REQUEST['a'] == "previous")
                            {
                                $s_temp = 'q' . ($q + 1); // previous+1 is current question
                            }
                       
                            // User attempted last qustion, so redirect to result page
                            if(isset($_REQUEST['show_result']))
                            {
                               ?>
                                 <script>window.location = "result.php";</script>
                               <?php
                            }
                                 
                            // If user is at last question, then show the result button
                            $last_question = ($q == $total_questions) ? TRUE : FALSE;
                            
                            
                            // Print requested question of the quiz
                            # title of the question
                            ?>
                            <center>
                                    
                            </center>
                            <form action="./" method="post" name="quiz_form" id="quiz_form">
                                <h3><?php echo $questions[$q]['title'] ?></h3>
                                <?php
                                # Questwion options
                                foreach ($questions[$q]['options'] as $option_value => $option)
                                {
                                    ?>
                                    <div class="radio">
                                        <label>
                                            <?php
                                            // if session values is set, then checked the selected
                                            if (isset($_SESSION['q' . $q]) && $_SESSION['q' . $q] == $option_value)
                                            {
                                                ?>
                                                <input type="radio" name="options" class="options" value="<?php echo $option_value ?>" checked>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input type="radio" name="options" class="options" value="<?php echo $option_value ?>">
                                                <?php
                                            }
                                            ?>
                                            <?php echo $option ?>
                                        </label>
                                    </div>
                                    <?php
                                }//end foreach
                                // Show previous page
                                if ($previous)
                                {
                                    ?>
                                    
                                    <input type="hidden" name="a" id="a" value="previous">
                                    <input type="hidden" name="q" id="q" value="<?php echo $previous ?>">
                                    <button type="button" q="<?php echo $previous ?>" class="btn btn-default next-btn">Previous</button>
                                    <?php
                                }
                                // Show next page
                                if ($next)
                                {
                                    ?>
                                    
                                    <input type="hidden" name="a" id="a" value="next">
                                    <input type="hidden" name="q" id="q" value="<?php echo $next ?>">
                                    <button type="button" q="<?php echo $next ?>" class="btn btn-default next-btn" value="<?php echo $next ?>">Next</button>
                                    <?php
                                }
                                // Show grade button if it is last question
                                elseif ($last_question) 
                                {
                                    ?>
                                    <button type="button" class="btn btn-default show-result" value="<?php echo $next ?>">Show Result</button>
                                    <?php
                                }
                                ?>
                                <input type="hidden" name="quiz_number" id="quiz_number" value="<?php echo $config['quiz_number'] ?>">
                            </form>
                            <?php
                            // Set session values
                            $_SESSION[$s_temp] = $_REQUEST['options'];
                        }//end if
                        else
                        {
                            // Print first question of the quiz
                            # title of the question
                            ?>
                            <center>
                                    
                            </center>
                            <form action="./" method="post" name="quiz_form" id="quiz_form">
                                <h3><?php echo $questions['1']['title'] ?></h3>
                                <?php
                                # Questwion options
                                foreach ($questions['1']['options'] as $option_value => $option)
                                {
                                    ?>

                                    <div class="radio">
                                        <label>
                                            <?php
                                            // if session values is set, then checked the selected
                                            if (isset($_SESSION['q1']) && $_SESSION['q1'] == $option_value)
                                            {
                                                ?>
                                                <input type="radio" name="options" class="options" value="<?php echo $option_value ?>" checked>
                                                <?php
                                            } else
                                            {
                                                ?>
                                                <input type="radio" name="options" class="options" value="<?php echo $option_value ?>">
                                                <?php
                                            }
                                            ?>
                                            <?php echo $option ?>
                                        </label>
                                    </div>
                                    <?php
                                }//end foreach
                                ?>
                                <input type="hidden" name="quiz_number" id="quiz_number" value="<?php echo $config['quiz_number'] ?>">
                                <input type="hidden" name="a" id="a" value="next">
                                <input type="hidden" name="q" id="a" value="2">
                                <button type="button" q="2" class="btn btn-default next-btn">Next</button>
                            </form>
                            
                            <?php
                        }//end else
                        ?>
                    </div>
                </div>
                <div id="break-overloadded">
                </div>
                <div class="col-md-3 gray" id="right-side-bar">
                    <?php include '../common_pages/sidebar_right.php'; ?>
                </div>
                <div id="hidden-bottom" class="col-md-3" style="overflow:hidden">

                </div>
            </div>
            <div class="row-fluid" >
                <div class="col-lg-12 gray" style="margin-top:20px;">
                    <!-- begin #footer -->
                    <?php include '../common_pages/footer.php'; ?>
                    <!-- end #footer -->
                </div>
            </div>
        </div>      
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/custom.js"></script>
    </body>
</html>
