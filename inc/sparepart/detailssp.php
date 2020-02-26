<?php 
  include(CLASS_DIR.'/class.sparepart.php');
  include(CLASS_DIR.'/class.formsp.php');
  include(CLASS_DIR.'/class.dal.php');
  if (isset($_GET['sparepart'])) {
    $sparePartID = $_GET['sparepart'];
  }

  if (SparePart::isArchived($sparePartID)) {
    Formsp::printMsg('warning', 'Spare Part is Archived. No update can be made.');
  }

  if (isset($_POST['checkinUpdate'])) {
    if (SparePart::isArchived($sparePartID)) {
      Formsp::printMsg('danger', 'Failed. Spare Part is Archived. No update can be made.');
    } else {
      DAL::updateSparePartCheckinDetails($_POST, $sparePartID);
    }
  }

  if (isset($_POST['transferUpdate'])) {
    if (SparePart::isArchived($sparePartID)) {
      Formsp::printMsg('danger', 'Failed. Spare Part is Archived. No update can be made.');
    } else {
      DAL::updateSparePartTransferDetails($_POST, $sparePartID);
    }
  }

  if (isset($_POST['checkoutUpdate'])) {
    if (SparePart::isArchived($sparePartID)) {
      Formsp::printMsg('danger', 'Failed. Spare Part is Archived. No update can be made.');
    } else {
      DAL::updateSparePartCheckoutDetails($_POST, $sparePartID);
    }
  }
?>

<h1>Spare Part Details</h1>
<div class="row mb-3">
  <div class="col-sm">
    <u>Name:</u> <?php SparePart::getSparePartNameBySparePartID($sparePartID); ?>
  </div>
  <div class="col-sm">
    <u>Serial:</u> <?php SparePart::getSparePartSerial($sparePartID); ?>
  </div>
  <div class="col-sm">
    <u>Current Location:</u> <?php SparePart::getSparePartCurrentLocation($sparePartID); ?>
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
          <input class="form-control" type="date" name="checkinDate" value="<?php SparePart::getCheckinDate($sparePartID); ?>" id="" <?php if (SparePart::isArchived($sparePartID)) {echo "disabled";} ?>>
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="checkinLocation">Location</label>
        </div>
        <div class="col-10">
          <select class="form-control" name="checkinLocation" id="" <?php if (SparePart::isArchived($sparePartID)) {echo "disabled";} ?>>
            <?php Formsp::getCheckinLocationIntoSelect($sparePartID); ?>
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="checkinRemarks">Remarks</label>
        </div>
        <div class="col-10">
          <input class="form-control" type="text" name="checkinRemarks" value="<?php SparePart::getCheckinRemarks($sparePartID); ?>" id="" <?php if (SparePart::isArchived($sparePartID)) {echo "disabled";} ?>>
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
          <input class="form-control" type="date" name="transferDate" value="<?php SparePart::getTransferDate($sparePartID); ?>" id="" <?php if (SparePart::isArchived($sparePartID)) {echo "disabled";} ?>>
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="transferLocation">Location</label>
        </div>
        <div class="col-10">
          <select class="form-control" name="transferLocation" id="" <?php if (SparePart::isArchived($sparePartID)) {echo "disabled";} ?>>
            <?php Formsp::getTransferLocationIntoSelect($sparePartID); ?>
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="transferRemarks">Remarks</label>
        </div>
        <div class="col-10">
          <input class="form-control" type="text" name="transferRemarks" value="<?php SparePart::getTransferRemarks($sparePartID); ?>" id="" <?php if (SparePart::isArchived($sparePartID)) {echo "disabled";} ?>>
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
          <input class="form-control" type="date" name="checkoutDate" value="<?php SparePart::getCheckoutDate($sparePartID); ?>" id="" <?php if (SparePart::isArchived($sparePartID)) {echo "disabled";} ?>>
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="checkoutLocation">Location</label>
        </div>
        <div class="col-10">
          <select class="form-control" name="checkoutLocation" id="" <?php if (SparePart::isArchived($sparePartID)) {echo "disabled";} ?>>
            <?php Formsp::getCheckoutLocationIntoSelect($sparePartID); ?>
          </select>
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
          <label class="col-form-label" for="checkoutRemarks">Remarks</label>
        </div>
        <div class="col-10">
          <input class="form-control" type="text" name="checkoutRemarks" value="<?php SparePart::getCheckoutRemarks($sparePartID); ?>" id="" <?php if (SparePart::isArchived($sparePartID)) {echo "disabled";} ?>>
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