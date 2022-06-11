<?php
  include_once ('views/pages/user/header.php');
?>
      <div class="wrapper">
        <div id="search_result" class="hoc clear">
          <div class="search_result_container">
            <div class="left_side">
              <div class="searched_place_box searched_card">
                <div class="header">
                  <img src="views/images/user/car.svg" alt="car" />
                  <p class="header_title">Szukana wartość</p>
                </div>
                <div class="content">
                  <h1><?php echo $_SESSION['plate_num'] !== '' ? $_SESSION['plate_num'] : $_SESSION['visite_date']; ?></h1>
                </div>
              </div>
              <div class="record_box searched_card">
                <div class="header">
                  <img src="views/images/user/record.svg" alt="record" />
                  <p class="header_title">ilość wizyt serwisowych</p>
                </div>
                <div class="content">
                  <h1>
                    <?php
                      if($upload_times)
                        echo count($upload_times);
                      else
                        echo count($plate_numbers); 
                    ?>
                  </h1>
                </div>
              </div>
              <button class="return_search_btn">
                <img src="views/images/user/left-caret.svg" alt="left-caret" />
                <p>POWRÓT DO WYSZUKIWANIA</p>
              </button>
            </div>
            <div class="right_side list_box">
              <div class="list_header">
                <img
                  src="views/images/user/calendar-check.svg"
                  alt="calendar-check"
                />
                <p class="header_title">
                  Znalezione wyniki
                </p>
              </div>
              <ul class="list_content">
                <?php $i = 0;
                  if($upload_times) {
                    foreach($upload_times as $time) { ?>
                      <li data-value= "<?php echo $time['date']; ?>" class="list_item"><?php echo $time['date']; ?></li>
                <?php }} else {
                    foreach($plate_numbers as $plate_number) { ?>
                      <li data-value= "<?php echo $plate_number['license_plate']; ?>" class="list_item"><?php echo $plate_number['license_plate']; ?></li>
                <?php }} ?>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <link rel="stylesheet" href="views/layout/styles/user/searchResult.css" />      
      <script src="js/user/searchResult.js"></script>
      <script>
        var b_search = <?php echo $plate_numbers ? 'true' : 'false'; ?>
      </script>

<?php
  include_once ('views/pages/user/footer.php');
?>

