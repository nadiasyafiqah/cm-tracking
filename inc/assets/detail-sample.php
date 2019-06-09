<?php include('../layout/header.php'); ?>
<h1>Asset Details</h1>
<p>
  Asset Name: HP 8640P</br>
  Serial: SGH123456
</p>
<div class="row">
  <div class="col">
    <h4><u>Check-in</u></h4>
    <form action="" method="post">
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="">Date</label>
        </div>
        <div class="col-10">
          <input class="form-control" type="date" name="" id="">
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="">Location</label>
        </div>
        <div class="col-10">
          <input class="form-control" type="text" name="" id="">
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="">Remarks</label>
        </div>
        <div class="col-10">
          <input class="form-control" type="text" name="" id="">
        </div>
      </div>
      <div class="float-right">
      <input class="btn btn-info" type="submit" name="checkinSubmit" value="Update">
      </div>
    </form>
  </div>
  <div class="col">
    <h4><u>Transfer</u></h4>
    <form action="" method="post">
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="">Date</label>
        </div>
        <div class="col-10">
          <input class="form-control" type="date" name="" id="">
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="">Location</label>
        </div>
        <div class="col-10">
          <input class="form-control" type="text" name="" id="">
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="">Remarks</label>
        </div>
        <div class="col-10">
          <input class="form-control" type="text" name="" id="">
        </div>
      </div>
      <div class="float-right">
      <input class="btn btn-info" type="submit" name="transferSubmit" value="Update">
      </div>
    </form>
  </div>
  </div>
</div>
<div class="row">
  <div class="col-6">
    <h4><u>Check-out</u></h4>
    <form action="" method="post">
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="">Date</label>
        </div>
        <div class="col-10">
          <input class="form-control" type="date" name="" id="">
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="">Location</label>
        </div>
        <div class="col-10">
          <input class="form-control" type="text" name="" id="">
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="">Remarks</label>
        </div>
        <div class="col-10">
          <input class="form-control" type="text" name="" id="">
        </div>
      </div>
      <div class="float-right">
      <input class="btn btn-info" type="submit" name="checkoutSubmit" value="Update">
      </div>
    </form>
  </div>
  </div>
</div>
<?php include('../layout/footer.php'); ?>