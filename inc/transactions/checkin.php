<h1>Check-in Asset</h1>
<form class="" action="" method="post">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="date">Date</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" name="date">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="asset">Asset</label>
    <div class="col-sm-10">
      <select class="form-control" name="asset" id="">
        <option>HP | 8100 CMT | SGH78356</option>
        <option>Lenovo | T440 | LN873411100</option>
        <option>Brand | Model | Serial</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="location">Source Location</label>
    <div class="col-sm-10">
      <select class="form-control" name="location" id="">
        <option>Johor | KK Batu Pahat</option>
        <option>Melaka | Politeknik Melaka</option>
        <option>State | Institute Name</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="location">Target Store</label>
    <div class="col-sm-10">
      <select class="form-control" name="location" id="">
        <option>Baracho UTHM</option>
        <option>Prodata Pasir Gudang</option>
        <option>Baracho HQ</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="person">Submitted by</label>
    <div class="col-sm-10">
      <input class="form-control" type="text" name="person" id="" placeholder="Fetched from database or manual input">
    </div>
  </div>
  <input class="btn btn-primary" type="submit" value="Submit">
</form>