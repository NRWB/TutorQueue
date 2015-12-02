<!doctype html>
<html>
<head>
  <title>QSC Tutor Queue</title>
  <meta charset="utf-8">
  <!-- send empty favicon fallback to prevent user's browser hitting the server for lots of favicon requests resulting in 404s -->
  <link rel="icon" href="data:;base64,=">

  <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css" />
<!--  <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/bootstrap.min.css" /> -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!--
  <script src="<?php echo Config::get('URL'); ?>js/jquery-latest.min.js"></script>
  <script src="<?php echo Config::get('URL'); ?>js/jquery-1.11.3.min.js"></script>
  <script src="<?php echo Config::get('URL'); ?>js/bootstrap.min.js"></script>
-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</head>
<body>

  <!-- wrapper, to center website -->
  <div class="wrapper">

    <!-- navigation -->
    <ul class="navigation">

      <?php if (Session::userIsLoggedIn()) { ?>

        <!-- Admins -->
        <?php if (Session::get("user_account_type") == 7) : ?>
          <li <?php if (View::checkForActiveController($filename, "admin")) { echo ' class="active" '; } ?> >
            <a href="<?php echo Config::get('URL'); ?>admin/index">Admin Home</a>
          </li>
          <li <?php if (View::checkForActiveController($filename, "greeter")) { echo ' class="active" '; } ?> >
            <a href="<?php echo Config::get('URL'); ?>greeter/index">Greeter Home</a>
          </li>
          <li <?php if (View::checkForActiveController($filename, "student")) { echo ' class="active" '; } ?> >
            <a href="<?php echo Config::get('URL'); ?>student/index">Student Home</a>
          </li>
        <?php endif; ?>

        <!-- Greeters -->
        <?php if (Session::get("user_account_type") == 3) : ?>
          <li <?php if (View::checkForActiveController($filename, "greeter")) { echo ' class="active" '; } ?> >
            <a href="<?php echo Config::get('URL'); ?>greeter/index">Greeter Home</a>
          </li>
        <?php endif; ?>

        <!-- Students -->
        <!-- Should not have header shown as students stay on one page and do not need to log in or out -->

      <?php } else { ?>

        <!-- for not logged in users -->
        <li <?php if (View::checkForActiveControllerAndAction($filename, "login/index")) { echo ' class="active" '; } ?> >
          <a href="<?php echo Config::get('URL'); ?>login/index">Login</a>
        </li>

      <?php } ?>

    </ul>

    <!-- my account -->
    <ul class="navigation right">

      <?php if (Session::userIsLoggedIn()) : ?>
        <li <?php if (View::checkForActiveController($filename, "login")) { echo ' class="active" '; } ?> >
          <a href="<?php echo Config::get('URL'); ?>login/logout">Logout</a>
        </li>

      <?php endif; ?>
    </ul>

    <?php if (Session::userIsLoggedIn()) { ?>
      <div class="panel panel-header">
        Logged in as: <?php echo Session::get("user_name"); ?>
      </div>
    <?php } ?>

<!--
 ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Content:
 http://bootsnipp.com/snippets/featured/collapsible-panel
 http://www.xul.fr/ajax/dynamic-select.php
-->

    <div class="container">

      <h1>Add/Remove Drop Down Elements</h1>

      <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

          <div class="row">
            <div class="col-md-10">
              <div class="panel panel-primary">

                <div class="panel-heading">

                  <h2 class="panel-title">
                    Edit Tutor Quick Notes Panel
                    <span class="pull-right clickable">
                      <i class="glyphicon glyphicon-chevron-up">
                      </i>
                    </span>
                  </h2>

                </div>

                <div class="panel-body">

<!--                  <form id="dynsel" name="dynsel" method="post" action="dynamic-select-demo.html"> -->
                  <form id="dynsel" name="dynsel" method="post">
                    <table border="0" cellspacing="0" cellpadding="8">
                      <tr>

                        <td>
                          <div align="center">
                            <select name="select1" id="select1" size="10" style="width:180px" multiple onchange="selectoption();" >
                            </select>
                          </div>
                        </td>

                        <td>
                          <label for="title">Add:</label>
                          <br />
                          <input type="text" name="title" id="title" value="" size="24" placeholder="Input text here" />
                          <input type="button" name="add" id="addBtn" style="width:140px" value="Add to select" onclick="addoption()" />
                          <br /><br />
<!--                          <span style="margin-left:16px"> -->
                            Remove the selected
<!--                          </span> -->
                          <br />
                          <input type="button" name="del" style="width:120px" value="Delete" onclick="deloption()" />
                          <br /><br />
                        </td>

                      </tr>
                    </table>

                    <p>
                      <div align="center">
                        <input type="button" name="SubmitSave" value="Save the list of options" onclick="savelist(this)" />
                      </div>
                    </p>

                  </form>

<!--
        <?php foreach ($this->quicknotes as $note) { ?>
          <tr>
            <td><?= $note->qNoteReason; ?></td>
            <td><input type="checkbox">
          </tr>
        <?php } ?>
-->

                  </form>

                </div> <!-- End of Panel Body -->

<!-- xxxxxxxxxxxxx 

                <div class="panel-heading">

                  <h2 class="panel-title">
                    Edit Subjects Panel
                    <span class="pull-right clickable">
                      <i class="glyphicon glyphicon-chevron-up">
                      </i>
                    </span>
                  </h2>

                </div>

                <div class="panel-body">
                </div>


                <div class="panel-heading">

                  <h2 class="panel-title">
                    Edit Subjects Panel
                    <span class="pull-right clickable">
                      <i class="glyphicon glyphicon-chevron-up">
                      </i>
                    </span>
                  </h2>

                </div>

                <div class="panel-body">
                </div>
-->

              </div> <!-- End of Panel Panel Primary -->
            </div> <!-- End of Col-md-10 -->
          </div> <!-- End of row -->

        </div> <!-- End of box -->
      </div> <!-- End of container -->

      <div class="container">
        <p style="display: block; font-size: 11px; color: #999;">
          <div class="footer" align="center">
            <a href="http://www.washington.edu/"><img src="https://www.washington.edu/home/graphics/blockw.gif" width="53" height="37" alt="UW Logo"></a>
            <br>
            <a href="http://www.bothell.washington.edu/qsc">Contact QSC</a>
          </div>
        </p>
      </div>

  </div><!-- close class="wrapper" -->

<script>

$(document).ready(function() {
  $('#title').keypress(function(e) {
    if (e.keyCode == 13) { // DOM_VK_RETURN = 13
      $('#addBtn').click();
    }
  });
});

// Ajax funtion to load a file.

function dataRead(url, fun) {
  var xhr = createXHR();
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
      if (xhr.status == 200) {
        fun(xhr.responseText);
      }
    }
  };
  url = url + "?nocache=" + Math.random();
  xhr.open("GET", url, true);
  xhr.send(null);
}

// Event activated when an option is selected. Not used here.
function selectoption() {
  var selected = document.dynsel.select1.selectedIndex;
  var title = document.dynsel.select1[selected].text;
  // not used for now
}

// Add a new option to the list
function addoption() {
  var optlist = document.getElementById("select1");
  var title = document.dynsel.title.value;
  var size = optlist.options.length;
  for (i = 0; i < size; i++) { // this is required for IE
    if (optlist.options[i] == null || optlist.options[i].text == "") {
      optlist.options[i] = new Option(title);
      return;
    }
  }
  optlist.options[size] = new Option(title);
}

// Creating the options in select from loaded file
function populate(content) {
  content = content.replace(" ", "");
  var lst = content.split("<br>");
  var optlist = document.getElementById("select1");
  for (i = 0; i < lst.length; i++) {
    if (lst[i] == "")
      continue;
    optlist.options[i] = new Option(lst[i]);
  }
}

// Load the data and populate the select
function initialize() {
  dataRead("dynamic-select.txt", populate);
}

// Delete an entry
function deloption() {
  var optlist = document.getElementById("select1");
  var selected = optlist.selectedIndex;
  var last = optlist.options.length - 1;
  for (i = selected; i < last; i++) {
    optlist.options[i] = new Option(optlist.options[i + 1].text);
  }
  optlist.options[last] = null;
}

function loadapage(element, res) {
  // action is unchanged, but if you choose dynamically the page to load, assign it here
  //element.form.action = "";
  element.form.submit()
}

// Write to the server
function dataWrite(url, data, fun, element) {
  var xhr = createXHR();
  xhr.onreadystatechange=function() {
    if (xhr.readyState == 4) {
      if (fun != null)
	    fun(element, xhr.responseText);
	}
  };
  xhr.open("POST",url, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send(data);
}

// Saving the list of options
function savelist(element) {
  var title = "";
  var url = "";
  var data = "";
  var optlist = document.getElementById("select1");
  var size = optlist.options.length;
  for (i = 0; i < size; i++) {
    title = optlist.options[i].text;
	if (title == "")
	  continue;
    if (data != "")
	  data += "&";
	data += "tab" + String(i) + "=" + title;
  }
  dataWrite("dynamic-save.php", data, loadapage, element);
}

// Starts the job by populating the SELECT with a list of options
window.onload=initialize;

function createXHR() {
  var request = false;
  try {
	request = new ActiveXObject('Msxml2.XMLHTTP');
  } catch (err2) {
	try {
	  request = new ActiveXObject('Microsoft.XMLHTTP');
	} catch (err3) {
	  try {
	    request = new XMLHttpRequest();
	  } catch (err1) {
	    request = false;
	  }
	}
  }
  return request;
}

$(document).on('click', '.panel-heading span.clickable', function(e) {
  var $this = $(this);
  if (!$this.hasClass('panel-collapsed')) {
    $this.closest('.panel').find('.panel-body').slideUp();
    $this.addClass('panel-collapsed');
    $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
  } else {
    $this.parents('.panel').find('.panel-body').slideDown();
    $this.removeClass('panel-collapsed');
    $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
  }
})
/**
$(document).on('click', '.panel-heading span.clickable', function(e) {
  var $this = $(this);
  if (!$this.hasClass('panel-collapsed')) {
    $this.closest('.panel').find('.panel-body').slideUp();
    $this.addClass('panel-collapsed');
    $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
  } else {
    $this.parents('.panel').find('.panel-body').slideDown();
    $this.removeClass('panel-collapsed');
    $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
  }
})

$(document).on('click', '.panel-heading span.clickable', function(e) {
  var $this = $(this);
  if (!$this.hasClass('panel-collapsed')) {
    $this.closest('.panel').find('.panel-body').slideUp();
    $this.addClass('panel-collapsed');
    $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
  } else {
    $this.parents('.panel').find('.panel-body').slideDown();
    $this.removeClass('panel-collapsed');
    $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
  }
})
*/

</script>

</body>
</html>
