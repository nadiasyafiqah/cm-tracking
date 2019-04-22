<?php 
  include(CLASS_DIR.'/class.asset.php');
  include(CLASS_DIR.'/class.form.php');
  include(CLASS_DIR.'/class.dal.php');
  if (isset($_GET['asset'])) {
    $assetID = $_GET['asset'];
  }

  if (isset($_POST['checkinUpdate'])) {
    DAL::updateAssetCheckinDetails($_POST, $assetID);
  }

  if (isset($_POST['transferUpdate'])) {
    DAL::updateAssetTransferDetails($_POST, $assetID);
  }

  if (isset($_POST['checkoutUpdate'])) {
    DAL::updateAssetCheckoutDetails($_POST, $assetID);
  }
?>

<h1>Asset Details</h1>
<div class="row mb-3">
  <div class="col">
    <u>Name:</u> <?php Asset::getAssetNameByAssetID($assetID); ?>
  </div>
  <div class="col">
    <u>Serial:</u> <?php Asset::getAssetSerial($assetID); ?>
  </div>
  <div class="col">
    <u>Current Location:</u> <?php Asset::getAssetCurrentLocation($assetID); ?>
  </div>
</div>
<div class="row">
  <div class="col">
    <h5><u>Check-in</u></h5>
    <form action="" method="post">
      <div class="row form-group">
        <div class="col-2">
          <label class="col-form-label" for="checkinDate">Date</label>
        </div>
        <div class="col-10">
          <input class="form-control" type="date" name="checkinDate" value="<?php Asset::getCheckinDate($assetID); ?>" id="">
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="checkinLocation">Location</label>
        </div>
        <div class="col-10">
          <select class="form-control" name="checkinLocation" id="">
            <?php Form::getCheckinLocationIntoSelect($assetID); ?>
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="checkinRemarks">Remarks</label>
        </div>
        <div class="col-10">
          <input class="form-control" type="text" name="checkinRemarks" value="<?php Asset::getCheckinRemarks($assetID); ?>" id="">
        </div>
      </div>
      <div class="float-right">
      <input class="btn btn-info" type="submit" name="checkinUpdate" value="Update">
      </div>
    </form>
  </div>
  <div class="col">
    <h5><u>Transfer</u></h5>
    <form action="" method="post">
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="transferDate">Date</label>
        </div>
        <div class="col-10">
          <input class="form-control" type="date" name="transferDate" value="<?php Asset::getTransferDate($assetID); ?>" id="">
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="transferLocation">Location</label>
        </div>
        <div class="col-10">
          <select class="form-control" name="transferLocation" id="">
            <?php Form::getTransferLocationIntoSelect($assetID); ?>
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="transferRemarks">Remarks</label>
        </div>
        <div class="col-10">
          <input class="form-control" type="text" name="transferRemarks" value="<?php Asset::getTransferRemarks($assetID); ?>" id="">
        </div>
      </div>
      <div class="float-right">
      <input class="btn btn-info" type="submit" name="transferUpdate" value="Update">
      </div>
    </form>
  </div>
  </div>
</div>
<div class="row">
  <div class="col-6">
    <h5><u>Check-out</u></h5>
    <form action="" method="post">
      <div class="row form-group">
        <div class="col-2">
          <label class="col-form-label" for="checkoutDate">Date</label>
        </div>
        <div class="col">
          <input class="form-control" type="date" name="checkoutDate" value="<?php Asset::getCheckoutDate($assetID); ?>" id="">
        </div>
      </div>
      <div class="row form-group">
        <div class="col-2">
          <label class="col-form-label" for="checkoutLocation">Location</label>
        </div>
        <div class="col-10">
          <select class="form-control" name="checkoutLocation" id="">
            <?php Form::getCheckoutLocationIntoSelect($assetID); ?>
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-2">
          <label class="col-form-label" for="checkoutRemarks">Remarks</label>
        </div>
        <div class="col">
          <input class="form-control" type="text" name="checkoutRemarks" value="<?php Asset::getCheckoutRemarks($assetID); ?>" id="">
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
        </div>
        <div class="col-2">
          <input class="btn btn-info float-right" type="submit" name="checkoutUpdate" value="Update">
        </div>
      </div>
    </form>
  </div>
  </div>
</div>