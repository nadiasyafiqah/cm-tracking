<?php 
  include(CLASS_DIR.'/class.asset.php');
  include(CLASS_DIR.'/class.form.php');
  include(CLASS_DIR.'/class.dal.php');
  if (isset($_GET['asset'])) {
    $assetID = $_GET['asset'];
  }

  if (Asset::isArchived($assetID)) {
    Form::printMsg('warning', 'Asset is Archived. No update can be made.');
  }

  if (isset($_POST['checkinUpdate'])) {
    if (Asset::isArchived($assetID)) {
      Form::printMsg('danger', 'Failed. Asset is Archived. No update can be made.');
    } else {
      DAL::updateAssetCheckinDetails($_POST, $assetID);
    }
  }

  if (isset($_POST['transferUpdate'])) {
    if (Asset::isArchived($assetID)) {
      Form::printMsg('danger', 'Failed. Asset is Archived. No update can be made.');
    } else {
      DAL::updateAssetTransferDetails($_POST, $assetID);
    }
  }

  if (isset($_POST['checkoutUpdate'])) {
    if (Asset::isArchived($assetID)) {
      Form::printMsg('danger', 'Failed. Asset is Archived. No update can be made.');
    } else {
      DAL::updateAssetCheckoutDetails($_POST, $assetID);
    }
  }
?>

<h1>Asset Details</h1>
<div class="row mb-3">
  <div class="col-sm">
    <u>Name:</u> <?php Asset::getAssetNameByAssetID($assetID); ?>
  </div>
  <div class="col-sm">
    <u>Serial:</u> <?php Asset::getAssetSerial($assetID); ?>
  </div>
  <div class="col-sm">
    <u>Current Location:</u> <?php Asset::getAssetCurrentLocation($assetID); ?>
  </div>
</div>
<div class="row">
  <div class="col-xl-6 col-sm">
    <h5><u>Check-in</u></h5>
    <form action="" method="post">
      <div class="row form-group">
        <div class="col-xl">
          <label class="col-form-label" for="checkinDate">Date</label>
        </div>
        <div class="col-10">
          <input class="form-control" type="date" name="checkinDate" value="<?php Asset::getCheckinDate($assetID); ?>" id="" <?php if (Asset::isArchived($assetID)) {echo "disabled";} ?>>
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="checkinLocation">Location</label>
        </div>
        <div class="col-10">
          <select class="form-control" name="checkinLocation" id="" <?php if (Asset::isArchived($assetID)) {echo "disabled";} ?>>
            <?php Form::getCheckinLocationIntoSelect($assetID); ?>
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="checkinRemarks">Remarks</label>
        </div>
        <div class="col-10">
          <input class="form-control" type="text" name="checkinRemarks" value="<?php Asset::getCheckinRemarks($assetID); ?>" id="" <?php if (Asset::isArchived($assetID)) {echo "disabled";} ?>>
        </div>
      </div>
      <div class="float-right">
      <input class="btn btn-info" type="submit" name="checkinUpdate" value="Update">
      </div>
    </form>
  </div>
  <div class="col-xl-6 col-sm">
    <h5><u>Transfer</u></h5>
    <form action="" method="post">
      <div class="row form-group">
        <div class="col-xl">
          <label class="col-form-label" for="transferDate">Date</label>
        </div>
        <div class="col-10">
          <input class="form-control" type="date" name="transferDate" value="<?php Asset::getTransferDate($assetID); ?>" id="" <?php if (Asset::isArchived($assetID)) {echo "disabled";} ?>>
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="transferLocation">Location</label>
        </div>
        <div class="col-10">
          <select class="form-control" name="transferLocation" id="" <?php if (Asset::isArchived($assetID)) {echo "disabled";} ?>>
            <?php Form::getTransferLocationIntoSelect($assetID); ?>
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="transferRemarks">Remarks</label>
        </div>
        <div class="col-10">
          <input class="form-control" type="text" name="transferRemarks" value="<?php Asset::getTransferRemarks($assetID); ?>" id="" <?php if (Asset::isArchived($assetID)) {echo "disabled";} ?>>
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
  <div class="col-xl-6 col-sm">
    <h5><u>Check-out</u></h5>
    <form action="" method="post">
      <div class="row form-group">
        <div class="col-xl">
          <label class="col-form-label" for="checkoutDate">Date</label>
        </div>
        <div class="col-10">
          <input class="form-control" type="date" name="checkoutDate" value="<?php Asset::getCheckoutDate($assetID); ?>" id="" <?php if (Asset::isArchived($assetID)) {echo "disabled";} ?>>
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="checkoutLocation">Location</label>
        </div>
        <div class="col-10">
          <select class="form-control" name="checkoutLocation" id="" <?php if (Asset::isArchived($assetID)) {echo "disabled";} ?>>
            <?php Form::getCheckoutLocationIntoSelect($assetID); ?>
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="checkoutRemarks">Remarks</label>
        </div>
        <div class="col-10">
          <input class="form-control" type="text" name="checkoutRemarks" value="<?php Asset::getCheckoutRemarks($assetID); ?>" id="" <?php if (Asset::isArchived($assetID)) {echo "disabled";} ?>>
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