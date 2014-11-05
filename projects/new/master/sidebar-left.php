<!-- left sidebar -->

<div class="col-md-2 left-sidebar">
  <!-- main-nav -->
  <nav class="main-nav">
    <ul class="main-menu">
      <li class="active"><a href="index-2.html"><i class="fa fa-dashboard fa-fw"></i><span class="text">Dashboard</span></a> </li>
      <li><a href="#" class="js-sub-menu-toggle"><i class="fa fa-clipboard fa-fw"></i><span class="text">Pages</span> <i class="toggle-icon fa fa-angle-left"></i></a>
        <ul class="sub-menu ">
          <li> <a href="page-profile.html"> <span class="text">Profile</span> </a> </li>
          <li> <a href="page-invoice.html"> <span class="text">Invoice</span> </a> </li>
          <li> <a href="page-knowledgebase.html"> <span class="text">Knowledge Base</span> </a> </li>
          <li> <a href="page-inbox.html"> <span class="text">Inbox</span> </a> </li>
          <li> <a href="page-register.html"> <span class="text">Register</span> </a> </li>
          <li> <a href="page-login.html"> <span class="text">Login</span> </a> </li>
          <li> <a href="page-404.html"> <span class="text">404</span> </a> </li>
          <li> <a href="page-blank.html"> <span class="text">Blank Page</span> </a> </li>
        </ul>
      </li>
      <li><a href="#" class="js-sub-menu-toggle"><i class="fa fa-bar-chart-o fw"></i><span class="text">Charts &amp; Statistics</span> <i class="toggle-icon fa fa-angle-left"></i></a>
        <ul class="sub-menu ">
          <li> <a href="charts-statistics.html"> <span class="text">Charts</span> </a> </li>
          <li> <a href="charts-statistics-interactive.html"> <span class="text">Interactive Charts</span> </a> </li>
          <li> <a href="charts-statistics-real-time.html"> <span class="text">Realtime Charts</span> </a> </li>
        </ul>
      </li>
      <li><a href="#" class="js-sub-menu-toggle"><i class="fa fa-edit fw"></i><span class="text">Forms</span> <i class="toggle-icon fa fa-angle-left"></i></a>
        <ul class="sub-menu ">
          <li> <a href="forms-elements.html"> <span class="text">Form Elements</span> </a> </li>
          <li> <a href="forms-validations.html"> <span class="text">Validation</span> </a> </li>
          <li> <a href="forms-file-upload.html"> <span class="text">File Upload</span> </a> </li>
        </ul>
      </li>
      <li><a href="#" class="js-sub-menu-toggle"><i class="fa fa-list-alt fw"></i><span class="text">UI Elements</span> <i class="toggle-icon fa fa-angle-left"></i></a>
        <ul class="sub-menu ">
          <li> <a href="ui-elements-general.html"> <span class="text">General Elements</span> </a> </li>
          <li> <a href="ui-elements-buttons.html"> <span class="text">Buttons</span> </a> </li>
          <li> <a href="ui-elements-icons.html"> <span class="text">Icons</span> </a> </li>
          <li> <a href="ui-elements-flash-message.html"> <span class="text">Flash Message</span> </a> </li>
        </ul>
      </li>
      <li><a href="widgets.html"><i class="fa fa-puzzle-piece fa-fw"></i><span class="text">Widgets</span></a> </li>
      <li><a href="#" class="js-sub-menu-toggle"><i class="fa fa-gears fw"></i><span class="text">Components</span> <i class="toggle-icon fa fa-angle-left"></i></a>
        <ul class="sub-menu ">
          <li> <a href="components-wizard.html"> <span class="text">Wizard (with validation)</span> </a> </li>
          <li> <a href="components-calendar.html"> <span class="text">Calendar</span> </a> </li>
          <li> <a href="components-maps.html"> <span class="text">Maps</span> </a> </li>
          <li> <a href="components-gallery.html"> <span class="text">Gallery</span> </a> </li>
        </ul>
      </li>
      <li><a href="#" class="js-sub-menu-toggle"><i class="fa fa-table fw"></i><span class="text">Tables</span> <i class="toggle-icon fa fa-angle-left"></i></a>
        <ul class="sub-menu ">
          <li> <a href="tables-static-table.html"> <span class="text">Static Table</span> </a> </li>
          <li> <a href="tables-dynamic-table.html"> <span class="text">Dynamic Table</span> </a> </li>
        </ul>
      </li>
      <li><a href="typography.html"><i class="fa fa-font fa-fw"></i><span class="text">Typography</span></a> </li>
    </ul>
  </nav>
  <!-- /main-nav -->
  <div class="sidebar-minified js-toggle-minified"> <i class="fa fa-angle-left"></i> </div>
  <!-- sidebar content -->
  <?php /*?><div class="sidebar-content">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h5><i class="fa fa-lightbulb-o"></i> Tips</h5>
      </div>
      <div class="panel-body">
        <p>You can do live search to the widget at search box located at top bar. It's very useful if your dashboard is full of widget.</p>
      </div>
    </div>
    <h5 class="label label-default"><i class="fa fa-info-circle"></i> Server Info</h5>
    <ul class="list-unstyled list-info-sidebar bottom-30px">
      <li class="data-row"> <span class="data-name">Disk Space Usage</span> <span class="data-value"> 274.43 / 2 GB
        <div class="progress progress-xs">
          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%"> <span class="sr-only">10%</span> </div>
        </div>
        </span> </li>
      <li class="data-row"> <span class="data-name">Monthly Bandwidth Transfer</span> <span class="data-value"> 230 / 500 GB
        <div class="progress progress-xs">
          <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="46" aria-valuemin="0" aria-valuemax="100" style="width: 46%"> <span class="sr-only">46%</span> </div>
        </div>
        </span> </li>
      <li class="data-row"> <span class="data-name">Database Disk Space</span> <span class="data-value">219.45 MB</span> </li>
      <li class="data-row"> <span class="data-name">Operating System</span> <span class="data-value">Linux</span> </li>
      <li class="data-row"> <span class="data-name">Apache Version</span> <span class="data-value">2.4.6</span> </li>
      <li class="data-row"> <span class="data-name">PHP Version</span> <span class="data-value">5.3.27</span> </li>
      <li class="data-row"> <span class="data-name">MySQL Version</span> <span class="data-value">5.5.34-cll</span> </li>
      <li class="data-row"> <span class="data-name">Architecture</span> <span class="data-value">x86_64</span> </li>
    </ul>
  </div><?php */?>
  <!-- end sidebar content -->
</div>
<!-- end left sidebar -->
