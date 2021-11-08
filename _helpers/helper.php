<?php
function base_url($a = '')
{
  $getbase_url = $GLOBALS['setUri']['base'];
  return $getbase_url . $a;
}

function assets($a = '')
{
  $getbase_assets = $GLOBALS['setUri']['assets'];
  return base_url($getbase_assets . $a);
}

function url($a = '', $b = '')
{
  return base_url($b . '?halaman=' . $a);
}

function redirect($a = '')
{
  header("location: " . $a);
  exit;
}

function templates($a = '')
{
  return assets($GLOBALS['template'] . $a);
}


function content_open($title = '')
{
  return '
  <main class="app-main">
  <!-- .wrapper -->
  <div class="wrapper">
      <!-- .page -->
      <div class="page">
          <!-- .page-inner -->
          <div class="page-inner">
            <h1 class="page-title mr-sm-auto">' .$title. '</h1><br>';
}
function content_close()
{
  return '    </div>
  <!-- /.page-inner -->
  </div>
  <!-- /.page -->
  </div>
  <!-- /.wrapper -->
  </main>
  <!-- /.app-main -->
  </div>
  <!-- /.app -->';
}