<?php
// css and js file path
$cssDir = "styles";
$jsDir = "js";

// Individual css files
$styles = [
    'index.php' => 'index.css',
    'individual_sample.php' => 'individual_sample.css',
    'registration.php' => 'registration,sign_in.css',
    'results_sample.php' => 'results_sample.css',
    'search.php' => 'search.css',
    'submission.php' => 'submission.css',
    'sign_in.php' => 'registration,sign_in.css',
    'profile.php' => 'registration,sign_in.css',
    'notify.php' => 'registration,sign_in.css',
];

// Individual js files
$scripts = [
    'index.php' => 'index.js',
    'individual_sample.php' => 'individual_sample.js',
    'registration.php' => 'registration.js',
    'results_sample.php' => 'results_sample.js',
    'search.php' => 'search.js',
    'sign_in.php' => 'sign_in.js',
    'submission.php' => 'submit.js',
    'notify.php' => 'registration.js',
    'profile.php' => 'registration.js',
    'result_sample.php' => 'registration.js',
    'error.php' => 'registration.js',
];

// Individual page titles
$titles = [
    'error.php' => 'Error - ',
    'index.php' => 'Home - ',
    'individual_sample.php' => 'Museum - ',
    'sign_in.php' => 'Sign in - ',
    'registration.php' => 'Sign Up - ',
    'result_sample.php' => 'Search Results - ',
    'search.php' => 'Museum Search - ',
    'submission.php' => 'Add a New Museum - ',
    'results_sample.php' => 'results sample - ',
    'profile.php' => 'Your profile - ',
    'notify.php' => '',
];

// Get PHP file name
$this_page = basename($_SERVER['PHP_SELF']);
?>

<!-- Reference specific css file to the current page -->
<link rel="stylesheet" type="text/css" href="<?="$cssDir/$styles[$this_page]"?>">

<!-- Reference specific js file to the current page -->
<script type="text/javascript" src="<?="$jsDir/$scripts[$this_page]"?>"></script>

<!-- Title suffix of the page -->
<?php
     echo '<title>'.$titles[$this_page].'MuseuMaster</title>';
?>
