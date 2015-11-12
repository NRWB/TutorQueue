<div class="container">
  <h1>Add/Remove Drop Down Elements</h1>

  <div class="box">

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

<div class="container">
    <div class="row">
		<div class="col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Panel 1</h3>
					<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
				</div>
				<div class="panel-body">


<form id="dynsel" name="dynsel" method="post" action="dynamic-select-demo.html">
  <table border="0" cellspacing="0" cellpadding="8">
    <tr>
      <td>
        <div align="center">
          <select name="select1" id="select1" size="10" style="width:180px" multiple onchange="selectoption();" >
            <option>Empty</option>
          </select>
        </div>
      </td>

      <td>
        <input name="title" type="text" id="title"  value="" size="24" placeholder="Input text here" />
        <input type="button" name="add"  style="width:140px" value="Add to select" onclick="addoption()" />
        <br /><br />
        <input type="button" name="del"  style="width:120px" value="Delete" onclick="deloption()"  />
        <span  style="margin-left:16px" >Remove the selected option </span>
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

</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Panel 2</h3>
					<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
				</div>
				<div class="panel-body">Panel content</div>
		</div>
	</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Panel 3</h3>
					<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
				</div>
				<div class="panel-body">Panel content</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<h3 class="panel-title">Panel 4</h3>
					<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
				</div>
				<div class="panel-body">Panel content</div>
			</div>
		</div>
	</div>
</div>


<!--
        <?php foreach ($this->quicknotes as $note) { ?>
          <tr>
            <td><?= $note->qNoteReason; ?></td>
            <td><input type="checkbox">
          </tr>
        <?php } ?>
-->


  </div>
</div>
